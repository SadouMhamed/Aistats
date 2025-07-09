@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">
                    <div>
                        <h1 style="font-size: 1.875rem; font-weight: 700; color: #1f2937; margin: 0;">Modifier la Facture {{ $facture->numero }}</h1>
                        <p style="color: #6b7280; margin-top: 0.25rem;">Pour {{ $facture->user->nom }} {{ $facture->user->prenom }}</p>
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        <a href="{{ route('admin.factures.show', $facture) }}" style="background: linear-gradient(135deg, #6b7280, #4b5563); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                            Annuler
                        </a>
                        <a href="{{ route('admin.factures.index') }}" style="background: linear-gradient(135deg, #374151, #1f2937); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                            Retour à la liste
                        </a>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('admin.factures.update', $facture) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                        <!-- Left Column -->
                        <div>
                            <!-- Basic Info -->
                            <div style="background: #f8fafc; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 1.5rem;">
                                <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Informations de Base</h3>
                                
                                <div style="margin-bottom: 1rem;">
                                    <label for="titre" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Titre de la facture *</label>
                                    <input type="text" id="titre" name="titre" value="{{ old('titre', $facture->titre) }}" required
                                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; color: #1f2937; background: white; focus:border-blue-500; focus:ring-1; focus:ring-blue-500;">
                                    @error('titre')
                                        <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div style="margin-bottom: 1rem;">
                                    <label for="description" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Description</label>
                                    <textarea id="description" name="description" rows="3"
                                              style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; color: #1f2937; background: white; focus:border-blue-500; focus:ring-1; focus:ring-blue-500; resize: vertical;">{{ old('description', $facture->description) }}</textarea>
                                    @error('description')
                                        <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div style="margin-bottom: 1rem;">
                                    <label for="statut" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Statut *</label>
                                    <select id="statut" name="statut" required
                                            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; color: #1f2937; background: white; focus:border-blue-500; focus:ring-1; focus:ring-blue-500;">
                                        <option value="brouillon" {{ old('statut', $facture->statut) === 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                        <option value="envoyee" {{ old('statut', $facture->statut) === 'envoyee' ? 'selected' : '' }}>Envoyée</option>
                                        <option value="payee" {{ old('statut', $facture->statut) === 'payee' ? 'selected' : '' }}>Payée</option>
                                        <option value="annulee" {{ old('statut', $facture->statut) === 'annulee' ? 'selected' : '' }}>Annulée</option>
                                        <option value="en_retard" {{ old('statut', $facture->statut) === 'en_retard' ? 'selected' : '' }}>En retard</option>
                                    </select>
                                    @error('statut')
                                        <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="date_echeance" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Date d'échéance</label>
                                    <input type="date" id="date_echeance" name="date_echeance" 
                                           value="{{ old('date_echeance', $facture->date_echeance ? $facture->date_echeance->format('Y-m-d') : '') }}"
                                           style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; color: #1f2937; background: white; focus:border-blue-500; focus:ring-1; focus:ring-blue-500;">
                                    @error('date_echeance')
                                        <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pricing -->
                            <div style="background: #f8fafc; border-radius: 0.75rem; padding: 1.5rem;">
                                <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Tarification</h3>
                                
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                                    <div>
                                        <label for="prix_base" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Prix de base (DZD) *</label>
                                        <input type="number" id="prix_base" name="prix_base" step="0.01" min="0" 
                                               value="{{ old('prix_base', $facture->prix_base) }}" required
                                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; color: #1f2937; background: white; focus:border-blue-500; focus:ring-1; focus:ring-blue-500;">
                                        @error('prix_base')
                                            <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="ajustement_complexite" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Ajustement complexité (DZD)</label>
                                        <input type="number" id="ajustement_complexite" name="ajustement_complexite" step="0.01" 
                                               value="{{ old('ajustement_complexite', $facture->ajustement_complexite) }}"
                                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; color: #1f2937; background: white; focus:border-blue-500; focus:ring-1; focus:ring-blue-500;">
                                        @error('ajustement_complexite')
                                            <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                    <div>
                                        <label for="remise_pourcentage" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Remise (%)</label>
                                        <input type="number" id="remise_pourcentage" name="remise_pourcentage" step="0.01" min="0" max="100" 
                                               value="{{ old('remise_pourcentage', $facture->remise_pourcentage) }}"
                                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; color: #1f2937; background: white; focus:border-blue-500; focus:ring-1; focus:ring-blue-500;">
                                        @error('remise_pourcentage')
                                            <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="tva_pourcentage" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">TVA (%) *</label>
                                        <input type="number" id="tva_pourcentage" name="tva_pourcentage" step="0.01" min="0" 
                                               value="{{ old('tva_pourcentage', $facture->tva_pourcentage) }}" required
                                               style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; color: #1f2937; background: white; focus:border-blue-500; focus:ring-1; focus:ring-blue-500;">
                                        @error('tva_pourcentage')
                                            <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div>
                            <!-- Services -->
                            <div style="background: #f8fafc; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 1.5rem;">
                                <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Services Inclus</h3>
                                
                                <div>
                                    <label for="services_inclus" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Détail des services</label>
                                    <textarea id="services_inclus" name="services_inclus" rows="8"
                                              style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; color: #1f2937; background: white; focus:border-blue-500; focus:ring-1; focus:ring-blue-500; resize: vertical;"
                                              placeholder="Décrivez les services inclus dans cette facture...">{{ old('services_inclus', $facture->services_inclus) }}</textarea>
                                    @error('services_inclus')
                                        <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Payment Conditions -->
                            <div style="background: #f8fafc; border-radius: 0.75rem; padding: 1.5rem;">
                                <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Conditions de Paiement</h3>
                                
                                <div>
                                    <label for="conditions_paiement" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Conditions</label>
                                    <textarea id="conditions_paiement" name="conditions_paiement" rows="6"
                                              style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; color: #1f2937; background: white; focus:border-blue-500; focus:ring-1; focus:ring-blue-500; resize: vertical;"
                                              placeholder="Ex: Paiement à 30 jours à réception de facture...">{{ old('conditions_paiement', $facture->conditions_paiement) }}</textarea>
                                    @error('conditions_paiement')
                                        <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Totals Display (Read-only) -->
                    <div style="background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #0c4a6e; margin-bottom: 1rem;">Totaux Actuels</h3>
                        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; text-align: center;">
                            <div>
                                <span style="display: block; font-size: 0.75rem; color: #0369a1; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Sous-total</span>
                                <span style="display: block; font-size: 1.125rem; font-weight: 700; color: #0c4a6e;">{{ number_format($facture->sous_total, 2) }} DZD</span>
                            </div>
                            <div>
                                <span style="display: block; font-size: 0.75rem; color: #0369a1; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">TVA</span>
                                <span style="display: block; font-size: 1.125rem; font-weight: 700; color: #0c4a6e;">{{ number_format($facture->montant_tva, 2) }} DZD</span>
                            </div>
                            <div>
                                <span style="display: block; font-size: 0.75rem; color: #059669; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Total TTC</span>
                                <span style="display: block; font-size: 1.25rem; font-weight: 700; color: #047857;">{{ number_format($facture->total_ttc, 2) }} DZD</span>
                            </div>
                            <div>
                                <span style="display: block; font-size: 0.75rem; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Statut</span>
                                <span style="display: block; font-size: 1rem; font-weight: 600; 
                                    @if($facture->statut === 'brouillon') color: #d97706;
                                    @elseif($facture->statut === 'envoyee') color: #2563eb;
                                    @elseif($facture->statut === 'payee') color: #059669;
                                    @elseif($facture->statut === 'annulee') color: #dc2626;
                                    @else color: #dc2626; @endif">
                                    @if($facture->statut === 'brouillon') Brouillon
                                    @elseif($facture->statut === 'envoyee') Envoyée
                                    @elseif($facture->statut === 'payee') Payée
                                    @elseif($facture->statut === 'annulee') Annulée
                                    @else En retard @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                        <div style="display: flex; gap: 0.75rem;">
                            <a href="{{ route('admin.factures.show', $facture) }}" style="background: #f3f4f6; color: #374151; padding: 0.75rem 1.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                                Annuler
                            </a>
                            <a href="{{ route('admin.factures.index') }}" style="background: #f3f4f6; color: #374151; padding: 0.75rem 1.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                                Retour à la liste
                            </a>
                        </div>
                        <div style="display: flex; gap: 0.75rem;">
                            <button type="submit" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 0.75rem 2rem; border: none; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; cursor: pointer;">
                                Mettre à jour la Facture
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-calculate totals when pricing fields change
document.addEventListener('DOMContentLoaded', function() {
    const prixBaseInput = document.getElementById('prix_base');
    const ajustementInput = document.getElementById('ajustement_complexite');
    const remiseInput = document.getElementById('remise_pourcentage');
    const tvaInput = document.getElementById('tva_pourcentage');

    function updateCalculation() {
        // This is just for preview - actual calculation happens server-side
        const prixBase = parseFloat(prixBaseInput.value) || 0;
        const ajustement = parseFloat(ajustementInput.value) || 0;
        const remise = parseFloat(remiseInput.value) || 0;
        const tva = parseFloat(tvaInput.value) || 19;

        const sousTotal = (prixBase + ajustement) * (1 - remise / 100);
        const montantTva = sousTotal * (tva / 100);
        const totalTtc = sousTotal + montantTva;

        console.log('Preview calculation:', {
            prixBase, ajustement, remise, tva,
            sousTotal: sousTotal.toFixed(2),
            montantTva: montantTva.toFixed(2),
            totalTtc: totalTtc.toFixed(2)
        });
    }

    [prixBaseInput, ajustementInput, remiseInput, tvaInput].forEach(input => {
        if (input) {
            input.addEventListener('input', updateCalculation);
        }
    });
});
</script>
@endsection 