<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Statistiques des fichiers') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('admin.files') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    📁 Gestion des fichiers
                </a>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Main Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-3xl font-bold text-blue-600">{{ number_format($stats['total_files']) }}</div>
                        <div class="text-sm text-gray-600">Total des fichiers</div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-3xl font-bold text-green-600">
                            @php
                                $sizeInMB = $stats['total_size'] / (1024 * 1024);
                                if ($sizeInMB >= 1024) {
                                    echo number_format($sizeInMB / 1024, 2) . ' GB';
                                } else {
                                    echo number_format($sizeInMB, 1) . ' MB';
                                }
                            @endphp
                        </div>
                        <div class="text-sm text-gray-600">Espace total utilisé</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-3xl font-bold text-purple-600">{{ number_format($stats['users_with_files']) }}</div>
                        <div class="text-sm text-gray-600">Utilisateurs actifs</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-3xl font-bold text-orange-600">{{ number_format($stats['files_today']) }}</div>
                        <div class="text-sm text-gray-600">Fichiers aujourd'hui</div>
                    </div>
                </div>
            </div>

            <!-- Time-based Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Cette semaine</h3>
                        <div class="text-2xl font-bold text-blue-600">{{ number_format($stats['files_this_week']) }}</div>
                        <div class="text-sm text-gray-600">fichiers téléchargés</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Ce mois</h3>
                        <div class="text-2xl font-bold text-green-600">{{ number_format($stats['files_this_month']) }}</div>
                        <div class="text-sm text-gray-600">fichiers téléchargés</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Moyenne par utilisateur</h3>
                        <div class="text-2xl font-bold text-purple-600">
                            {{ $stats['users_with_files'] > 0 ? number_format($stats['total_files'] / $stats['users_with_files'], 1) : '0' }}
                        </div>
                        <div class="text-sm text-gray-600">fichiers par utilisateur</div>
                    </div>
                </div>
            </div>

            <!-- File Types Distribution -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-6">Répartition par type de fichier</h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        @foreach($stats['file_types'] as $type)
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <div class="text-4xl mb-3">
                                    @switch($type->file_extension)
                                        @case('pdf')
                                            📄
                                            @break
                                        @case('xlsx')
                                        @case('xls')
                                            📊
                                            @break
                                        @case('docx')
                                        @case('doc')
                                            📝
                                            @break
                                        @case('csv')
                                            📋
                                            @break
                                        @case('spss')
                                            🔢
                                            @break
                                        @default
                                            📁
                                    @endswitch
                                </div>
                                <div class="text-lg font-bold text-gray-900">{{ $type->count }}</div>
                                <div class="text-sm font-medium text-gray-900">{{ strtoupper($type->file_extension) }}</div>
                                <div class="text-xs text-gray-600">
                                    {{ $stats['total_files'] > 0 ? number_format(($type->count / $stats['total_files']) * 100, 1) : '0' }}%
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Top Uploaders -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-6">Top 5 utilisateurs les plus actifs</h3>
                    <div class="space-y-4">
                        @foreach($stats['top_uploaders'] as $index => $user)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-sm font-bold text-blue-600">#{{ $index + 1 }}</span>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-600">{{ $user->email }}</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-blue-600">{{ $user->files_count }}</div>
                                    <div class="text-sm text-gray-600">fichier(s)</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Recent Activity Summary -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-6">Activité récente</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-3">Croissance des téléchargements</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Aujourd'hui:</span>
                                    <span class="font-medium">{{ $stats['files_today'] }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Cette semaine:</span>
                                    <span class="font-medium">{{ $stats['files_this_week'] }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Ce mois:</span>
                                    <span class="font-medium">{{ $stats['files_this_month'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900 mb-3">Informations système</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Types supportés:</span>
                                    <span class="font-medium">{{ $stats['file_types']->count() }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Utilisateurs total:</span>
                                    <span class="font-medium">{{ \App\Models\User::count() }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Utilisateurs actifs:</span>
                                    <span class="font-medium">{{ $stats['users_with_files'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 