<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le fichier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- File Info Display -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <span class="text-3xl mr-4">{{ $file->file_icon }}</span>
                            <div class="flex-1">
                                <div class="text-lg font-medium text-gray-900">{{ $file->original_name }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ strtoupper($file->file_extension) }} • {{ $file->formatted_size }} • Téléchargé le {{ $file->created_at->format('d/m/Y à H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('files.update', $file) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea 
                                id="description" 
                                name="description" 
                                rows="4" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="Ajoutez une description de votre fichier..."
                            >{{ old('description', $file->description) }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500">
                                Ajoutez une description pour vous aider à identifier ce fichier plus facilement.
                            </p>
                        </div>

                        <!-- File Information (Read-only) -->
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Informations du fichier (non modifiables)</h4>
                            <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Nom du fichier:</span>
                                    <span class="text-gray-900">{{ $file->original_name }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Type:</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ strtoupper($file->file_extension) }}
                                    </span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Taille:</span>
                                    <span class="text-gray-900">{{ $file->formatted_size }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Statut:</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $file->status === 'uploaded' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($file->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between">
                            <div class="space-x-2">
                                <a href="{{ route('files.show', $file) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Annuler
                                </a>
                                <a href="{{ route('files.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                    Retour à mes fichiers
                                </a>
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 