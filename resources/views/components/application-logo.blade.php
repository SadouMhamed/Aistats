@props(['class' => ''])

@if(file_exists(public_path('images/logo.png')))
    {{-- Si le logo existe, l'utiliser --}}
    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" {{ $attributes->merge(['class' => $class]) }}>
@elseif(file_exists(public_path('images/logo.svg')))
    {{-- Si un logo SVG existe, l'utiliser --}}
    <img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', 'Laravel') }}" {{ $attributes->merge(['class' => $class]) }}>
@else
    {{-- Logo de remplacement avec le nom de l'entreprise --}}
    <div {{ $attributes->merge(['class' => 'flex items-center ' . $class]) }}>
        <div class="px-3 py-2 font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg">
            <span class="text-lg">📊</span>
            <span class="ml-1">{{ config('app.name', 'NvAiStat') }}</span>
        </div>
    </div>
@endif
