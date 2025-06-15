<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de l\'utilisateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="printable-area p-6 md:p-8 text-gray-900">
                    
                    {{-- Header with User Name and Actions --}}
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 border-b pb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                        <div class="no-print mt-4 md:mt-0 flex items-center space-x-2">
                            <a href="{{ route('admin.users') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                                Retour
                            </a>
                            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Imprimer
                            </button>
                            <a href="{{ route('admin.users.pdf', $user) }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                PDF
                            </a>
                        </div>
                    </div>

                    {{-- User Information Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-600">Informations Personnelles</h4>
                            <dl class="mt-2 divide-y divide-gray-200">
                                <div class="py-2 flex justify-between"><dt class="text-sm text-gray-500">Nom Complet</dt><dd class="text-sm font-medium text-gray-800">{{ $user->nom }} {{ $user->prenom }}</dd></div>
                                <div class="py-2 flex justify-between"><dt class="text-sm text-gray-500">Profession</dt><dd class="text-sm font-medium text-gray-800">{{ $user->profession ?? 'N/A' }}</dd></div>
                                <div class="py-2 flex justify-between"><dt class="text-sm text-gray-500">Téléphone</dt><dd class="text-sm font-medium text-gray-800">{{ $user->telephone ?? 'N/A' }}</dd></div>
                            </dl>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-600">Informations du Compte</h4>
                            <dl class="mt-2 divide-y divide-gray-200">
                                <div class="py-2 flex justify-between"><dt class="text-sm text-gray-500">Pack</dt><dd class="text-sm font-medium text-gray-800">{{ $user->pack ?? 'N/A' }}</dd></div>
                                <div class="py-2 flex justify-between"><dt class="text-sm text-gray-500">Rôle</dt><dd class="text-sm font-medium text-gray-800">{{ ucfirst($user->role) }}</dd></div>
                                <div class="py-2 flex justify-between"><dt class="text-sm text-gray-500">Membre depuis</dt><dd class="text-sm font-medium text-gray-800">{{ $user->created_at->format('d M, Y') }}</dd></div>
                                <div class="py-2 flex justify-between"><dt class="text-sm text-gray-500">Email Verifié</dt><dd class="text-sm font-medium text-gray-800">{{ $user->email_verified_at ? $user->email_verified_at->format('d M, Y') : 'Non' }}</dd></div>
                            </dl>
                        </div>
                    </div>

                    {{-- User Files List --}}
                    <div class="mt-8">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Fichiers Téléchargés</h4>
                        @if($user->files->count() > 0)
                            <div class="overflow-x-auto border rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom du fichier</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Taille</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date de dépôt</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($user->files as $file)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $file->original_name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($file->file_size / 1024, 2) }} KB</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $file->created_at->format('d M, Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-8 bg-gray-50 rounded-lg">
                                <p class="text-gray-500">Cet utilisateur n'a téléchargé aucun fichier.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .printable-area, .printable-area * {
                visibility: visible;
            }
            .printable-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</x-app-layout> 