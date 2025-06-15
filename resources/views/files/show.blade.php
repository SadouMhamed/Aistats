<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $file->original_name }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('files.download', $file) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Télécharger
                </a>
                @if($file->user_id === auth()->id())
                    <a href="{{ route('files.edit', $file) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Modifier
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- File Preview -->
                        <div class="flex items-center justify-center bg-gray-50 rounded-lg p-8">
                            <div class="text-center">
                                <div class="text-8xl mb-4">{{ $file->file_icon }}</div>
                                <div class="text-lg font-medium text-gray-900">{{ $file->original_name }}</div>
                                <div class="text-sm text-gray-500">{{ strtoupper($file->file_extension) }} • {{ $file->formatted_size }}</div>
                            </div>
                        </div>

                        <!-- File Information -->
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Informations du fichier</h3>
                            </div>

                            <div class="space-y-3">
                                <div class="flex justify-between py-2 border-b">
                                    <span class="font-medium text-gray-600">Nom original:</span>
                                    <span class="text-gray-900">{{ $file->original_name }}</span>
                                </div>

                                <div class="flex justify-between py-2 border-b">
                                    <span class="font-medium text-gray-600">Type:</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ strtoupper($file->file_extension) }}
                                    </span>
                                </div>

                                <div class="flex justify-between py-2 border-b">
                                    <span class="font-medium text-gray-600">Taille:</span>
                                    <span class="text-gray-900">{{ $file->formatted_size }}</span>
                                </div>

                                <div class="flex justify-between py-2 border-b">
                                    <span class="font-medium text-gray-600">Statut:</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $file->status === 'uploaded' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($file->status) }}
                                    </span>
                                </div>

                                <div class="flex justify-between py-2 border-b">
                                    <span class="font-medium text-gray-600">Téléchargé le:</span>
                                    <span class="text-gray-900">{{ $file->created_at->format('d/m/Y à H:i') }}</span>
                                </div>

                                <div class="flex justify-between py-2 border-b">
                                    <span class="font-medium text-gray-600">Propriétaire:</span>
                                    <span class="text-gray-900">{{ $file->user->name }}</span>
                                </div>

                                @if($file->description)
                                    <div class="py-2">
                                        <span class="font-medium text-gray-600 block mb-2">Description:</span>
                                        <div class="text-gray-900 bg-gray-50 p-3 rounded">
                                            {{ $file->description }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between mt-8 pt-6 border-t">
                        <a href="{{ route('files.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            ← Retour à mes fichiers
                        </a>

                        @if($file->user_id === auth()->id())
                            <div class="space-x-2">
                                <a href="{{ route('files.edit', $file) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Modifier
                                </a>
                                <form method="POST" action="{{ route('files.destroy', $file) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier? Cette action est irréversible.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 