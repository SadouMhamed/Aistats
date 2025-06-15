<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des fichiers (Admin)') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('admin.files.stats') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    📊 Statistiques
                </a>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Retour Dashboard
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

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-2xl font-bold text-blue-600">{{ $totalFiles }}</div>
                        <div class="text-sm text-gray-600">Total des fichiers</div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-2xl font-bold text-green-600">
                            @php
                                $sizeInMB = $totalSize / (1024 * 1024);
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
                        <div class="text-2xl font-bold text-purple-600">{{ $fileTypes->count() }}</div>
                        <div class="text-sm text-gray-600">Types de fichiers</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-2xl font-bold text-orange-600">
                            {{ \App\Models\User::has('files')->count() }}
                        </div>
                        <div class="text-sm text-gray-600">Utilisateurs actifs</div>
                    </div>
                </div>
            </div>

            <!-- File Types Summary -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Répartition par type de fichier</h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        @foreach($fileTypes as $type)
                            <div class="text-center p-3 bg-gray-50 rounded">
                                <div class="text-2xl mb-2">
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
                                        @case('sps')
                                            🔢
                                            @break
                                        @default
                                            📁
                                    @endswitch
                                </div>
                                <div class="text-sm font-medium text-gray-900">{{ strtoupper($type->file_extension) }}</div>
                                <div class="text-xs text-gray-600">{{ $type->count }} fichier(s)</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Files Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Tous les fichiers</h3>
                        <div class="text-sm text-gray-600">
                            {{ $files->total() }} fichier(s) au total
                        </div>
                    </div>

                    @if($files->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fichier</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Taille</th>
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
                                            <div class="text-sm text-gray-900">{{ $file->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $file->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ strtoupper($file->file_extension) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $file->formatted_size }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $file->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('files.show', $file) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                            <a href="{{ route('files.download', $file) }}" class="text-green-600 hover:text-green-900">Télécharger</a>
                                            <form method="POST" action="{{ route('admin.files.delete', $file) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier? Cette action est irréversible.')">
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
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun fichier trouvé</h3>
                            <p class="text-gray-500">Aucun utilisateur n'a encore téléchargé de fichier.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 