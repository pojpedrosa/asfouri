<?php

namespace App\Console\Commands;

use App\Models\InboundEmail;
use App\Models\MailAddress;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use ZBateson\MailMimeParser\MailMimeParser;

#[Signature('mail:store {--recipient= : The asfouri.media address the mail was delivered to} {--sender= : Envelope sender}')]
#[Description('Handle an inbound email piped in from Postfix (raw MIME on stdin): store in the admin inbox and/or forward via Mailgun, per the address settings.')]
class StoreInboundEmail extends Command
{
    public function handle(): int
    {
        $recipient = strtolower(trim((string) $this->option('recipient')));
        $envelopeSender = trim((string) $this->option('sender'));

        $raw = stream_get_contents(STDIN, length: 25 * 1024 * 1024);
        if ($raw === false || $raw === '') {
            $this->error('No MIME input on stdin');
            return self::FAILURE;
        }

        try {
            $message = (new MailMimeParser())->parse($raw, false);

            $fromHeader = $message->getHeader('From');
            $hasFrom = $fromHeader && method_exists($fromHeader, 'getAddresses') && $fromHeader->getAddresses();
            $fromEmail = $hasFrom ? $fromHeader->getAddresses()[0]->getEmail() : ($envelopeSender ?: null);
            $fromName = $hasFrom ? ($fromHeader->getAddresses()[0]->getName() ?: null) : null;

            // Strip any +tag and resolve the local address.
            $bare = preg_replace('/\+[^@]*@/', '@', $recipient);
            [$local, $domain] = array_pad(explode('@', (string) $bare, 2), 2, null);
            $address = MailAddress::query()
                ->whereRaw('lower(local_part) = ?', [strtolower((string) $local)])
                ->whereRaw('lower(domain) = ?', [strtolower((string) $domain)])
                ->first();

            $forwarded = false;
            $forwardFailed = false;

            // Forward via the Mailgun API (preserves the full original message).
            if ($address && filled($address->forward_to)) {
                try {
                    $this->forwardViaMailgun($raw, $address->forwardList());
                    $forwarded = true;
                } catch (\Throwable $e) {
                    $forwardFailed = true;
                    Log::warning('mail:store forward failed', [
                        'recipient' => $recipient,
                        'to' => $address->forward_to,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            // Store in the inbox when asked to, OR as a safety net if a forward
            // couldn't be delivered (so mail is never silently lost).
            $shouldStore = ! $address || $address->deliver_to_inbox || $forwardFailed
                || ($address && blank($address->forward_to));

            if ($shouldStore) {
                // Deliver into the owning user's inbox; if the address has no
                // owner (or is unknown), fall back to the first admin.
                $ownerId = $address?->user_id
                    ?? \App\Models\User::where('is_admin', true)->value('id')
                    ?? \App\Models\User::value('id');

                InboundEmail::create([
                    'mail_address_id' => $address?->id,
                    'user_id' => $ownerId,
                    'message_id' => optional($message->getHeader('Message-ID'))->getValue(),
                    'recipient' => $recipient,
                    'from_email' => $fromEmail,
                    'from_name' => $fromName,
                    'subject' => $message->getHeaderValue('Subject'),
                    'body_text' => $message->getTextContent(),
                    'body_html' => $message->getHtmlContent(),
                    'raw' => $raw,
                    'received_at' => now(),
                ]);
            }

            $this->info(sprintf(
                'Handled %s (stored=%s, forwarded=%s%s)',
                $recipient,
                $shouldStore ? 'yes' : 'no',
                $forwarded ? 'yes' : 'no',
                $forwardFailed ? ', forward FAILED' : '',
            ));

            return self::SUCCESS;
        } catch (\Throwable $e) {
            // Never bounce the original mail because of an internal error — log and exit 0.
            try {
                Log::error('mail:store failed', ['recipient' => $recipient, 'error' => $e->getMessage()]);
            } catch (\Throwable) {
                fwrite(STDERR, 'mail:store failed: '.$e->getMessage()."\n");
            }

            return self::SUCCESS;
        }
    }

    /**
     * Forward the original MIME message to the destinations via Mailgun's
     * messages.mime endpoint (keeps attachments, formatting, headers intact).
     */
    protected function forwardViaMailgun(string $raw, array $destinations): void
    {
        $secret = config('services.mailgun.secret');
        $domain = config('services.mailgun.domain');
        $endpoint = config('services.mailgun.endpoint', 'api.eu.mailgun.net');

        if (blank($secret) || blank($domain)) {
            throw new \RuntimeException('Mailgun is not configured (missing secret/domain).');
        }
        if (empty($destinations)) {
            return;
        }

        $response = Http::withBasicAuth('api', $secret)
            ->timeout(20)
            ->attach('message', $raw, 'message.mime')
            ->post("https://{$endpoint}/v3/{$domain}/messages.mime", [
                'to' => implode(',', $destinations),
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException('Mailgun '.$response->status().': '.$response->body());
        }
    }
}
