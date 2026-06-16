<?php

namespace App\Support;

use App\Models\InboundEmail;
use Illuminate\Support\Str;

class MailThread
{
    /** Normalize a Message-ID: trim and strip surrounding angle brackets. */
    public static function cleanId(?string $id): ?string
    {
        if ($id === null) {
            return null;
        }
        $id = trim($id);
        $id = preg_replace('/^<|>$/', '', $id) ?? $id;
        $id = trim($id);

        return $id === '' ? null : $id;
    }

    /** Strip Re:/Fwd:/etc. prefixes and collapse whitespace. */
    public static function normalizeSubject(?string $subject): string
    {
        $s = (string) $subject;
        $s = preg_replace('/^(\s*(re|fwd?|fw|enc|res|aw|sv|r|odp)\s*:\s*)+/i', '', $s) ?? $s;

        return trim(preg_replace('/\s+/', ' ', $s) ?? $s);
    }

    /**
     * Resolve the thread_id for a message, scoped to one user. Matches by
     * In-Reply-To, then References, then (only when the correspondent is known)
     * normalized subject within 30 days, constrained to the same mailbox and
     * participant. Else mints a new thread id. IDs keep their angle brackets stripped.
     *
     * @param  array<int, string>  $references
     */
    public static function resolve(
        int $userId,
        ?string $inReplyTo,
        array $references,
        ?string $subject,
        ?int $mailAddressId = null,
        ?string $participant = null,
    ): string {
        $base = InboundEmail::query()->where('user_id', $userId);

        // 1. Direct parent.
        if (filled($inReplyTo)) {
            $parent = (clone $base)->where('message_id', $inReplyTo)->whereNotNull('thread_id')->first();
            if ($parent) {
                return $parent->thread_id;
            }
        }

        // 2. Anywhere in the References chain (most recent first).
        foreach (array_reverse($references) as $ref) {
            $ref = trim($ref);
            if ($ref === '') {
                continue;
            }
            $match = (clone $base)->where('message_id', $ref)->whereNotNull('thread_id')->first();
            if ($match) {
                return $match->thread_id;
            }
        }

        // 3. Same normalized subject + same correspondent + same mailbox, last 30 days.
        $normalized = static::normalizeSubject($subject);
        if ($normalized !== '' && filled($participant)) {
            $recent = (clone $base)
                ->whereNotNull('thread_id')
                ->where('created_at', '>=', now()->subDays(30))
                ->when($mailAddressId, fn ($q) => $q->where('mail_address_id', $mailAddressId))
                ->where(function ($q) use ($participant) {
                    $q->where('from_email', $participant)
                        ->orWhere('to_recipients', 'like', '%'.$participant.'%');
                })
                ->get(['subject', 'thread_id', 'created_at'])
                ->sortByDesc('created_at')
                ->first(fn (InboundEmail $m) => static::normalizeSubject($m->subject) === $normalized);
            if ($recent) {
                return $recent->thread_id;
            }
        }

        // 4. New thread.
        return (string) Str::uuid();
    }

    /**
     * Reconcile out-of-order delivery: if other rows reference this message
     * but sit on a different thread, merge them onto this message's thread.
     */
    public static function linkDescendants(InboundEmail $email): void
    {
        if (blank($email->message_id)) {
            return;
        }

        $mid = $email->message_id;
        $otherThreads = InboundEmail::query()
            ->where('user_id', $email->user_id)
            ->where('thread_id', '!=', $email->thread_id)
            ->where(fn ($q) => $q->where('in_reply_to', $mid)->orWhere('email_references', 'like', '%'.$mid.'%'))
            ->pluck('thread_id')
            ->unique()
            ->filter();

        foreach ($otherThreads as $threadId) {
            InboundEmail::where('user_id', $email->user_id)
                ->where('thread_id', $threadId)
                ->update(['thread_id' => $email->thread_id]);
        }
    }
}
