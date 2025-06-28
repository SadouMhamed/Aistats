<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Favicon -->
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📊</text></svg>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @if(app()->environment('production'))
            <!-- SOLUTION RENDER: CSS COMPLET INLINE - Marche TOUJOURS -->
            <style>
                /* RESET & BASE */
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif; line-height: 1.5; color: #111827; -webkit-font-smoothing: antialiased; }
                
                /* LAYOUT */
                .min-h-screen { min-height: 100vh; }
                .bg-gray-100 { background-color: #f3f4f6; }
                .bg-white { background-color: #ffffff; }
                .bg-gray-50 { background-color: #f9fafb; }
                .bg-gray-800 { background-color: #1f2937; }
                .bg-gray-900 { background-color: #111827; }
                .bg-indigo-600 { background-color: #4f46e5; }
                .bg-red-600 { background-color: #dc2626; }
                
                /* TEXT COLORS */
                .text-gray-900 { color: #111827; }
                .text-gray-700 { color: #374151; }
                .text-gray-600 { color: #4b5563; }
                .text-gray-500 { color: #6b7280; }
                .text-white { color: #ffffff; }
                .text-indigo-600 { color: #4f46e5; }
                .text-red-600 { color: #dc2626; }
                
                /* SPACING */
                .p-2 { padding: 0.5rem; }
                .p-4 { padding: 1rem; }
                .p-6 { padding: 1.5rem; }
                .px-2 { padding-left: 0.5rem; padding-right: 0.5rem; }
                .px-3 { padding-left: 0.75rem; padding-right: 0.75rem; }
                .px-4 { padding-left: 1rem; padding-right: 1rem; }
                .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
                .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
                .py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
                .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
                .py-6 { padding-top: 1.5rem; padding-bottom: 1.5rem; }
                .py-12 { padding-top: 3rem; padding-bottom: 3rem; }
                
                .m-2 { margin: 0.5rem; }
                .m-4 { margin: 1rem; }
                .mt-2 { margin-top: 0.5rem; }
                .mt-4 { margin-top: 1rem; }
                .mt-6 { margin-top: 1.5rem; }
                .mb-4 { margin-bottom: 1rem; }
                .mb-6 { margin-bottom: 1.5rem; }
                .mx-auto { margin-left: auto; margin-right: auto; }
                
                /* FLEXBOX */
                .flex { display: flex; }
                .flex-col { flex-direction: column; }
                .flex-row { flex-direction: row; }
                .items-center { align-items: center; }
                .items-start { align-items: flex-start; }
                .justify-center { justify-content: center; }
                .justify-between { justify-content: space-between; }
                .justify-start { justify-content: flex-start; }
                .justify-end { justify-content: flex-end; }
                .space-x-4 > * + * { margin-left: 1rem; }
                .space-y-4 > * + * { margin-top: 1rem; }
                
                /* GRID */
                .grid { display: grid; }
                .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
                .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
                .grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
                .gap-4 { gap: 1rem; }
                .gap-6 { gap: 1.5rem; }
                
                /* WIDTH & HEIGHT */
                .w-full { width: 100%; }
                .w-auto { width: auto; }
                .h-8 { height: 2rem; }
                .h-10 { height: 2.5rem; }
                .h-12 { height: 3rem; }
                .max-w-7xl { max-width: 80rem; }
                .max-w-lg { max-width: 32rem; }
                .max-w-md { max-width: 28rem; }
                
                /* BORDERS & SHADOWS */
                .border { border-width: 1px; border-color: #d1d5db; }
                .border-gray-300 { border-color: #d1d5db; }
                .border-gray-200 { border-color: #e5e7eb; }
                .rounded { border-radius: 0.25rem; }
                .rounded-md { border-radius: 0.375rem; }
                .rounded-lg { border-radius: 0.5rem; }
                .shadow { box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); }
                .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
                .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
                
                /* BUTTONS */
                .btn {
                    display: inline-flex;
                    align-items: center;
                    padding: 0.5rem 1rem;
                    border: 1px solid transparent;
                    border-radius: 0.375rem;
                    font-weight: 500;
                    text-decoration: none;
                    cursor: pointer;
                    transition: all 0.15s;
                }
                .btn-primary {
                    background-color: #4f46e5;
                    color: white;
                }
                .btn-primary:hover {
                    background-color: #4338ca;
                }
                .btn-secondary {
                    background-color: #6b7280;
                    color: white;
                }
                .btn-secondary:hover {
                    background-color: #4b5563;
                }
                
                /* FORMS */
                .form-input {
                    display: block;
                    width: 100%;
                    padding: 0.5rem 0.75rem;
                    border: 1px solid #d1d5db;
                    border-radius: 0.375rem;
                    background-color: white;
                    font-size: 0.875rem;
                }
                .form-input:focus {
                    outline: none;
                    border-color: #4f46e5;
                    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
                }
                .form-label {
                    display: block;
                    font-size: 0.875rem;
                    font-weight: 500;
                    color: #374151;
                    margin-bottom: 0.25rem;
                }
                
                /* NAVIGATION */
                .nav {
                    background-color: white;
                    border-bottom: 1px solid #e5e7eb;
                    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
                }
                .nav-container {
                    max-width: 80rem;
                    margin: 0 auto;
                    padding: 1rem 1.5rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                .nav-brand {
                    font-size: 1.25rem;
                    font-weight: 700;
                    color: #111827;
                    text-decoration: none;
                }
                .nav-menu {
                    display: flex;
                    gap: 2rem;
                    list-style: none;
                }
                .nav-link {
                    color: #374151;
                    text-decoration: none;
                    font-weight: 500;
                    padding: 0.5rem 1rem;
                    border-radius: 0.375rem;
                    transition: all 0.15s;
                }
                .nav-link:hover, .nav-link.active {
                    background-color: #f3f4f6;
                    color: #111827;
                }
                
                /* CARDS */
                .card {
                    background-color: white;
                    border-radius: 0.5rem;
                    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
                    padding: 1.5rem;
                }
                
                /* UTILITIES */
                .hidden { display: none; }
                .block { display: block; }
                .inline-block { display: inline-block; }
                .text-center { text-align: center; }
                .text-left { text-align: left; }
                .text-right { text-align: right; }
                .font-bold { font-weight: 700; }
                .font-medium { font-weight: 500; }
                .font-semibold { font-weight: 600; }
                .text-sm { font-size: 0.875rem; }
                .text-lg { font-size: 1.125rem; }
                .text-xl { font-size: 1.25rem; }
                .text-2xl { font-size: 1.5rem; }
                .antialiased { -webkit-font-smoothing: antialiased; }
                .leading-relaxed { line-height: 1.625; }
                
                /* RESPONSIVE - Mobile First */
                @media (min-width: 640px) {
                    .sm\\:px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
                    .sm\\:py-4 { padding-top: 1rem; padding-bottom: 1rem; }
                    .sm\\:text-sm { font-size: 0.875rem; }
                    .sm\\:max-w-md { max-width: 28rem; }
                    .sm\\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
                }
                @media (min-width: 1024px) {
                    .lg\\:px-8 { padding-left: 2rem; padding-right: 2rem; }
                    .lg\\:py-6 { padding-top: 1.5rem; padding-bottom: 1.5rem; }
                    .lg\\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
                }
                
                /* RENDER FIX INDICATOR */
                .render-fix-active::before {
                    content: "🎨 CSS Inline Actif";
                    position: fixed;
                    bottom: 10px;
                    right: 10px;
                    background: #10b981;
                    color: white;
                    padding: 4px 8px;
                    border-radius: 4px;
                    font-size: 12px;
                    z-index: 9999;
                }
            </style>
            
            <!-- Try to load built assets (but not critical anymore) -->
            @php
                $baseUrl = config('app.url') ?: ('https://' . request()->getHost());
                $baseUrl = str_replace('http://', 'https://', $baseUrl);
            @endphp
            <script type="module" src="{{ $baseUrl }}/build/assets/app-DaBYqt0m.js" onerror="console.log('JS asset failed, but CSS inline works')"></script>
        @else
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased render-fix-active">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
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
