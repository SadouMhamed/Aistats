@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">
                    <div>
                        <h1 style="font-size: 1.875rem; font-weight: 700; color: #1f2937; margin: 0;">Créer un Devis - Services à la Carte</h1>
                        <p style="color: #6b7280; margin-top: 0.25rem;">Client: {{ $user->name }} ({{ $user->email }})</p>
                    </div>
                    <a href="{{ route('admin.user.detail', $user->id) }}" style="background: linear-gradient(135deg, #6b7280, #4b5563); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                        Retour
                    </a>
                </div>

                <form action="{{ route('admin.devis.store') }}" method="POST" id="devisForm">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="type" value="services_carte">

                    <!-- Client Information Recap -->
                    <div style="background: linear-gradient(135deg, #f8fafc, #e2e8f0); border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem; border-left: 4px solid #3b82f6;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Informations du Projet Client</h3>
                        
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                            @if($user->devis_nb_individus)
                                <div style="background: white; padding: 1rem; border-radius: 0.5rem; border-left: 3px solid #3b82f6;">
                                    <div style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">Nb. Individus</div>
                                    <div style="font-weight: 600; color: #111827;">{{ $user->devis_nb_individus }}</div>
                                </div>
                            @endif
                            @if($user->devis_nb_variables)
                                <div style="background: white; padding: 1rem; border-radius: 0.5rem; border-left: 3px solid #8b5cf6;">
                                    <div style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">Nb. Variables</div>
                                    <div style="font-weight: 600; color: #111827;">{{ $user->devis_nb_variables }}</div>
                                </div>
                            @endif
                            @if($user->devis_delais)
                                <div style="background: white; padding: 1rem; border-radius: 0.5rem; border-left: 3px solid #06b6d4;">
                                    <div style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">Délai</div>
                                    <div style="font-weight: 600; color: #111827;">{{ $user->devis_delais }}</div>
                                </div>
                            @endif
                        </div>

                        @if($user->devis_services)
                            @php
                                $services = is_string($user->devis_services) ? json_decode($user->devis_services, true) : $user->devis_services;
                            @endphp
                            <div>
                                <h4 style="font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.75rem;">Services Demandés</h4>
                                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                    @if(is_array($services))
                                        @foreach($services as $service)
                                            <span style="background: linear-gradient(135deg, #e0e7ff, #c7d2fe); color: #3730a3; padding: 0.375rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">
                                                {{ $service }}
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($user->devis_remarques)
                            <div style="margin-top: 1rem; background: white; border: 1px solid #fed7aa; border-radius: 0.5rem; padding: 1rem;">
                                <div style="font-size: 0.75rem; color: #92400e; text-transform: uppercase; font-weight: 600; margin-bottom: 0.5rem;">Remarques Client</div>
                                <div style="color: #78350f; font-size: 0.875rem;">{{ $user->devis_remarques }}</div>
                            </div>
                        @endif
                    </div>

                    <!-- Devis Information -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                        <!-- Left Column -->
                        <div>
                            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem;">
                                <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem;">Informations du Devis</h3>
                                
                                <div style="margin-bottom: 1rem;">
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Titre du Devis *</label>
                                    <input type="text" name="titre" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                           value="Services d'analyse statistique - {{ $user->name }}" placeholder="Titre du devis">
                                </div>

                                <div style="margin-bottom: 1rem;">
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Description</label>
                                    <textarea name="description" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                              placeholder="Description détaillée des services proposés">Analyse statistique personnalisée incluant les services sélectionnés par le client selon ses besoins spécifiques.</textarea>
                                </div>

                                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                                    <div>
                                        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Date d'échéance</label>
                                        <input type="date" name="date_echeance" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                               value="{{ date('Y-m-d', strtotime('+30 days')) }}">
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Date de validité</label>
                                        <input type="date" name="date_validite" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                               value="{{ date('Y-m-d', strtotime('+30 days')) }}">
                                        <small style="display: block; color: #6b7280; font-size: 0.75rem; margin-top: 0.25rem;">Si vide, sera calculée automatiquement</small>
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Validité (jours)</label>
                                        <input type="number" name="validite_jours" value="30" min="1" max="365" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div>
                            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem;">
                                <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem;">Calcul des Prix</h3>
                                
                                <div style="margin-bottom: 1rem;">
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Prix de base (DZD) *</label>
                                    <input type="number" name="prix_base" id="prix_base" step="0.01" min="0" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                           value="20000.00" onchange="calculateTotal()">
                                </div>

                                <div style="margin-bottom: 1rem;">
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Ajustement complexité (DZD)</label>
                                    <input type="number" name="ajustement_complexite" id="ajustement_complexite" step="0.01" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                           value="0.00" onchange="calculateTotal()">
                                </div>

                                <div style="margin-bottom: 1rem;">
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Remise (%) </label>
                                    <input type="number" name="remise_pourcentage" id="remise_pourcentage" step="0.01" min="0" max="100" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                           value="0.00" onchange="calculateTotal()">
                                </div>

                                <div style="margin-bottom: 1rem;">
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">TVA (%)</label>
                                    <input type="number" name="tva_pourcentage" id="tva_pourcentage" step="0.01" min="0" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                           value="20.00" onchange="calculateTotal()">
                                </div>

                                <!-- Price Summary -->
                                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 1rem; margin-top: 1rem;">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                        <span style="font-size: 0.875rem; color: #6b7280;">Sous-total:</span>
                                        <span id="sous_total" style="font-weight: 600; color: #111827;">20000.00 DZD</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                        <span style="font-size: 0.875rem; color: #6b7280;">TVA:</span>
                                        <span id="montant_tva" style="font-weight: 600; color: #111827;">4000.00 DZD</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; padding-top: 0.5rem; border-top: 1px solid #e5e7eb;">
                                        <span style="font-weight: 600; color: #111827;">Total TTC:</span>
                                        <span id="total_ttc" style="font-size: 1.125rem; font-weight: 700; color: #059669;">24000.00 DZD</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Services Details -->
                    <div style="background: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem;">Détails des Services Inclus</h3>
                        
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Services inclus</label>
                            <textarea name="services_inclus" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                      placeholder="Liste détaillée des services inclus dans ce devis">@if($user->devis_services && is_array($user->devis_services))
{{ implode("\n", $user->devis_services) }}
@endif</textarea>
                        </div>

                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Conditions particulières</label>
                            <textarea name="conditions" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                      placeholder="Conditions spécifiques à ce projet">- Livraison sous {{ $user->devis_delais ?? '15 jours' }}
