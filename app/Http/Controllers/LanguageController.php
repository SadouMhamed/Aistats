<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    /**
     * Change the application language
     */
    public function changeLanguage(Request $request, $locale)
    {
        // Validate the locale
        $availableLocales = array_keys(config('app.available_locales', ['fr' => 'Français']));
        
        if (!in_array($locale, $availableLocales)) {
            return Redirect::back()->with('error', 'Language not supported');
        }

        // Store the locale in the session
        Session::put('locale', $locale);

        return redirect()->route('welcome')->with('success', 'Language changed successfully');
    }
}
