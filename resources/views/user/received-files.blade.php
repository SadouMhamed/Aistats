<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fichiers Reçus de l\'Administrateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($receivedFiles->count() > 0)
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($receivedFiles as $file)
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                    <div class="p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex-shrink-0">
                                                <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                @if(!$file->is_read)
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                        Nouveau
                                                    </span>
                                                @endif
                                                @if($file->download_permission)
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
                                        
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                                            {{ $file->original_name }}
                                        </h3>
                                        
                                        <div class="text-sm text-gray-500 mb-4">
                                            <p><strong>De:</strong> {{ $file->admin->name }}</p>
                                            <p><strong>Taille:</strong> {{ $file->file_size_formatted }}</p>
                                            <p><strong>Reçu le:</strong> {{ $file->created_at->format('d/m/Y H:i') }}</p>
                                        </div>

                                        @if($file->message)
                                            <div class="bg-gray-50 rounded-md p-3 mb-4">
                                                <p class="text-sm text-gray-700">
                                                    <strong>Message:</strong><br>
                                                    {{ $file->message }}
                                                </p>
                                            </div>
                                        @endif

                                        <div class="flex space-x-3">
                                            @if($file->download_permission)
                                                <a href="{{ route('received_files.show', $file) }}" 
                                                   class="flex-1 bg-blue-500 hover:bg-blue-700 text-white text-center py-2 px-4 rounded text-sm">
                                                    Voir
                                                </a>
                                                <a href="{{ route('received_files.download', $file) }}" 
                                                   class="flex-1 bg-green-500 hover:bg-green-700 text-white text-center py-2 px-4 rounded text-sm">
                                                    Télécharger
                                                </a>
                                            @else
                                                <button disabled 
                                                        class="flex-1 bg-gray-300 text-gray-500 text-center py-2 px-4 rounded text-sm cursor-not-allowed" 
                                                        title="En attente d'autorisation de l'administrateur">
                                                    Voir
                                                </button>
                                                <button disabled 
                                                        class="flex-1 bg-gray-300 text-gray-500 text-center py-2 px-4 rounded text-sm cursor-not-allowed" 
                                                        title="En attente d'autorisation de l'administrateur">
                                                    Télécharger
                                                </button>
                                            @endif
                                        </div>

                                        @if(!$file->download_permission)
                                            <div class="mt-3 text-center">
                                                <p class="text-xs text-orange-600">
                                                    🔒 En attente d'autorisation de l'administrateur
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $receivedFiles->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun fichier reçu</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Vous n'avez encore reçu aucun fichier de l'administrateur.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 