<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-2xl font-bold text-blue-600">{{ $totalUsers }}</div>
                        <div class="text-sm text-gray-600">Total Users</div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-2xl font-bold text-green-600">{{ $adminUsers }}</div>
                        <div class="text-sm text-gray-600">Admin Users</div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-2xl font-bold text-purple-600">{{ $regularUsers }}</div>
                        <div class="text-sm text-gray-600">Regular Users</div>
                    </div>
                </div>
            </div>

            <!-- File Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-2xl font-bold text-orange-600">{{ $totalFiles }}</div>
                        <div class="text-sm text-gray-600">Total des fichiers</div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-2xl font-bold text-red-600">
                            @php
                                $sizeInMB = $totalFileSize / (1024 * 1024);
                                if ($sizeInMB >= 1024) {
                                    echo number_format($sizeInMB / 1024, 1) . ' GB';
                                } else {
                                    echo number_format($sizeInMB, 1) . ' MB';
                                }
                            @endphp
                        </div>
                        <div class="text-sm text-gray-600">Espace utilisé</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-2xl font-bold text-indigo-600">{{ $recentFiles }}</div>
                        <div class="text-sm text-gray-600">Fichiers (7 derniers jours)</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-2xl font-bold text-teal-600">{{ $usersWithFiles }}</div>
                        <div class="text-sm text-gray-600">Utilisateurs avec fichiers</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <h4 class="font-medium text-gray-700">Gestion des utilisateurs</h4>
                            <a href="{{ route('admin.users') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full justify-center">
                                👥 Gérer les utilisateurs
                            </a>
                        </div>
                        <div class="space-y-2">
                            <h4 class="font-medium text-gray-700">Gestion des fichiers</h4>
                            <div class="space-y-2">
                                <a href="{{ route('admin.files') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full justify-center">
                                    📁 Tous les fichiers
                                </a>
                                <a href="{{ route('admin.files.stats') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full justify-center">
                                    📊 Statistiques fichiers
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            🏠 Dashboard utilisateur
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 