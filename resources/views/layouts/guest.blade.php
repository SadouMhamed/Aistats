<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @if(app()->environment('production'))
            <!-- Production Assets with Render.com compatibility + CDN Fallback -->
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
            
            <!-- Try to load our built CSS first -->
            <link rel="stylesheet" href="{{ $cssUrl }}" onerror="this.onerror=null; console.log('Guest CSS failed to load, using CDN fallback');">
            
            <!-- Tailwind CDN as immediate fallback (works always) -->
            <script src="https://cdn.tailwindcss.com"></script>
            
            <!-- Custom Tailwind configuration for CDN -->
            <script>
                tailwind.config = {
                    theme: {
                        extend: {
                            fontFamily: {
                                sans: ['Figtree', 'ui-sans-serif', 'system-ui'],
                            },
                        }
                    }
                }
            </script>
            
            <!-- JS Asset -->
            <script type="module" src="{{ $jsUrl }}"></script>
            
            <!-- Critical CSS for immediate rendering -->
            <style>
                /* Critical CSS that loads immediately */
                body { font-family: 'Figtree', ui-sans-serif, system-ui; }
                .min-h-screen { min-height: 100vh; }
                .bg-gray-100 { background-color: #f3f4f6; }
                .bg-white { background-color: #ffffff; }
                .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
                .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
                .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
                .mt-6 { margin-top: 1.5rem; }
                .w-full { width: 100%; }
                .flex { display: flex; }
                .flex-col { flex-direction: column; }
                .items-center { align-items: center; }
                .justify-center { justify-content: center; }
                .antialiased { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
                .text-gray-900 { color: #111827; }
                .pt-6 { padding-top: 1.5rem; }
                .overflow-hidden { overflow: hidden; }
            </style>
        @else
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        
        @if(app()->environment('production') && config('app.debug'))
            <!-- Debug information in production with debug enabled -->
            <script>
                console.log('🔍 Guest Layout Asset Debug:', {
                    cssUrl: '{{ $cssUrl ?? "N/A" }}',
                    jsUrl: '{{ $jsUrl ?? "N/A" }}',
                    baseUrl: '{{ $baseUrl ?? "N/A" }}',
                    appUrl: '{{ config("app.url") }}',
                    environment: '{{ app()->environment() }}',
                    fallback: 'Tailwind CDN active'
                });
            </script>
        @endif
    </body>
</html>
