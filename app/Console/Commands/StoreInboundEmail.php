<?php

namespace App\Console\Commands;

use App\Models\InboundEmail;
use App\Models\MailAddress;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use ZBateson\MailMimeParser\MailMimeParser;

#[Signature('mail:store {--recipient= : The asfouri.media address the mail was delivered to} {--sender= : Envelope sender}')]
#[Description('Store an inbound email piped in from Postfix (raw MIME on stdin) into the admin inbox.')]
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

            // Strip any +tag and resolve the local address to thread the inbox.
            $bare = preg_replace('/\+[^@]*@/', '@', $recipient);
            [$local, $domain] = array_pad(explode('@', (string) $bare, 2), 2, null);
            $address = MailAddress::query()
                ->whereRaw('lower(local_part) = ?', [strtolower((string) $local)])
                ->whereRaw('lower(domain) = ?', [strtolower((string) $domain)])
                ->first();

            InboundEmail::create([
                'mail_address_id' => $address?->id,
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

            $this->info('Stored inbound email for '.$recipient);
            return self::SUCCESS;
        } catch (\Throwable $e) {
            // Never bounce the original mail because of a storage error — log and exit 0.
            try {
                Log::error('mail:store failed', ['recipient' => $recipient, 'error' => $e->getMessage()]);
            } catch (\Throwable) {
                fwrite(STDERR, 'mail:store failed: '.$e->getMessage()."\n");
            }
            return self::SUCCESS;
        }
    }
}
