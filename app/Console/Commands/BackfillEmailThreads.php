<?php

namespace App\Console\Commands;

use App\Models\InboundEmail;
use App\Support\MailThread;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use ZBateson\MailMimeParser\MailMimeParser;

#[Signature('mail:backfill-threads')]
#[Description('Backfill threading + attachments on existing inbound_emails from their stored raw MIME. Idempotent.')]
class BackfillEmailThreads extends Command
{
    public function handle(): int
    {
        $parser = new MailMimeParser();
        $done = 0;

        InboundEmail::query()
            ->whereNull('thread_id')
            ->orderBy('id')
            ->chunkById(100, function ($emails) use ($parser, &$done) {
                foreach ($emails as $email) {
                    try {
                        if (filled($email->raw)) {
                            $message = $parser->parse($email->raw, false);
                            $inReplyTo = MailThread::cleanId($message->getHeaderValue('In-Reply-To'));
                            $refsHeader = $message->getHeader('References');
                            $references = ($refsHeader && method_exists($refsHeader, 'getIds'))
                                ? array_values(array_filter(array_map([MailThread::class, 'cleanId'], $refsHeader->getIds())))
                                : [];

                            if (! $email->to_recipients) {
                                $email->to_recipients = trim(implode(', ', array_filter([
                                    $message->getHeaderValue('To'),
                                    $message->getHeaderValue('Cc'),
                                ]))) ?: null;
                            }
                            if (filled($email->message_id)) {
                                $email->message_id = MailThread::cleanId($email->message_id);
                            }
                            $email->in_reply_to = $inReplyTo;
                            $email->email_references = $references ? implode(' ', $references) : null;
                            $email->direction = $email->direction ?: 'inbound';
                            $email->thread_id = MailThread::resolve((int) $email->user_id, $inReplyTo, $references, $email->subject, $email->mail_address_id, $email->from_email);
                            $email->save();

                            MailThread::linkDescendants($email);

                            if ($email->attachments()->count() === 0) {
                                StoreInboundEmail::extractAttachments($email, $message);
                            }
                        } else {
                            $email->direction = $email->direction ?: 'inbound';
                            $email->thread_id = MailThread::resolve((int) $email->user_id, null, [], $email->subject);
                            $email->save();
                        }
                    } catch (\Throwable $e) {
                        $email->direction = $email->direction ?: 'inbound';
                        $email->thread_id = $email->thread_id ?: MailThread::resolve((int) $email->user_id, null, [], $email->subject);
                        $email->save();
                    }

                    $done++;
                }
            });

        $this->info("Backfilled {$done} message(s).");

        return self::SUCCESS;
    }
}
