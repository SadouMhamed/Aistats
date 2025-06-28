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
                    @if(isset($isAdminPreview) && $isAdminPreview)
                    <div class="mb-4 p-3 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded">
                        <div class="flex items-center">
                            <span class="text-lg mr-2">👁️</span>
                            <span><strong>Mode Prévisualisation Admin</strong> - Vous visualisez le dashboard du point de vue utilisateur</span>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 underline">← Retour au Dashboard Admin</a>
                        </div>
                    </div>
                    @endif
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">👋 Bienvenue, {{ auth()->user()->name }} !</h3>
                        <p class="text-gray-600">Voici un aperçu de votre activité</p>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ $totalFiles }}</div>
                            <div class="text-sm text-blue-800">Fichiers uploadés</div>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ number_format($totalSize / (1024*1024), 1) }} MB</div>
                            <div class="text-sm text-green-800">Taille totale</div>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-yellow-600">{{ $recentFiles }}</div>
                            <div class="text-sm text-yellow-800">Cette semaine</div>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600">{{ $unreadReceivedFiles }}</div>
                            <div class="text-sm text-purple-800">Fichiers non lus</div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- File Management -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold mb-3 text-gray-800">📁 Gestion des fichiers</h4>
                            <div class="space-y-2">
                                <a href="{{ route('files.index') }}" class="flex items-center text-blue-600 hover:text-blue-800">
                                    📋 Voir tous mes fichiers ({{ $totalFiles }})
                                </a>
                                <a href="{{ route('files.create') }}" class="flex items-center text-green-600 hover:text-green-800">
                                    ⬆️ Télécharger un nouveau fichier
                                </a>
                                @if($totalFiles > 0)
                                <a href="{{ route('files.pdf') }}" class="flex items-center text-red-600 hover:text-red-800">
                                    📄 Générer rapport PDF
                                </a>
                                @endif
                            </div>
                            <div class="mt-3 text-xs text-gray-500">
                                <p><strong>Types supportés:</strong> PDF, Excel, Word, CSV, SPSS</p>
                            </div>
                        </div>

                        <!-- Received Files -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold mb-3 text-gray-800">📨 Fichiers reçus</h4>
                            @if($receivedFiles->count() > 0)
                                <div class="space-y-2">
                                    <a href="{{ route('received_files.index') }}" class="flex items-center text-purple-600 hover:text-purple-800">
                                        📥 Voir tous les fichiers reçus
                                        @if($unreadReceivedFiles > 0)
                                            <span class="ml-2 bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">{{ $unreadReceivedFiles }} nouveau(x)</span>
                                        @endif
                                    </a>
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">Aucun fichier reçu</p>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Files -->
                    @if($latestFiles->count() > 0)
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="font-semibold text-gray-800">📊 Fichiers récents</h4>
                            <a href="{{ route('files.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Voir tout</a>
                        </div>
                        <div class="bg-white border rounded-lg overflow-hidden">
                            @foreach($latestFiles as $file)
                            <div class="border-b last:border-b-0 p-3 hover:bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="text-lg mr-3">{{ $file->icon }}</span>
                                        <div>
                                            <div class="font-medium text-sm">{{ $file->original_name }}</div>
                                            <div class="text-xs text-gray-500">{{ $file->created_at->diffForHumans() }} • {{ $file->formatted_size }}</div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('files.show', $file) }}" class="text-blue-600 hover:text-blue-800 text-xs">Voir</a>
                                        <a href="{{ route('files.download', $file) }}" class="text-green-600 hover:text-green-800 text-xs">Télécharger</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- File Types Breakdown -->
                    @if($fileTypes->count() > 0)
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-800 mb-3">📈 Répartition par type</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($fileTypes as $fileType)
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                    {{ strtoupper($fileType->file_extension) }}: {{ $fileType->count }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
