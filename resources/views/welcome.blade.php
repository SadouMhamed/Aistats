<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-t8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Votre Solution d'Analyse de Données</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @if(app()->environment('production'))
        <!-- SOLUTION RENDER: CSS COMPLET INLINE - Page Welcome -->
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
            .bg-blue-600 { background-color: #2563eb; }
            .bg-blue-500 { background-color: #3b82f6; }
            .bg-blue-400 { background-color: #60a5fa; }
            .bg-green-400 { background-color: #4ade80; }
            
            /* TEXT COLORS */
            .text-gray-900 { color: #111827; }
            .text-gray-800 { color: #1f2937; }
            .text-gray-700 { color: #374151; }
            .text-gray-600 { color: #4b5563; }
            .text-gray-500 { color: #6b7280; }
            .text-gray-400 { color: #9ca3af; }
            .text-gray-300 { color: #d1d5db; }
            .text-gray-200 { color: #e5e7eb; }
            .text-white { color: #ffffff; }
            .text-blue-600 { color: #2563eb; }
            .text-blue-400 { color: #60a5fa; }
            
            /* SPACING */
            .p-1 { padding: 0.25rem; } .p-2 { padding: 0.5rem; } .p-6 { padding: 1.5rem; } .p-8 { padding: 2rem; }
            .px-3 { padding-left: 0.75rem; padding-right: 0.75rem; }
            .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
            .px-8 { padding-left: 2rem; padding-right: 2rem; }
            .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
            .py-24 { padding-top: 6rem; padding-bottom: 6rem; }
            .py-32 { padding-top: 8rem; padding-bottom: 8rem; }
            .pt-14 { padding-top: 3.5rem; }
            .pt-16 { padding-top: 4rem; }
            .pt-8 { padding-top: 2rem; }
            .pb-8 { padding-bottom: 2rem; }
            .ml-3 { margin-left: 0.75rem; }
            .mt-2 { margin-top: 0.5rem; }
            .mt-4 { margin-top: 1rem; }
            .mt-6 { margin-top: 1.5rem; }
            .mt-8 { margin-top: 2rem; }
            .mt-10 { margin-top: 2.5rem; }
            .mt-16 { margin-top: 4rem; }
            .mx-auto { margin-left: auto; margin-right: auto; }
            
            /* FLEXBOX */
            .flex { display: flex; }
            .items-center { align-items: center; }
            .justify-between { justify-content: space-between; }
            .justify-center { justify-content: center; }
            .space-x-4 > * + * { margin-left: 1rem; }
            .space-y-3 > * + * { margin-top: 0.75rem; }
            .gap-x-3 { column-gap: 0.75rem; }
            .gap-x-6 { column-gap: 1.5rem; }
            .gap-x-8 { column-gap: 2rem; }
            .gap-y-10 { row-gap: 2.5rem; }
            .gap-y-16 { row-gap: 4rem; }
            
            /* GRID */
            .grid { display: grid; }
            .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
            .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
            
            /* WIDTH & HEIGHT */
            .w-auto { width: auto; }
            .w-5 { width: 1.25rem; }
            .w-6 { width: 1.5rem; }
            .w-10 { width: 2.5rem; }
            .h-6 { height: 1.5rem; }
            .h-9 { height: 2.25rem; }
            .h-10 { height: 2.5rem; }
            .max-w-md { max-width: 28rem; }
            .max-w-xl { max-width: 36rem; }
            .max-w-2xl { max-width: 42rem; }
            .max-w-4xl { max-width: 56rem; }
            .max-w-7xl { max-width: 80rem; }
            
            /* BORDERS & SHADOWS */
            .rounded-md { border-radius: 0.375rem; }
            .rounded-lg { border-radius: 0.5rem; }
            .rounded-3xl { border-radius: 1.5rem; }
            .shadow-sm { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
            .ring-1 { box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.1); }
            .ring-2 { box-shadow: 0 0 0 2px #3b82f6; }
            
            /* BUTTONS & LINKS */
            .hover\\:bg-blue-500:hover { background-color: #3b82f6; }
            .hover\\:bg-white\\/20:hover { background-color: rgba(255, 255, 255, 0.2); }
            .hover\\:text-gray-200:hover { color: #e5e7eb; }
            
            /* POSITIONING */
            .absolute { position: absolute; }
            .relative { position: relative; }
            .inset-x-0 { left: 0; right: 0; }
            .top-0 { top: 0; }
            .left-0 { left: 0; }
            .z-50 { z-index: 50; }
            
            /* TEXT */
            .text-center { text-align: center; }
            .text-sm { font-size: 0.875rem; }
            .text-base { font-size: 1rem; }
            .text-lg { font-size: 1.125rem; }
            .text-xl { font-size: 1.25rem; }
            .text-3xl { font-size: 1.875rem; }
            .text-4xl { font-size: 2.25rem; }
            .text-6xl { font-size: 3.75rem; }
            .font-bold { font-weight: 700; }
            .font-semibold { font-weight: 600; }
            .leading-6 { line-height: 1.5; }
            .leading-7 { line-height: 1.75; }
            .leading-8 { line-height: 2; }
            .tracking-tight { letter-spacing: -0.025em; }
            
            /* UTILITIES */
            .block { display: block; }
            .flex-none { flex: none; }
            .antialiased { -webkit-font-smoothing: antialiased; }
            .isolate { isolation: isolate; }
            .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0; }
            
            /* RESPONSIVE */
            @media (min-width: 640px) {
                .sm\\:py-48 { padding-top: 12rem; padding-bottom: 12rem; }
                .sm\\:py-32 { padding-top: 8rem; padding-bottom: 8rem; }
                .sm\\:mt-20 { margin-top: 5rem; }
                .sm\\:text-4xl { font-size: 2.25rem; }
                .sm\\:text-6xl { font-size: 3.75rem; }
            }
            @media (min-width: 768px) {
                .md\\:max-w-2xl { max-width: 42rem; }
                .md\\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            }
            @media (min-width: 1024px) {
                .lg\\:px-8 { padding-left: 2rem; padding-right: 2rem; }
                .lg\\:py-56 { padding-top: 14rem; padding-bottom: 14rem; }
                .lg\\:flex { display: flex; }
                .lg\\:flex-1 { flex: 1 1 0%; }
                .lg\\:justify-end { justify-content: flex-end; }
                .lg\\:text-center { text-align: center; }
                .lg\\:max-w-4xl { max-width: 56rem; }
                .lg\\:max-w-none { max-width: none; }
                .lg\\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
                .lg\\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
                .lg\\:gap-y-16 { row-gap: 4rem; }
                .lg\\:mt-24 { margin-top: 6rem; }
                .lg\\:pt-32 { padding-top: 8rem; }
            }
            @media (min-width: 1280px) {
                .xl\\:p-10 { padding: 2.5rem; }
                .xl\\:mt-10 { margin-top: 2.5rem; }
            }
            
            /* HERO BACKGROUND */
            .hero-bg {
                background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop');
                background-size: cover;
                background-position: center;
            }
            
            /* RENDER FIX INDICATOR */
            .render-fix-active::before {
                content: "🏠 CSS Welcome Inline";
                position: fixed;
                bottom: 10px;
                right: 10px;
                background: #2563eb;
                color: white;
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 12px;
                z-index: 9999;
            }
        </style>
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        .hero-bg {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800 render-fix-active">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5 flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-white"/>
                        <span class="ml-3 text-lg font-bold text-white">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>
                <div class="lg:flex lg:flex-1 lg:justify-end space-x-4">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-white hover:text-gray-200">Connexion <span aria-hidden="true">&rarr;</span></a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">S'inscrire</a>
                    @endif
                </div>
            </nav>
        </header>

        <!-- Hero Section -->
        <div class="relative isolate px-6 pt-14 lg:px-8 hero-bg">
            <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Transformez vos données en décisions</h1>
                    <p class="mt-6 text-lg leading-8 text-gray-200">Téléchargez, analysez et visualisez vos fichiers de données (Excel, CSV, SPSS) en toute simplicité. Obtenez des informations précieuses et pilotez votre stratégie avec notre plateforme intuitive.</p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="{{ route('register') }}" class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Commencer gratuitement</a>
                        <a href="#features" class="text-sm font-semibold leading-6 text-white">Découvrir les fonctionnalités <span aria-hidden="true">↓</span></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <section id="features" class="py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:text-center">
                    <h2 class="text-base font-semibold leading-7 text-blue-600">Votre Workflow, Simplifié</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Tout ce dont vous avez besoin pour analyser vos données</p>
                    <p class="mt-6 text-lg leading-8 text-gray-600">De la collecte à la visualisation, notre plateforme est conçue pour être puissante, flexible et incroyablement facile à utiliser.</p>
                </div>
                <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                    <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                        <div class="relative pl-16">
                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l-3 3m3-3l3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.33-2.33 3 3 0 013.75 5.25" />
                                    </svg>
                                </div>
                                Téléchargement multi-format
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">Importez facilement vos fichiers de données, y compris Excel (.xlsx, .xls), CSV, PDF, Word et même les fichiers statistiques SPSS (.spss).</dd>
                        </div>
                        <div class="relative pl-16">
                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600">
                                     <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                    </svg>
                                </div>
                                Analyse Intelligente (Bientôt disponible)
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">Notre IA analyse vos données pour identifier les tendances, les corrélations et les anomalies, vous fournissant des insights exploitables en quelques secondes.</dd>
                        </div>
                        <div class="relative pl-16">
                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 100 15 7.5 7.5 0 000-15z" /><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197" />
                                    </svg>
                                </div>
                                Sécurité et confidentialité
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">Chaque utilisateur dispose d'un tableau de bord personnel et sécurisé. Vos données sont isolées et protégées à tout moment.</dd>
                        </div>
                        <div class="relative pl-16">
                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                </div>
                                Gestion Administrateur
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">Un panneau d'administration complet pour gérer les utilisateurs, superviser l'activité des fichiers et suivre les statistiques d'utilisation de la plateforme.</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        @php
        $packsData = [
            'packs' => [
                ['name' => 'Pack Essentiel', 'subtitle' => 'Test à la carte', 'icon' => '🧩', 'description' => 'Idéal pour des analyses ciblées et rapides sur des données déjà prêtes.', 'highlight' => false, 'cta' => 'Choisir Essentiel'],
                ['name' => 'Pack Protocole', 'subtitle' => 'Rédaction de protocole', 'icon' => '📋', 'description' => 'Pour concevoir et formaliser votre projet de recherche avec un protocole robuste.', 'highlight' => false, 'cta' => 'Choisir Protocole'],
                ['name' => 'Pack Méthodo', 'subtitle' => 'Protocole & Planification', 'icon' => '🎯', 'description' => 'Le plus populaire. Planifiez votre étude de A à Z et réalisez les analyses essentielles.', 'highlight' => true, 'cta' => 'Choisir Méthodo'],
                ['name' => 'Pack Expert', 'subtitle' => 'Accompagnement de A à Z', 'icon' => '🔬', 'description' => 'Un suivi complet, de la conceptualisation de l\'idée jusqu\'à la publication.', 'highlight' => false, 'cta' => 'Choisir Expert'],
            ],
            'features' => [
                'Élaboration de protocole complet' => [false, true, true, true],
                'Analyse descriptive' => [true, true, true, true],
                'Test t (comparaison de 2 moyennes)' => [true, false, true, true],
                'Test du Chi² (comparaison de pourcentages)' => [true, false, true, true],
                'ANOVA (plusieurs moyennes)' => [true, false, true, true],
                'Analyse multivariée' => [false, false, false, true],
                'Analyse de survie / Modèle de Cox' => [false, false, false, true],
                'Courbe ROC / Évaluation d\'un test diagnostique' => [false, false, false, true],
                'Visualisation des données (graphique & résumé)' => [true, true, true, true],
                'Calcul du nombre de sujets nécessaires' => [true, true, true, true],
                'Accompagnement sur plusieurs étapes' => [false, false, 'Protocole uniquement', 'Complet jusqu\'à publication'],
                'Réunions en présentiel (sur rendez-vous)' => [false, true, 'À la demande', 'Réunions régulières'],
            ]
        ];
        @endphp
        <section id="pricing" class="bg-gray-900 py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-base font-semibold leading-7 text-blue-400">Nos Offres</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">Des packs adaptés à chaque étape de votre recherche</p>
                    <p class="mt-6 text-lg leading-8 text-gray-300">Que vous ayez besoin d'une analyse ponctuelle ou d'un accompagnement complet, nous avons la solution.</p>
                </div>
                <div class="isolate mx-auto mt-16 grid max-w-md grid-cols-1 gap-8 md:max-w-2xl md:grid-cols-2 lg:max-w-none lg:grid-cols-4">
                    @foreach($packsData['packs'] as $index => $pack)
                        <div class="rounded-3xl p-8 ring-1 xl:p-10 {{ $pack['highlight'] ? 'bg-white/5 ring-2 ring-blue-500' : 'ring-white/10' }}">
                            <h3 class="text-lg font-semibold leading-8 text-white">{{ $pack['name'] }} <span class="text-2xl">{{ $pack['icon'] }}</span></h3>
                            <p class="mt-4 text-sm leading-6 text-gray-300">{{ $pack['description'] }}</p>
                            <a href="{{ route('register', ['pack' => $pack['name']]) }}" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 {{ $pack['highlight'] ? 'bg-blue-600 text-white shadow-sm hover:bg-blue-500 focus-visible:outline-blue-600' : 'bg-white/10 text-white hover:bg-white/20 focus-visible:outline-white' }}">{{ $pack['cta'] }}</a>
                            <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-300 xl:mt-10">
                                @foreach($packsData['features'] as $featureName => $availability)
                                    <li class="flex gap-x-3">
                                        @if($availability[$index] === true)
                                            <svg class="h-6 w-5 flex-none text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-white">{{ $featureName }}</span>
                                        @elseif($availability[$index] === false)
                                            <svg class="h-6 w-5 flex-none text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                            </svg>
                                            <span class="text-gray-400">{{ $featureName }}</span>
                                        @else
                                            <svg class="h-6 w-5 flex-none text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-white">{{ $featureName }} <span class="text-gray-400">({{ $availability[$index] }})</span></span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white" aria-labelledby="footer-heading">
            <h2 id="footer-heading" class="sr-only">Footer</h2>
            <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-32">
                <div class="mt-16 border-t border-white/10 pt-8 sm:mt-20 lg:mt-24">
                    <p class="text-xs leading-5 text-gray-400">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
