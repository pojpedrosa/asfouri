<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MagicLinkController extends Controller
{
    /** Show the "enter your email" form. */
    public function show()
    {
        return view('auth.magic-link');
    }

    /** Email a one-time login link if the address belongs to a user. */
    public function send(Request $request)
    {
        $data = $request->validate(['email' => ['required', 'email']]);

        $user = User::whereRaw('lower(email) = ?', [strtolower($data['email'])])->first();

        if ($user) {
            $token = Str::random(48);
            // One-time, 30-minute token (the hash is what we store).
            Cache::put('magic_login:'.hash('sha256', $token), $user->id, now()->addMinutes(30));
            $url = route('magic.verify', ['token' => $token]);

            try {
                Mail::html(
                    view('auth.magic-link-email', ['url' => $url, 'user' => $user])->render(),
                    fn ($m) => $m->to($user->email)->subject('O seu link de acesso · asfouri')
                );
            } catch (\Throwable $e) {
                Log::error('magic link send failed', ['email' => $user->email, 'error' => $e->getMessage()]);
            }
        }

        // Always the same response — never reveal whether an account exists.
        return back()->with('magic_sent', true);
    }

    /** Consume the token and log the user in. */
    public function verify(string $token, Request $request)
    {
        $userId = Cache::pull('magic_login:'.hash('sha256', $token)); // single use
        $user = $userId ? User::find($userId) : null;

        if (! $user) {
            return redirect()->route('magic.request')->with('magic_invalid', true);
        }

        Auth::guard('web')->login($user, remember: true);
        $request->session()->regenerate();

        return redirect('/admin');
    }
}
