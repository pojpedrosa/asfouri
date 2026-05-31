<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MailAccount extends Model
{
    protected $fillable = ['name', 'forward_to', 'active', 'notes'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(MailAddress::class);
    }
}
