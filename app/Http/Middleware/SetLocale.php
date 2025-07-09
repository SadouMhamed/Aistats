<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if locale is stored in session
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } else {
            // Default to French
            $locale = config('app.locale', 'fr');
        }

        // Validate locale is supported
        $availableLocales = array_keys(config('app.available_locales', ['fr' => 'Français']));
        if (!in_array($locale, $availableLocales)) {
            $locale = config('app.locale', 'fr');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
