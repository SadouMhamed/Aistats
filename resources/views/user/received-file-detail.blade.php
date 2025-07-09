<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Détails du Fichier Reçu') }}
            </h2>
            <a href="{{ route('user.received_files.index') }}" 
               class="px-4 py-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                Retour à la Liste
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Permission Status Alert -->
                    @if(!$adminUserFile->download_permission)
                        <div class="px-4 py-3 mb-6 text-orange-700 bg-orange-100 rounded border border-orange-400">
                            <div class="flex items-center">
                                <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">🔒 Téléchargement en attente d'autorisation</span>
                            </div>
                            <p class="mt-1 text-sm">L'administrateur doit d'abord autoriser le téléchargement de ce fichier.</p>
                        </div>
                    @endif

                    <div class="grid gap-8 md:grid-cols-2">
                        <!-- File Information -->
                        <div>
                            <div class="flex items-center mb-6">
                                <div class="flex justify-center items-center mr-4 w-16 h-16 bg-indigo-100 rounded-full">
                                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $adminUserFile->original_name }}</h3>
                                    <div class="flex items-center mt-1 space-x-2">
                                        @if(!$adminUserFile->is_read)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                                Nouveau
                                            </span>
                                        @endif
                                        @if($adminUserFile->download_permission)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                ✓ Autorisé
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold text-orange-800 bg-orange-100 rounded-full">
                                                🔒 En attente
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <h4 class="mb-2 font-semibold text-gray-700">Informations du Fichier</h4>
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

                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <h4 class="mb-2 font-semibold text-gray-700">Expéditeur</h4>
                                    <div class="flex items-center">
                                        <div class="flex justify-center items-center mr-3 w-10 h-10 bg-blue-100 rounded-full">
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
                                <div class="p-4 mb-6 bg-blue-50 rounded-lg border border-blue-200">
                                    <h4 class="mb-2 font-semibold text-blue-800">Message de l'Administrateur</h4>
                                    <p class="text-blue-700">{{ $adminUserFile->message }}</p>
                                </div>
                            @endif

                            <div class="space-y-4">
                                @if($adminUserFile->download_permission)
                                    <a href="{{ route('user.received_files.download', $adminUserFile) }}" 
                                       class="block px-4 py-3 w-full font-bold text-center text-white bg-green-500 rounded-lg hover:bg-green-700">
                                        <svg class="inline-block mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Télécharger le Fichier
                                    </a>
                                @else
                                    <button disabled 
                                            class="px-4 py-3 w-full font-bold text-center text-gray-500 bg-gray-300 rounded-lg cursor-not-allowed" 
                                            title="En attente d'autorisation de l'administrateur">
                                        <svg class="inline-block mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        Téléchargement Bloqué
                                    </button>
                                    <div class="text-sm text-center text-orange-600">
                                        <p>🔒 Contactez l'administrateur pour autoriser le téléchargement</p>
                                    </div>
                                @endif

                                <a href="{{ route('user.received_files.index') }}" 
                                   class="block px-4 py-3 w-full font-bold text-center text-white bg-gray-500 rounded-lg hover:bg-gray-700">
                                    <svg class="inline-block mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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