<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function __invoke(Request $request, string $locale)
    {
        $request->session()->put('locale', $locale);

        return redirect(
            $request->headers->get('referer') ?: route('home')
        );
    }
}
