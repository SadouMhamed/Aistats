<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Factures') }}
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
                        <h3 class="text-lg font-medium text-gray-900">Liste de vos factures</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Consultez et téléchargez vos factures émises par NV AIStats.
                        </p>
                    </div>

                    @if($factures->isEmpty())
                        <div class="text-center py-8">
                            <div class="text-gray-500 text-lg mb-2">🧾</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune facture</h3>
                            <p class="text-gray-500">Vous n'avez encore reçu aucune facture.</p>
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
                                            Devis associé
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
                                            Échéance
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($factures as $facture)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $facture->numero }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $facture->titre }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($facture->devis)
                                                    <a href="{{ route('client.devis.show', $facture->devis) }}" class="text-blue-600 hover:text-blue-900">
                                                        Devis {{ $facture->devis->numero }}
                                                    </a>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                                {{ number_format($facture->total_ttc, 2, ',', ' ') }} DZD
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $statusColors = [
                                                        'brouillon' => 'bg-gray-100 text-gray-800',
                                                        'envoyee' => 'bg-blue-100 text-blue-800',
                                                        'payee' => 'bg-green-100 text-green-800',
                                                        'en_retard' => 'bg-red-100 text-red-800',
                                                        'annulee' => 'bg-yellow-100 text-yellow-800'
                                                    ];
                                                    $statusLabels = [
                                                        'brouillon' => 'Brouillon',
                                                        'envoyee' => 'Envoyée',
                                                        'payee' => 'Payée',
                                                        'en_retard' => 'En retard',
                                                        'annulee' => 'Annulée'
                                                    ];
                                                @endphp
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$facture->statut] }}">
                                                    {{ $statusLabels[$facture->statut] }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $facture->created_at->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $facture->date_echeance->format('d/m/Y') }}
                                                @if($facture->date_echeance->isPast() && $facture->statut !== 'payee')
                                                    <span class="text-red-600 text-xs">(Échue)</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('client.factures.show', $facture) }}" 
                                                       class="text-indigo-600 hover:text-indigo-900">
                                                        👁️ Voir
                                                    </a>
                                                    <a href="{{ route('client.factures.pdf', $facture) }}" 
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