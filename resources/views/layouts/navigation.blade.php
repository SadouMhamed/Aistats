<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <!-- File Management Links for All Users -->
                    <x-nav-link :href="route('files.index')" :active="request()->routeIs('files.*')">
                        📁 {{ __('Mes Fichiers') }}
                    </x-nav-link>

                    <!-- User Received Files Link -->
                    @if(!auth()->user()->isAdmin())
                        <x-nav-link :href="route('user.received_files.index')" :active="request()->routeIs('user.received_files.*')">
                            📨 {{ __('Fichiers Reçus') }}
                        </x-nav-link>
                        
                        <!-- Client Devis & Factures Links -->
                        <x-nav-link :href="route('client.devis.index')" :active="request()->routeIs('client.devis.*')">
                            📄 {{ __('Mes Devis') }}
                        </x-nav-link>
                        <x-nav-link :href="route('client.factures.index')" :active="request()->routeIs('client.factures.*')">
                            🧾 {{ __('Mes Factures') }}
                        </x-nav-link>
                    @endif

                    <!-- Admin Navigation Links -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                    
                    @if(auth()->user()->isAdmin())
                        <x-dropdown align="top" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    🔧 {{ __('Admin') }}
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.dashboard')">
                                    🏠 {{ __('Admin Dashboard') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.users')">
                                    👥 {{ __('Gérer les utilisateurs') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.files')">
                                    📁 {{ __('Tous les fichiers') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.files.stats')">
                                    📊 {{ __('Statistiques fichiers') }}
                                </x-dropdown-link>
                                <div class="border-t border-gray-100"></div>
                                <x-dropdown-link :href="route('admin.send_file')">
                                    📤 {{ __('Envoyer un fichier') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.sent_files')">
                                    📋 {{ __('Fichiers envoyés') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @endif
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Role Badge -->
                @if(auth()->user()->isAdmin())
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 mr-4">
                        Admin
                    </span>
                @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- File Management Quick Links -->
                        <div class="border-t border-gray-100"></div>
                        <x-dropdown-link :href="route('files.index')">
                            📁 {{ __('Mes Fichiers') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('files.create')">
                            ⬆️ {{ __('Télécharger un fichier') }}
                        </x-dropdown-link>
                        @if(!auth()->user()->isAdmin())
                            <x-dropdown-link :href="route('user.received_files.index')">
                                📨 {{ __('Fichiers Reçus') }}
                            </x-dropdown-link>
                            
                            <!-- Client Devis & Factures Quick Links -->
                            <div class="border-t border-gray-100"></div>
                            <div class="px-4 py-2 text-xs text-gray-400 uppercase tracking-wide">
                                {{ __('Devis & Factures') }}
                            </div>
                            <x-dropdown-link :href="route('client.devis.index')">
                                📄 {{ __('Mes Devis') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('client.factures.index')">
                                🧾 {{ __('Mes Factures') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Admin Quick Links -->
                        @if(auth()->user()->isAdmin())
                            <div class="border-t border-gray-100"></div>
                            <div class="px-4 py-2 text-xs text-gray-400 uppercase tracking-wide">
                                {{ __('Administration') }}
                            </div>
                            <x-dropdown-link :href="route('admin.dashboard')">
                                🏠 {{ __('Admin Dashboard') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.users')">
                                👥 {{ __('Gérer les utilisateurs') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.files')">
                                📁 {{ __('Tous les fichiers') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.files.stats')">
                                📊 {{ __('Statistiques fichiers') }}
                            </x-dropdown-link>
                            <div class="border-t border-gray-100"></div>
                            <x-dropdown-link :href="route('admin.send_file')">
                                📤 {{ __('Envoyer un fichier') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.sent_files')">
                                📋 {{ __('Fichiers envoyés') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <div class="border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            <!-- File Management Links for Mobile -->
            <x-responsive-nav-link :href="route('files.index')" :active="request()->routeIs('files.*')">
                📁 {{ __('Mes Fichiers') }}
            </x-responsive-nav-link>
            
            <!-- User Received Files Link for Mobile -->
            @if(!auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('user.received_files.index')" :active="request()->routeIs('user.received_files.*')">
                    📨 {{ __('Fichiers Reçus') }}
                </x-responsive-nav-link>
                
                <!-- Client Devis & Factures Links for Mobile -->
                <x-responsive-nav-link :href="route('client.devis.index')" :active="request()->routeIs('client.devis.*')">
                    📄 {{ __('Mes Devis') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('client.factures.index')" :active="request()->routeIs('client.factures.*')">
                    🧾 {{ __('Mes Factures') }}
                </x-responsive-nav-link>
            @endif

            <!-- Admin Links for Mobile -->
            @if(auth()->user()->isAdmin())
                <div class="pt-2 border-t border-gray-200">
                    <div class="px-4 py-2 text-xs text-gray-400 uppercase tracking-wide">
                        {{ __('Administration') }}
                    </div>
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        🏠 {{ __('Admin Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">
                        👥 {{ __('Gérer les utilisateurs') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.files')" :active="request()->routeIs('admin.files')">
                        📁 {{ __('Tous les fichiers') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.files.stats')" :active="request()->routeIs('admin.files.stats')">
                        📊 {{ __('Statistiques fichiers') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.send_file')" :active="request()->routeIs('admin.send_file')">
                        📤 {{ __('Envoyer un fichier') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.sent_files')" :active="request()->routeIs('admin.sent_files')">
                        📋 {{ __('Fichiers envoyés') }}
                    </x-responsive-nav-link>
                </div>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @if(auth()->user()->isAdmin())
                    <div class="text-xs text-red-600 font-medium">{{ __('Administrateur') }}</div>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('files.create')">
                    ⬆️ {{ __('Télécharger un fichier') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
