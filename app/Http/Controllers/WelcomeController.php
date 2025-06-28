<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class WelcomeController extends Controller
{
    /**
     * Show the application's landing page.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        // If the user is already authenticated, redirect them to the dashboard.
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        // Otherwise, show the landing page.
        return view('welcome');
    }
}
