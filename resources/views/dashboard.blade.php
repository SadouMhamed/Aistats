<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        {{ __("You're logged in!") }}
                    </div>
                    
                    <div class="text-sm text-gray-600 mb-4">
                        Welcome back, <strong>{{ auth()->user()->name }}</strong>!
                        Your role: <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ auth()->user()->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </div>

                    @if(auth()->user()->isAdmin())
                        <div class="border-t pt-4">
                            <h3 class="text-lg font-medium mb-3">Admin Actions</h3>
                            <div class="space-x-4">
                                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Admin Dashboard
                                </a>
                                <a href="{{ route('admin.users') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Manage Users
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- File Management Section -->
                    <div class="border-t pt-4">
                        <h3 class="text-lg font-medium mb-3">Gestion des fichiers</h3>
                        <div class="space-x-4">
                            <a href="{{ route('files.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                📁 Mes Fichiers
                            </a>
                            <a href="{{ route('files.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                ⬆️ Télécharger un fichier
                            </a>
                        </div>
                        <div class="mt-3 text-sm text-gray-600">
                            <p>
                                <strong>Types supportés:</strong> 
                                <span class="space-x-1">
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">PDF</span>
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">EXCEL</span>
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">WORD</span>
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">CSV</span>
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">SPS</span>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
