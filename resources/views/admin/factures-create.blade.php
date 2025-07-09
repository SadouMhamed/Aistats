@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header -->
                <div style="margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">
                    <h1 style="font-size: 1.875rem; font-weight: 700; color: #1f2937; margin: 0;">Créer une Facture</h1>
                    @if($devis ?? null)
                        <p style="color: #6b7280; margin-top: 0.25rem;">À partir du devis {{ $devis->numero }}</p>
                    @else
                        <p style="color: #6b7280; margin-top: 0.25rem;">Nouvelle facture</p>
                    @endif
                </div>

                <form action="{{ route('admin.factures.store') }}" method="POST">
                    @csrf
                    
                    @if($devis ?? null)
                        <input type="hidden" name="devis_id" value="{{ $devis->id }}">
                    @endif

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <!-- Colonne gauche -->
                        <div>
                            <!-- Client -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Client *</label>
                                @if($devis ?? null)
                                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 0.75rem;">
                                        <strong>{{ $devis->user->nom }} {{ $devis->user->prenom }}</strong><br>
                                        <span style="color: #6b7280;">{{ $devis->user->email }}</span>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ $devis->user_id }}">
                                @else
                                    <select name="user_id" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                                        <option value="">Sélectionner un client</option>
                                        @foreach($users ?? [] as $user)
                                            <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenom }} ({{ $user->email }})</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                            <!-- Type de facture -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Type de facture *</label>
                                <select name="type" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                                    <option value="services_carte" {{ ($devis->type ?? '') === 'services_carte' ? 'selected' : '' }}>Services à la carte</option>
                                    <option value="pack_landing" {{ ($devis->type ?? '') === 'pack_landing' ? 'selected' : '' }}>Pack Landing</option>
                                    <option value="devis_libre" {{ ($devis->type ?? '') === 'devis_libre' ? 'selected' : '' }}>Facture libre</option>
                                </select>
                            </div>

                            <!-- Titre -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Titre de la facture *</label>
                                <input type="text" name="titre" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                       value="{{ $devis->titre ?? 'Facture pour services statistiques' }}" placeholder="Ex: Facture pour analyse statistique">
                            </div>

                            <!-- Description -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Description</label>
                                <textarea name="description" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                          placeholder="Description des services facturés">{{ $devis->description ?? '' }}</textarea>
                            </div>

                            <!-- Services inclus -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Services inclus</label>
                                <textarea name="services_inclus" rows="6" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                          placeholder="Listez les services facturés">{{ $devis->services_inclus ?? '' }}</textarea>
                            </div>

                            <!-- Conditions de paiement -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Conditions de paiement</label>
                                <textarea name="conditions_paiement" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                          placeholder="Conditions et modalités de paiement">Paiement à 30 jours. Pénalités en cas de retard selon l'article L441-6 du Code de commerce.</textarea>
                            </div>
                        </div>

                        <!-- Colonne droite -->
                        <div>
                            <!-- Pricing -->
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 1.5rem;">
                                <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Tarification</h3>

                                <div style="margin-bottom: 1rem;">
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Prix de base (DZD) *</label>
                                    <input type="number" name="prix_base" id="prix_base" step="0.01" min="0" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                           value="{{ $devis->prix_base ?? '20000.00' }}" onchange="calculateTotal()">
                                </div>

                                <div style="margin-bottom: 1rem;">
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Ajustement complexité (DZD)</label>
                                    <input type="number" name="ajustement_complexite" id="ajustement_complexite" step="0.01" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                           value="{{ $devis->ajustement_complexite ?? '0.00' }}" onchange="calculateTotal()">
                                </div>

                                <div style="margin-bottom: 1rem;">
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Remise (%)</label>
                                    <input type="number" name="remise_pourcentage" id="remise_pourcentage" step="0.01" min="0" max="100" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                           value="{{ $devis->remise_pourcentage ?? '0.00' }}" onchange="calculateTotal()">
                                </div>

                                <div style="margin-bottom: 1rem;">
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">TVA (%)</label>
                                    <input type="number" name="tva_pourcentage" id="tva_pourcentage" step="0.01" min="0" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                           value="{{ $devis->tva_pourcentage ?? '20.00' }}" onchange="calculateTotal()">
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

                            <!-- Échéance -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Date d'échéance *</label>
                                <input type="date" name="date_echeance" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;" 
                                       value="{{ now()->addDays(30)->format('Y-m-d') }}">
                            </div>

                            <!-- Statut -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Statut initial</label>
                                <select name="statut" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                                    <option value="brouillon">Brouillon</option>
                                    <option value="envoyee">Prête à envoyer</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden fields for calculated values -->
                    <input type="hidden" name="sous_total" id="hidden_sous_total" value="20000.00">
                    <input type="hidden" name="montant_tva" id="hidden_montant_tva" value="4000.00">
                    <input type="hidden" name="total_ttc" id="hidden_total_ttc" value="24000.00">

                    <!-- Submit Buttons -->
                    <div style="display: flex; gap: 0.75rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                        <button type="submit" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; cursor: pointer;">
                            Créer la Facture
                        </button>
                        <a href="{{ route('admin.factures.index') }}" style="background: linear-gradient(135deg, #6b7280, #4b5563); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function calculateTotal() {
    // Get values
    const prixBase = parseFloat(document.getElementById('prix_base').value) || 0;
    const ajustementComplexite = parseFloat(document.getElementById('ajustement_complexite').value) || 0;
    const remisePourcentage = parseFloat(document.getElementById('remise_pourcentage').value) || 0;
    const tvaPourcentage = parseFloat(document.getElementById('tva_pourcentage').value) || 20;

    // Calculate subtotal with adjustment and discount
    const sousTotal = prixBase + ajustementComplexite;
    const remise = sousTotal * (remisePourcentage / 100);
    const sousTotalApresRemise = sousTotal - remise;
    
    // Calculate VAT and total
    const montantTva = sousTotalApresRemise * (tvaPourcentage / 100);
    const totalTtc = sousTotalApresRemise + montantTva;

    // Update display
    document.getElementById('sous_total').textContent = sousTotalApresRemise.toFixed(2) + ' DZD';
    document.getElementById('montant_tva').textContent = montantTva.toFixed(2) + ' DZD';
    document.getElementById('total_ttc').textContent = totalTtc.toFixed(2) + ' DZD';

    // Update hidden fields
    document.getElementById('hidden_sous_total').value = sousTotalApresRemise.toFixed(2);
    document.getElementById('hidden_montant_tva').value = montantTva.toFixed(2);
    document.getElementById('hidden_total_ttc').value = totalTtc.toFixed(2);
}

// Calculate initial values
document.addEventListener('DOMContentLoaded', function() {
    calculateTotal();
});
</script>
@endsection 