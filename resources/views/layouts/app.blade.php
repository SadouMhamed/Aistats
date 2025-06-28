<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Favicon -->
        @if(file_exists(public_path('images/favicon.ico')))
            <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
        @else
            <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📊</text></svg>">
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @if(app()->environment('production'))
            <!-- Production Assets with Render.com compatibility -->
            @if(file_exists(public_path('build/manifest.json')))
                @php
                    $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
                    $cssFile = $manifest['resources/css/app.css']['file'] ?? 'assets/app-BePH7TFh.css';
                    $jsFile = $manifest['resources/js/app.js']['file'] ?? 'assets/app-DaBYqt0m.js';
                    
                    // Force HTTPS URLs for Render.com
                    $baseUrl = config('app.url');
                    if (empty($baseUrl) || $baseUrl === 'http://localhost') {
                        $baseUrl = 'https://' . request()->getHost();
                    }
                    // Ensure HTTPS in production
                    $baseUrl = str_replace('http://', 'https://', $baseUrl);
                @endphp
                <link rel="stylesheet" href="{{ $baseUrl }}/build/{{ $cssFile }}">
                <script type="module" src="{{ $baseUrl }}/build/{{ $jsFile }}"></script>
            @else
                <!-- Fallback with hardcoded asset names -->
                @php
                    $fallbackUrl = config('app.url') ?: ('https://' . request()->getHost());
                    $fallbackUrl = str_replace('http://', 'https://', $fallbackUrl);
                @endphp
                <link rel="stylesheet" href="{{ $fallbackUrl }}/build/assets/app-BePH7TFh.css">
                <script type="module" src="{{ $fallbackUrl }}/build/assets/app-DaBYqt0m.js"></script>
            @endif
        @else
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
