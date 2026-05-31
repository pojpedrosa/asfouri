<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Resolve the active locale from session, falling back to a best guess
     * from the browser's Accept-Language header, then to Portuguese.
     */
    public function handle(Request $request, Closure $next)
    {
        $supported = config('app.supported_locales', ['pt', 'en']);

        $locale = $request->session()->get('locale');

        if (! in_array($locale, $supported, true)) {
            $preferred = $request->getPreferredLanguage(['pt', 'en']);
            $locale = in_array($preferred, $supported, true) ? $preferred : config('app.locale', 'pt');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
