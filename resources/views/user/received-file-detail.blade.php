<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails du Fichier Reçu') }}
            </h2>
            <a href="{{ route('received_files.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Retour à la Liste
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Permission Status Alert -->
                    @if(!$adminUserFile->download_permission)
                        <div class="mb-6 bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">🔒 Téléchargement en attente d'autorisation</span>
                            </div>
                            <p class="mt-1 text-sm">L'administrateur doit d'abord autoriser le téléchargement de ce fichier.</p>
                        </div>
                    @endif

                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- File Information -->
                        <div>
                            <div class="flex items-center mb-6">
                                <div class="h-16 w-16 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                                    <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $adminUserFile->original_name }}</h3>
                                    <div class="flex items-center space-x-2 mt-1">
                                        @if(!$adminUserFile->is_read)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Nouveau
                                            </span>
                                        @endif
                                        @if($adminUserFile->download_permission)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                ✓ Autorisé
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">
                                                🔒 En attente
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-gray-700 mb-2">Informations du Fichier</h4>
                                    <dl class="space-y-2">
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Nom:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ $adminUserFile->original_name }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Taille:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ $adminUserFile->file_size_formatted }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Type:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ $adminUserFile->file_type }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Reçu le:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ $adminUserFile->created_at->format('d/m/Y à H:i') }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Statut de téléchargement:</dt>
                                            <dd class="text-sm font-medium {{ $adminUserFile->download_permission ? 'text-green-600' : 'text-orange-600' }}">
                                                {{ $adminUserFile->download_permission ? 'Autorisé' : 'En attente d\'autorisation' }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>

                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-gray-700 mb-2">Expéditeur</h4>
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                            <span class="text-sm font-medium text-blue-800">
                                                {{ strtoupper(substr($adminUserFile->admin->name, 0, 2)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $adminUserFile->admin->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $adminUserFile->admin->email }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Message and Actions -->
                        <div>
                            @if($adminUserFile->message)
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                                    <h4 class="font-semibold text-blue-800 mb-2">Message de l'Administrateur</h4>
                                    <p class="text-blue-700">{{ $adminUserFile->message }}</p>
                                </div>
                            @endif

                            <div class="space-y-4">
                                @if($adminUserFile->download_permission)
                                    <a href="{{ route('received_files.download', $adminUserFile) }}" 
                                       class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg text-center block">
                                        <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Télécharger le Fichier
                                    </a>
                                @else
                                    <button disabled 
                                            class="w-full bg-gray-300 text-gray-500 font-bold py-3 px-4 rounded-lg text-center cursor-not-allowed" 
                                            title="En attente d'autorisation de l'administrateur">
                                        <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        Téléchargement Bloqué
                                    </button>
                                    <div class="text-center text-sm text-orange-600">
                                        <p>🔒 Contactez l'administrateur pour autoriser le téléchargement</p>
                                    </div>
                                @endif

                                <a href="{{ route('received_files.index') }}" 
                                   class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded-lg text-center block">
                                    <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Retour à la Liste
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 