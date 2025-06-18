<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des utilisateurs') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Retour au tableau de bord
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-md" role="alert">
                    <p class="font-bold">Succès</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <h3 class="text-2xl font-bold text-gray-800 border-b pb-4 mb-6">Liste des utilisateurs</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Utilisateur</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Pack & Role</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Contact</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Date d'inscription</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">État Paiement</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($users as $user)
                                <tr class="hover:bg-gray-50 transition ease-in-out duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                {{-- Placeholder for user avatar --}}
                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-500 font-semibold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->nom }} {{ $user->prenom }}</div>
                                                <div class="text-sm text-gray-500">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->pack)
                                            <span class="px-2.5 py-1 text-xs font-semibold leading-5 rounded-full 
                                                @if($user->pack === 'Pack Méthodo') bg-blue-100 text-blue-800 
                                                @elseif($user->pack === 'Pack Expert') bg-purple-100 text-purple-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ $user->pack }}
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 text-xs font-semibold leading-5 rounded-full bg-gray-100 text-gray-800">Aucun</span>
                                        @endif
                                        <span class="ml-2 px-2.5 py-1 text-xs font-semibold leading-5 rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <div>{{ $user->email }}</div>
                                        <div class="text-gray-500">{{ $user->telephone ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form method="POST" action="{{ route('admin.users.update_payment_status', $user) }}">
                                            @csrf
                                            @php
                                                $status = $user->payment_status;
                                                $statusClass = '';
                                                if ($status === 'Payé') $statusClass = 'bg-green-100 text-green-800 border-green-300';
                                                elseif ($status === 'En attente') $statusClass = 'bg-yellow-100 text-yellow-800 border-yellow-300';
                                                elseif ($status === 'Échoué') $statusClass = 'bg-red-100 text-red-800 border-red-300';
                                                elseif ($status === 'Annulé') $statusClass = 'bg-gray-100 text-gray-800 border-gray-300';
                                                elseif ($status === 'Remboursé') $statusClass = 'bg-purple-100 text-purple-800 border-purple-300';
                                            @endphp
                                            <select name="payment_status" onchange="this.form.submit()" class="block w-full pl-3 pr-10 py-1.5 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md {{ $statusClass }}">
                                                <option value="En attente" {{ $status === 'En attente' ? 'selected' : '' }}>En attente</option>
                                                <option value="Payé" {{ $status === 'Payé' ? 'selected' : '' }}>Payé</option>
                                                <option value="Échoué" {{ $status === 'Échoué' ? 'selected' : '' }}>Échoué</option>
                                                <option value="Annulé" {{ $status === 'Annulé' ? 'selected' : '' }}>Annulé</option>
                                                <option value="Remboursé" {{ $status === 'Remboursé' ? 'selected' : '' }}>Remboursé</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-4">
                                            <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Détails</a>
                                            @if($user->id !== auth()->id())
                                                <form method="POST" action="{{ route('admin.users.update_role', $user) }}">
                                                    @csrf
                                                    <select name="role" onchange="this.form.submit()" class="block w-full pl-3 pr-10 py-1.5 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                    </select>
                                                </form>
                                            @else
                                                <span class="text-xs text-gray-500 italic">Vous</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-12">
                                        <div class="text-gray-500">
                                            <p class="text-lg font-semibold">Aucun utilisateur trouvé</p>
                                            <p class="mt-2">Il semble qu'il n'y ait pas encore d'utilisateurs enregistrés.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($users->hasPages())
                        <div class="mt-6 p-4 bg-gray-50 rounded-b-lg">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 