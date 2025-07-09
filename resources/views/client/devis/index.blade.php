<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Devis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Messages de succès/erreur -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Liste de vos devis</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Consultez et gérez vos devis reçus de NV AIStats.
                        </p>
                    </div>

                    @if($devis->isEmpty())
                        <div class="text-center py-8">
                            <div class="text-gray-500 text-lg mb-2">📄</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun devis</h3>
                            <p class="text-gray-500">Vous n'avez encore reçu aucun devis.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Numéro
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Titre
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Type
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Montant
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Statut
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date création
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Validité
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($devis as $devis_item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $devis_item->numero }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $devis_item->titre }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($devis_item->type === 'services_carte')
                                                    Services à la carte
                                                @elseif($devis_item->type === 'pack_landing')
                                                    Pack {{ $devis_item->pack_choisi }}
                                                @else
                                                    Devis personnalisé
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                                {{ number_format($devis_item->total_ttc, 2, ',', ' ') }} DZD
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $statusColors = [
                                                        'brouillon' => 'bg-gray-100 text-gray-800',
                                                        'envoye' => 'bg-blue-100 text-blue-800',
                                                        'accepte' => 'bg-green-100 text-green-800',
                                                        'refuse' => 'bg-red-100 text-red-800',
                                                        'expire' => 'bg-yellow-100 text-yellow-800'
                                                    ];
                                                    $statusLabels = [
                                                        'brouillon' => 'Brouillon',
                                                        'envoye' => 'Envoyé',
                                                        'accepte' => 'Accepté',
                                                        'refuse' => 'Refusé',
                                                        'expire' => 'Expiré'
                                                    ];
                                                @endphp
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$devis_item->statut] }}">
                                                    {{ $statusLabels[$devis_item->statut] }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $devis_item->created_at->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $devis_item->date_validite->format('d/m/Y') }}
                                                @if($devis_item->date_validite->isPast() && $devis_item->statut === 'envoye')
                                                    <span class="text-red-600 text-xs">(Expiré)</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('client.devis.show', $devis_item) }}" 
                                                       class="text-indigo-600 hover:text-indigo-900">
                                                        👁️ Voir
                                                    </a>
                                                    <a href="{{ route('client.devis.pdf', $devis_item) }}" 
                                                       class="text-green-600 hover:text-green-900">
                                                        📄 PDF
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 