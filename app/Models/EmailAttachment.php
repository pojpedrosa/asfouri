<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailAttachment extends Model
{
    protected $fillable = [
        'inbound_email_id', 'disk', 'path', 'filename', 'mime', 'size', 'content_id', 'is_inline',
    ];

    protected $casts = [
        'is_inline' => 'boolean',
        'size' => 'integer',
    ];

    public function email(): BelongsTo
    {
        return $this->belongsTo(InboundEmail::class, 'inbound_email_id');
    }

    public function getHumanSizeAttribute(): string
    {
        $bytes = (int) $this->size;
        if ($bytes <= 0) {
            return '';
        }
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = (int) floor(log($bytes, 1024));
        $i = min($i, count($units) - 1);

        return round($bytes / (1024 ** $i), $i ? 1 : 0).' '.$units[$i];
    }

    public function downloadUrl(): string
    {
        return route('mail.attachment', $this);
    }
}
