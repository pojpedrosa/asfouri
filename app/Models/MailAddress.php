<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MailAddress extends Model
{
    protected $fillable = [
        'mail_account_id', 'local_part', 'domain',
        'forward_to', 'deliver_to_inbox', 'enabled', 'notes',
    ];

    protected $casts = [
        'deliver_to_inbox' => 'boolean',
        'enabled' => 'boolean',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(MailAccount::class, 'mail_account_id');
    }

    public function inbound(): HasMany
    {
        return $this->hasMany(InboundEmail::class);
    }

    public function getAddressAttribute(): string
    {
        return $this->local_part.'@'.$this->domain;
    }

    /** Destinations as an array. */
    public function forwardList(): array
    {
        return collect(explode(',', (string) $this->forward_to))
            ->map(fn ($s) => trim($s))
            ->filter()
            ->values()
            ->all();
    }
}
