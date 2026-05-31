<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'organisation' => ['nullable', 'string', 'max:160'],
            'subject' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'min:10', 'max:4000'],
            // Honeypot — bots fill it, humans never see it.
            'website' => ['nullable', 'size:0'],
        ], [
            'website.size' => 'Spam detected.',
        ]);

        unset($validated['website']);

        ContactMessage::create([
            ...$validated,
            'locale' => App::getLocale(),
        ]);

        return redirect()
            ->route('contact')
            ->with('contact_sent', true);
    }
}
