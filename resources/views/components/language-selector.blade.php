@php
    $currentLocale = app()->getLocale();
    $availableLocales = config('app.available_locales');
@endphp

<div class="relative" x-data="{ open: false }">
    <!-- Bouton avec indicateur de langue actuelle -->
    <button @click="open = !open" class="flex items-center px-3 py-2 space-x-2 text-white rounded-lg transition-colors hover:text-gray-200 focus:outline-none bg-white/10 hover:bg-white/20">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
        </svg>
        <span class="hidden font-medium sm:block">{{ $availableLocales[$currentLocale] ?? 'Français' }}</span>
        <span class="text-xs font-bold sm:hidden">{{ strtoupper($currentLocale) }}</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <!-- Dropdown avec animation -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         @click.away="open = false"
         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 {{ app()->getLocale() === 'ar' ? 'left-0 right-auto' : 'right-0' }}">
        
        @foreach($availableLocales as $locale => $name)
        <a href="{{ route('language.change', $locale) }}" 
           class="flex items-center justify-between px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ $currentLocale === $locale ? 'bg-blue-50 text-blue-600 font-medium' : '' }}"
           @click="open = false">
            <span class="{{ $locale === 'ar' ? 'font-arabic' : '' }}">{{ $name }}</span>
            @if($currentLocale === $locale)
                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
            @endif
        </a>
        @endforeach
    </div>
</div> 