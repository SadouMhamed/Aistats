<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mes Fichiers') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('files.pdf') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 {{ $files->count() == 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $files->count() == 0 ? 'onclick="event.preventDefault(); alert(\'Aucun fichier à exporter. Uploadez d\'abord des fichiers.\')"' : '' }}>
                    📄 Rapport PDF
                </a>
                <a href="{{ route('files.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    📁 Télécharger un fichier
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($files->count() > 0)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600">
                                <strong>Types supportés:</strong> 
                                @foreach($supportedExtensions as $ext)
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">{{ strtoupper($ext) }}</span>
                                @endforeach
                            </p>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fichier</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Taille</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Téléchargé le</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($files as $file)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="text-2xl mr-3">{{ $file->file_icon }}</span>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">{{ $file->original_name }}</div>
                                                    @if($file->description)
                                                        <div class="text-sm text-gray-500">{{ Str::limit($file->description, 50) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ strtoupper($file->file_extension) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $file->formatted_size }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $file->status === 'uploaded' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ ucfirst($file->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $file->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('files.show', $file) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                            <a href="{{ route('files.download', $file) }}" class="text-green-600 hover:text-green-900">Télécharger</a>
                                            <a href="{{ route('files.edit', $file) }}" class="text-yellow-600 hover:text-yellow-900">Modifier</a>
                                            <form method="POST" action="{{ route('files.destroy', $file) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $files->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">📁</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun fichier téléchargé</h3>
                            <p class="text-gray-500 mb-6">Commencez par télécharger votre premier fichier</p>
                            <a href="{{ route('files.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Télécharger un fichier
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 