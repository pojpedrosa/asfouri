<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InboundEmail extends Model
{
    protected $fillable = [
        'mail_address_id', 'message_id', 'recipient', 'from_email', 'from_name',
        'subject', 'body_text', 'body_html', 'raw', 'is_read', 'received_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'received_at' => 'datetime',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(MailAddress::class, 'mail_address_id');
    }
}
