<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Facture') }} #{{ $facture->numero }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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
                    <!-- En-tête de la facture -->
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $facture->titre }}</h1>
                                <p class="text-sm text-gray-600 mt-1">Facture N° {{ $facture->numero }}</p>
                                <p class="text-sm text-gray-600">Émise le {{ $facture->created_at->format('d/m/Y à H:i') }}</p>
                                @if($facture->devis)
                                    <p class="text-sm text-blue-600 mt-1">
                                        <a href="{{ route('client.devis.show', $facture->devis) }}" class="hover:text-blue-800">
                                            📄 Basée sur le devis {{ $facture->devis->numero }}
                                        </a>
                                    </p>
                                @endif
                            </div>
                            <div class="text-right">
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
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $statusColors[$facture->statut] }}">
                                    {{ $statusLabels[$facture->statut] }}
                                </span>
                                <div class="mt-2 text-sm text-gray-600">
                                    Échéance : {{ $facture->date_echeance->format('d/m/Y') }}
                                </div>
                                @if($facture->date_echeance->isPast() && $facture->statut !== 'payee')
                                    <div class="text-red-600 text-sm font-medium">⚠️ Facture échue</div>
                                @endif
                                @if($facture->date_paiement)
                                    <div class="text-green-600 text-sm font-medium">✅ Payée le {{ $facture->date_paiement->format('d/m/Y') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($facture->description)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700">{{ $facture->description }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Services facturés -->
                    @if($facture->services && count($facture->services) > 0)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Services facturés</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <ul class="text-sm text-gray-700 space-y-1">
                                    @foreach($facture->services as $service)
                                        <li>• {{ $service }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- Détails supplémentaires -->
                    @if($facture->details_services && count($facture->details_services) > 0)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Détails des services</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <ul class="text-sm text-gray-700 space-y-1">
                                    @foreach($facture->details_services as $detail)
                                        <li>• {{ $detail }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- Détail des prix -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Détail des prix</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Prix de base :</span>
                                    <span class="text-sm font-medium text-gray-900">{{ number_format($facture->prix_base, 2, ',', ' ') }} DZD</span>
                                </div>
                                @if($facture->ajustement_complexite != 0)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Ajustement complexité :</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $facture->ajustement_complexite > 0 ? '+' : '' }}{{ number_format($facture->ajustement_complexite, 2, ',', ' ') }} DZD</span>
                                    </div>
                                @endif
                                @if($facture->remise_pourcentage > 0)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Remise ({{ $facture->remise_pourcentage }}%) :</span>
                                        <span class="text-sm font-medium text-green-600">-{{ number_format($facture->sous_total * $facture->remise_pourcentage / 100, 2, ',', ' ') }} DZD</span>
                                    </div>
                                @endif
                                <hr class="my-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Sous-total HT :</span>
                                    <span class="text-sm font-medium text-gray-900">{{ number_format($facture->sous_total, 2, ',', ' ') }} DZD</span>
                                </div>
                                @if($facture->tva_pourcentage > 0)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">TVA ({{ $facture->tva_pourcentage }}%) :</span>
                                        <span class="text-sm font-medium text-gray-900">{{ number_format($facture->montant_tva, 2, ',', ' ') }} DZD</span>
                                    </div>
                                @endif
                                <hr class="my-2">
                                <div class="flex justify-between text-lg font-bold">
                                    <span class="text-gray-900">Total TTC :</span>
                                    <span class="text-blue-600">{{ number_format($facture->total_ttc, 2, ',', ' ') }} DZD</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Services inclus -->
                    @if($facture->services_inclus)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Services inclus</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 whitespace-pre-line">{{ $facture->services_inclus }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Conditions de paiement -->
                    @if($facture->conditions_paiement)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Conditions de paiement</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 whitespace-pre-line">{{ $facture->conditions_paiement }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Informations de paiement (si payée) -->
                    @if($facture->statut === 'payee' && ($facture->methode_paiement || $facture->reference_paiement))
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Informations de paiement</h3>
                            <div class="bg-green-50 rounded-lg p-4">
                                @if($facture->methode_paiement)
                                    <div class="flex justify-between mb-2">
                                        <span class="text-sm text-gray-600">Méthode de paiement :</span>
                                        <span class="text-sm font-medium text-gray-900">
                                            @switch($facture->methode_paiement)
                                                @case('virement') Virement bancaire @break
                                                @case('carte') Carte bancaire @break
                                                @case('cheque') Chèque @break
                                                @case('especes') Espèces @break
                                                @default {{ $facture->methode_paiement }}
                                            @endswitch
                                        </span>
                                    </div>
                                @endif
                                @if($facture->reference_paiement)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Référence de paiement :</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $facture->reference_paiement }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex flex-wrap gap-3">
                            <!-- Bouton Retour -->
                            <a href="{{ route('client.factures.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                ← Retour à la liste
                            </a>

                            <!-- Bouton PDF -->
                            <a href="{{ route('client.factures.pdf', $facture) }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                📄 Télécharger PDF
                            </a>

                            @if($facture->devis)
                                <a href="{{ route('client.devis.show', $facture->devis) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    📄 Voir le devis associé
                                </a>
                            @endif

                            <!-- Information de statut -->
                            @if($facture->statut === 'envoyee' && !$facture->date_echeance->isPast())
                                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-2 rounded">
                                    📋 Facture en attente de paiement
                                </div>
                            @elseif($facture->statut === 'payee')
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                                    ✅ Facture payée le {{ $facture->date_paiement->format('d/m/Y') }}
                                </div>
                            @elseif($facture->date_echeance->isPast() && $facture->statut !== 'payee')
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
                                    ⚠️ Facture échue depuis le {{ $facture->date_echeance->format('d/m/Y') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 