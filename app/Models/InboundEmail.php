<?php

namespace App\Models;

use App\Support\MailThread;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InboundEmail extends Model
{
    protected $fillable = [
        'mail_address_id', 'user_id', 'thread_id', 'direction', 'message_id', 'in_reply_to',
        'email_references', 'recipient', 'to_recipients', 'from_email', 'from_name',
        'subject', 'body_text', 'body_html', 'raw', 'has_attachments', 'is_read', 'received_at', 'sent_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'has_attachments' => 'boolean',
        'received_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(MailAddress::class, 'mail_address_id');
    }

    /** The back-office user whose inbox this email belongs to. */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(EmailAttachment::class);
    }

    public function isOutbound(): bool
    {
        return $this->direction === 'outbound';
    }

    public function isInbound(): bool
    {
        return ! $this->isOutbound();
    }

    /** Best timestamp for ordering (received for inbound, sent for outbound). */
    public function getDatedAtAttribute(): ?\Illuminate\Support\Carbon
    {
        return $this->received_at ?? $this->sent_at;
    }

    /** Whom to show in the conversation list. */
    public function getParticipantAttribute(): string
    {
        if ($this->isOutbound()) {
            return $this->to_recipients ?: $this->recipient ?: '—';
        }

        return $this->from_name ?: ($this->from_email ?: '—');
    }

    /** All messages in this thread for this user, oldest first. */
    public function timeline(): Collection
    {
        return static::query()
            ->where('thread_id', $this->thread_id)
            ->where('user_id', $this->user_id)
            ->with('attachments')
            ->orderByRaw('COALESCE(received_at, sent_at) asc')
            ->get();
    }

    public function normalizedSubject(): string
    {
        return MailThread::normalizeSubject($this->subject);
    }
}