- Révisions incluses: 2 versions
- Format de livraison: PDF + fichiers sources</textarea>
                        </div>
                    </div>

                    <!-- Hidden fields for calculated values -->
                    <input type="hidden" name="sous_total" id="hidden_sous_total" value="20000.00">
                    <input type="hidden" name="montant_tva" id="hidden_montant_tva" value="4000.00">
                    <input type="hidden" name="total_ttc" id="hidden_total_ttc" value="24000.00">

                    <!-- Submit Button -->
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                        <div style="font-size: 0.875rem; color: #6b7280;">
                            * Champs obligatoires
                        </div>
                        <div style="display: flex; gap: 1rem;">
                            <button type="button" onclick="history.back()" style="background: #f3f4f6; color: #374151; padding: 0.75rem 1.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; cursor: pointer;">
                                Annuler
                            </button>
                            <button type="submit" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 0.75rem 2rem; border: none; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: all 0.3s ease;">
                                Créer le Devis
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function calculateTotal() {
    const prixBase = parseFloat(document.getElementById('prix_base').value) || 0;
    const ajustement = parseFloat(document.getElementById('ajustement_complexite').value) || 0;
    const remisePourcentage = parseFloat(document.getElementById('remise_pourcentage').value) || 0;
    const tvaPourcentage = parseFloat(document.getElementById('tva_pourcentage').value) || 0;
    
    // Calculate subtotal after adjustments and discount
    const sousTotal = (prixBase + ajustement) * (1 - remisePourcentage / 100);
    const montantTva = sousTotal * (tvaPourcentage / 100);
    const totalTtc = sousTotal + montantTva;
    
    // Update display
    document.getElementById('sous_total').textContent = sousTotal.toFixed(2) + ' DZD';
    document.getElementById('montant_tva').textContent = montantTva.toFixed(2) + ' DZD';
    document.getElementById('total_ttc').textContent = totalTtc.toFixed(2) + ' DZD';
    
    // Update hidden fields
    document.getElementById('hidden_sous_total').value = sousTotal.toFixed(2);
    document.getElementById('hidden_montant_tva').value = montantTva.toFixed(2);
    document.getElementById('hidden_total_ttc').value = totalTtc.toFixed(2);
}

// Initialize calculation on page load
document.addEventListener('DOMContentLoaded', calculateTotal);
</script>
@endsection 