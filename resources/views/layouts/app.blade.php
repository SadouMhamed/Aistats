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
            <!-- Production Assets with enhanced Render.com compatibility -->
            @php
                $baseUrl = config('app.url') ?: ('https://' . request()->getHost());
                $baseUrl = str_replace('http://', 'https://', $baseUrl);
                
                $cssFile = 'assets/app-BePH7TFh.css';
                $jsFile = 'assets/app-DaBYqt0m.js';
                
                // Try to read manifest if available
                if (file_exists(public_path('build/manifest.json'))) {
                    try {
                        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
                        $cssFile = $manifest['resources/css/app.css']['file'] ?? $cssFile;
                        $jsFile = $manifest['resources/js/app.js']['file'] ?? $jsFile;
                    } catch (Exception $e) {
                        // Fall back to hardcoded names if manifest fails
                    }
                }
                
                $cssUrl = $baseUrl . '/build/' . $cssFile;
                $jsUrl = $baseUrl . '/build/' . $jsFile;
            @endphp
            
            <!-- CSS Asset -->
            <link rel="stylesheet" href="{{ $cssUrl }}">
            
            <!-- Debug comment in production -->
            <!-- Asset URLs: CSS={{ $cssUrl }}, JS={{ $jsUrl }}, Base={{ $baseUrl }} -->
            
            <!-- JS Asset -->
            <script type="module" src="{{ $jsUrl }}"></script>
            
            <!-- Fallback CSS for critical styling -->
            <style>
                /* Fallback critical CSS if main stylesheet fails to load */
                .min-h-screen { min-height: 100vh; }
                .bg-gray-100 { background-color: #f7fafc; }
                .bg-white { background-color: #ffffff; }
                .shadow { box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); }
                .px-4 { padding-left: 1rem; padding-right: 1rem; }
                .py-6 { padding-top: 1.5rem; padding-bottom: 1.5rem; }
                .max-w-7xl { max-width: 80rem; }
                .mx-auto { margin-left: auto; margin-right: auto; }
            </style>
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
        
        @if(app()->environment('production') && config('app.debug'))
            <!-- Debug information in production with debug enabled -->
            <script>
                console.log('🔍 Asset Debug Info:', {
                    cssUrl: '{{ $cssUrl ?? "N/A" }}',
                    jsUrl: '{{ $jsUrl ?? "N/A" }}',
                    baseUrl: '{{ $baseUrl ?? "N/A" }}',
                    appUrl: '{{ config("app.url") }}',
                    environment: '{{ app()->environment() }}'
                });
            </script>
        @endif
    </body>
</html>
