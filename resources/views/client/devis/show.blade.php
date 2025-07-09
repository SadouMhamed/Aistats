<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Devis') }} #{{ $devis->numero }}
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
                    <!-- En-tête du devis -->
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $devis->titre }}</h1>
                                <p class="text-sm text-gray-600 mt-1">Devis N° {{ $devis->numero }}</p>
                                <p class="text-sm text-gray-600">Créé le {{ $devis->created_at->format('d/m/Y à H:i') }}</p>
                            </div>
                            <div class="text-right">
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
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $statusColors[$devis->statut] }}">
                                    {{ $statusLabels[$devis->statut] }}
                                </span>
                                <div class="mt-2 text-sm text-gray-600">
                                    Valide jusqu'au {{ $devis->date_validite->format('d/m/Y') }}
                                </div>
                                @if($devis->date_validite->isPast() && $devis->statut === 'envoye')
                                    <div class="text-red-600 text-sm font-medium">⚠️ Devis expiré</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($devis->description)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700">{{ $devis->description }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Type de devis et détails -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Type de service</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                @if($devis->type === 'services_carte')
                                    <div class="flex items-center mb-2">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            Services à la carte
                                        </span>
                                    </div>
                                    @if($devis->services)
                                        <div class="mt-3">
                                            <h4 class="text-sm font-medium text-gray-900 mb-2">Services inclus :</h4>
                                            <ul class="text-sm text-gray-700 space-y-1">
                                                @foreach($devis->services as $service)
                                                    <li>• {{ $service }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @elseif($devis->type === 'pack_landing')
                                    <div class="flex items-center mb-2">
                                        <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            Pack {{ $devis->pack_choisi }}
                                        </span>
                                    </div>
                                @else
                                    <div class="flex items-center mb-2">
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            Devis personnalisé
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($devis->nb_individus || $devis->nb_variables || $devis->delais)
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-3">Détails du projet</h3>
                                <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                                    @if($devis->nb_individus)
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Nombre d'individus :</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $devis->nb_individus }}</span>
                                        </div>
                                    @endif
                                    @if($devis->nb_variables)
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Nombre de variables :</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $devis->nb_variables }}</span>
                                        </div>
                                    @endif
                                    @if($devis->delais)
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Délais souhaités :</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $devis->delais }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Remarques -->
                    @if($devis->remarques)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Remarques</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700">{{ $devis->remarques }}</p>
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
                                    <span class="text-sm font-medium text-gray-900">{{ number_format($devis->prix_base, 2, ',', ' ') }} DZD</span>
                                </div>
                                @if($devis->ajustement_complexite != 0)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Ajustement complexité :</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $devis->ajustement_complexite > 0 ? '+' : '' }}{{ number_format($devis->ajustement_complexite, 2, ',', ' ') }} DZD</span>
                                    </div>
                                @endif
                                @if($devis->remise_pourcentage > 0)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Remise ({{ $devis->remise_pourcentage }}%) :</span>
                                        <span class="text-sm font-medium text-green-600">-{{ number_format($devis->sous_total * $devis->remise_pourcentage / 100, 2, ',', ' ') }} DZD</span>
                                    </div>
                                @endif
                                <hr class="my-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Sous-total HT :</span>
                                    <span class="text-sm font-medium text-gray-900">{{ number_format($devis->sous_total, 2, ',', ' ') }} DZD</span>
                                </div>
                                @if($devis->tva_pourcentage > 0)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">TVA ({{ $devis->tva_pourcentage }}%) :</span>
                                        <span class="text-sm font-medium text-gray-900">{{ number_format($devis->montant_tva, 2, ',', ' ') }} DZD</span>
                                    </div>
                                @endif
                                <hr class="my-2">
                                <div class="flex justify-between text-lg font-bold">
                                    <span class="text-gray-900">Total TTC :</span>
                                    <span class="text-blue-600">{{ number_format($devis->total_ttc, 2, ',', ' ') }} DZD</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Services inclus -->
                    @if($devis->services_inclus)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Services inclus</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 whitespace-pre-line">{{ $devis->services_inclus }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Conditions -->
                    @if($devis->conditions)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Conditions</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 whitespace-pre-line">{{ $devis->conditions }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex flex-wrap gap-3">
                            <!-- Bouton Retour -->
                            <a href="{{ route('client.devis.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                ← Retour à la liste
                            </a>

                            <!-- Bouton PDF -->
                            <a href="{{ route('client.devis.pdf', $devis) }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                📄 Télécharger PDF
                            </a>

                            <!-- Boutons Accepter/Refuser (seulement si le devis est envoyé et non expiré) -->
                            @if($devis->statut === 'envoye' && !$devis->date_validite->isPast())
                                <form action="{{ route('client.devis.accept', $devis) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir accepter ce devis ?')"
                                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        ✅ Accepter le devis
                                    </button>
                                </form>

                                <form action="{{ route('client.devis.reject', $devis) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir refuser ce devis ?')"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        ❌ Refuser le devis
                                    </button>
                                </form>
                            @elseif($devis->statut === 'accepte')
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                                    ✅ Devis accepté le {{ $devis->date_reponse->format('d/m/Y à H:i') }}
                                </div>
                            @elseif($devis->statut === 'refuse')
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
                                    ❌ Devis refusé le {{ $devis->date_reponse->format('d/m/Y à H:i') }}
                                </div>
                            @elseif($devis->date_validite->isPast())
                                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-2 rounded">
                                    ⏰ Ce devis a expiré le {{ $devis->date_validite->format('d/m/Y') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 