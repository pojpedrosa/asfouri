<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'organisation',
        'subject',
        'message',
        'locale',
        'handled',
    ];

    protected $casts = [
        'handled' => 'boolean',
    ];
}
