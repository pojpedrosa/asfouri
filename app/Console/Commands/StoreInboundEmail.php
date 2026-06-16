<?php

namespace App\Console\Commands;

use App\Models\InboundEmail;
use App\Models\MailAddress;
use App\Models\User;
use App\Support\MailThread;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

            // Threading headers (ids normalized: brackets stripped).
            $messageId = MailThread::cleanId($message->getHeaderValue('Message-ID'));
            $inReplyTo = MailThread::cleanId($message->getHeaderValue('In-Reply-To'));
            $refsHeader = $message->getHeader('References');
            $references = ($refsHeader && method_exists($refsHeader, 'getIds'))
                ? array_values(array_filter(array_map([MailThread::class, 'cleanId'], $refsHeader->getIds())))
                : [];
            $toRecipients = trim(implode(', ', array_filter([
                $message->getHeaderValue('To'),
                $message->getHeaderValue('Cc'),
            ]))) ?: null;

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

            $stored = false;
            if ($shouldStore) {
                $ownerId = $address?->user_id
                    ?? User::where('is_admin', true)->value('id')
                    ?? User::value('id');

                // Dedupe: same message already filed for this user.
                $already = filled($messageId) && InboundEmail::where('user_id', $ownerId)
                    ->where('message_id', $messageId)->exists();

                if (! $already) {
                    $email = InboundEmail::create([
                        'mail_address_id' => $address?->id,
                        'user_id' => $ownerId,
                        'thread_id' => MailThread::resolve((int) $ownerId, $inReplyTo, $references, $message->getHeaderValue('Subject'), $address?->id, $fromEmail),
                        'direction' => 'inbound',
                        'message_id' => $messageId,
                        'in_reply_to' => $inReplyTo,
                        'email_references' => $references ? implode(' ', $references) : null,
                        'recipient' => $recipient,
                        'to_recipients' => $toRecipients,
                        'from_email' => $fromEmail,
                        'from_name' => $fromName,
                        'subject' => $message->getHeaderValue('Subject'),
                        'body_text' => $message->getTextContent(),
                        'body_html' => $message->getHtmlContent(),
                        'raw' => $raw,
                        'received_at' => now(),
                    ]);

                    static::extractAttachments($email, $message);
                    MailThread::linkDescendants($email);
                    $stored = true;
                }
            }

            $this->info(sprintf(
                'Handled %s (stored=%s, forwarded=%s%s)',
                $recipient,
                $stored ? 'yes' : 'no',
                $forwarded ? 'yes' : 'no',
                $forwardFailed ? ', forward FAILED' : '',
            ));

            return self::SUCCESS;
        } catch (\Throwable $e) {
            try {
                Log::error('mail:store failed', ['recipient' => $recipient, 'error' => $e->getMessage()]);
            } catch (\Throwable) {
                fwrite(STDERR, 'mail:store failed: '.$e->getMessage()."\n");
            }

            return self::SUCCESS;
        }
    }

    /**
     * Extract MIME attachments onto the private 'mail' disk and record them.
     * Shared with the backfill command. Returns the count stored.
     */
    public static function extractAttachments(InboundEmail $email, $message): int
    {
        $count = 0;

        foreach ($message->getAllAttachmentParts() as $i => $part) {
            $original = $part->getFilename() ?: ('attachment-'.($i + 1));
            $safe = preg_replace('/[^\w.\- ]+/u', '_', basename($original)) ?: ('attachment-'.($i + 1));
            $safe = Str::limit($safe, 120, '');

            $content = $part->getContent();
            if ($content === null || $content === '') {
                continue;
            }

            $path = $email->id.'/'.Str::random(8).'-'.$safe;
            Storage::disk('mail')->put($path, $content);

            $cid = $part->getContentId();

            $email->attachments()->create([
                'disk' => 'mail',
                'path' => $path,
                'filename' => $original,
                'mime' => $part->getContentType(),
                'size' => Storage::disk('mail')->size($path),
                'content_id' => $cid ? trim($cid, '<>') : null,
                'is_inline' => strtolower((string) $part->getContentDisposition()) === 'inline',
            ]);

            $count++;
        }

        if ($count > 0 && ! $email->has_attachments) {
            $email->forceFill(['has_attachments' => true])->save();
        }

        return $count;
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
