<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class MagicLink
{
    /** Create a one-time login URL for a user, valid for $minutes. */
    public static function generate(User $user, int $minutes = 30): string
    {
        $token = Str::random(48);
        Cache::put('magic_login:'.hash('sha256', $token), $user->id, now()->addMinutes($minutes));

        return route('magic.verify', ['token' => $token]);
    }

    /** Redeem a token (single use); returns the user id or null. */
    public static function consume(string $token): ?int
    {
        return Cache::pull('magic_login:'.hash('sha256', $token));
    }
}
