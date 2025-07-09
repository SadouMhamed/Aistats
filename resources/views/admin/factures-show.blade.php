@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">
                    <div>
                        <h1 style="font-size: 1.875rem; font-weight: 700; color: #1f2937; margin: 0;">Facture {{ $facture->numero }}</h1>
                        <p style="color: #6b7280; margin-top: 0.25rem;">Facture pour {{ $facture->user->name }}</p>
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        @if($facture->statut === 'brouillon')
                            <span style="background: linear-gradient(135deg, #fee2e2, #fecaca); color: #991b1b; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500;">Brouillon</span>
                        @elseif($facture->statut === 'envoyee')
                            <span style="background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #1e40af; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500;">Envoyée</span>
                        @elseif($facture->statut === 'payee')
                            <span style="background: linear-gradient(135deg, #dcfce7, #bbf7d0); color: #166534; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500;">Payée</span>
                        @elseif($facture->statut === 'annulee')
                            <span style="background: linear-gradient(135deg, #fef3c7, #fde68a); color: #92400e; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500;">Annulée</span>
                        @else
                            <span style="background: linear-gradient(135deg, #fecaca, #fca5a5); color: #991b1b; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500;">En retard</span>
                        @endif
                        <a href="{{ route('admin.factures.index') }}" style="background: linear-gradient(135deg, #6b7280, #4b5563); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                            Retour à la liste
                        </a>
                    </div>
                </div>

                <!-- Client Info -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                    <div style="background: #f8fafc; border-radius: 0.75rem; padding: 1.5rem;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Informations Client</h3>
                        <div style="space-y: 0.5rem;">
                            <div><strong>Nom :</strong> {{ $facture->user->nom }} {{ $facture->user->prenom }}</div>
                            <div><strong>Email :</strong> {{ $facture->user->email }}</div>
                            @if($facture->user->telephone)
                                <div><strong>Téléphone :</strong> {{ $facture->user->telephone }}</div>
                            @endif
                            @if($facture->user->profession)
                                <div><strong>Profession :</strong> {{ $facture->user->profession }}</div>
                            @endif
                        </div>
                    </div>

                    <div style="background: #f8fafc; border-radius: 0.75rem; padding: 1.5rem;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Détails de la Facture</h3>
                        <div style="space-y: 0.5rem;">
                            <div><strong>Type :</strong> 
                                @if($facture->type === 'services_carte')
                                    <span style="color: #3b82f6;">Services à la carte</span>
                                @elseif($facture->type === 'pack_landing')
                                    <span style="color: #8b5cf6;">Pack Landing</span>
                                @else
                                    <span style="color: #6b7280;">Personnalisé</span>
                                @endif
                            </div>
                            <div><strong>Créée le :</strong> {{ $facture->created_at->format('d/m/Y à H:i') }}</div>
                            @if($facture->date_echeance)
                                <div><strong>Échéance :</strong> {{ $facture->date_echeance->format('d/m/Y') }}</div>
                            @endif
                            @if($facture->devis)
                                <div><strong>Devis associé :</strong> 
                                    <a href="{{ route('admin.devis.show', $facture->devis) }}" style="color: #3b82f6; text-decoration: underline;">
                                        {{ $facture->devis->numero }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Facture Content -->
                <div style="background: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem;">
                    <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">{{ $facture->titre }}</h3>
                    
                    @if($facture->description)
                        <p style="color: #6b7280; margin-bottom: 1.5rem; line-height: 1.6;">{{ $facture->description }}</p>
                    @endif

                    @if($facture->services_inclus)
                        <div style="margin-bottom: 1.5rem;">
                            <h4 style="font-size: 1rem; font-weight: 600; color: #374151; margin-bottom: 0.75rem;">Services Inclus</h4>
                            <div style="background: #f8fafc; border-radius: 0.5rem; padding: 1rem;">
                                <pre style="white-space: pre-wrap; font-family: inherit; color: #374151; font-size: 0.875rem; line-height: 1.5;">{{ $facture->services_inclus }}</pre>
                            </div>
                        </div>
                    @endif

                    @if($facture->conditions_paiement)
                        <div style="margin-bottom: 1.5rem;">
                            <h4 style="font-size: 1rem; font-weight: 600; color: #374151; margin-bottom: 0.75rem;">Conditions de Paiement</h4>
                            <div style="background: #fef3c7; border: 1px solid #fed7aa; border-radius: 0.5rem; padding: 1rem;">
                                <pre style="white-space: pre-wrap; font-family: inherit; color: #92400e; font-size: 0.875rem; line-height: 1.5;">{{ $facture->conditions_paiement }}</pre>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Pricing Details -->
                <div style="background: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem;">
                    <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Détail des Prix</h3>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div>
                            <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="color: #6b7280;">Prix de base :</span>
                                <span style="font-weight: 600;">{{ number_format($facture->prix_base, 2) }} DZD</span>
                            </div>
                            @if($facture->ajustement_complexite != 0)
                                <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #f3f4f6;">
                                    <span style="color: #6b7280;">Ajustement complexité :</span>
                                    <span style="font-weight: 600; color: {{ $facture->ajustement_complexite > 0 ? '#ef4444' : '#10b981' }};">
                                        {{ $facture->ajustement_complexite > 0 ? '+' : '' }}{{ number_format($facture->ajustement_complexite, 2) }} DZD
                                    </span>
                                </div>
                            @endif
                            @if($facture->remise_pourcentage > 0)
                                <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #f3f4f6;">
                                    <span style="color: #6b7280;">Remise ({{ $facture->remise_pourcentage }}%) :</span>
                                    <span style="font-weight: 600; color: #10b981;">
                                        -{{ number_format(($facture->prix_base + $facture->ajustement_complexite) * $facture->remise_pourcentage / 100, 2) }} DZD
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div style="background: #f8fafc; border-radius: 0.5rem; padding: 1rem;">
                            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e5e7eb;">
                                <span style="color: #6b7280;">Sous-total :</span>
                                <span style="font-weight: 600;">{{ number_format($facture->sous_total, 2) }} DZD</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e5e7eb;">
                                <span style="color: #6b7280;">TVA ({{ $facture->tva_pourcentage }}%) :</span>
                                <span style="font-weight: 600;">{{ number_format($facture->montant_tva, 2) }} DZD</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; font-size: 1.125rem;">
                                <span style="font-weight: 700; color: #111827;">Total TTC :</span>
                                <span style="font-weight: 700; color: #059669; font-size: 1.25rem;">{{ number_format($facture->total_ttc, 2) }} DZD</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment History -->
                @if($facture->statut === 'payee' || $facture->date_paiement)
                    <div style="background: #dcfce7; border: 1px solid #bbf7d0; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #166534; margin-bottom: 1rem;">🎉 Paiement Reçu</h3>
                        <div style="color: #166534;">
                            @if($facture->date_paiement)
                                <div><strong>Date de paiement :</strong> {{ $facture->date_paiement->format('d/m/Y à H:i') }}</div>
                            @endif
                            @if($facture->methode_paiement)
                                <div><strong>Méthode de paiement :</strong> {{ ucfirst($facture->methode_paiement) }}</div>
                            @endif
                            @if($facture->reference_paiement)
                                <div><strong>Référence :</strong> {{ $facture->reference_paiement }}</div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                    <div style="font-size: 0.875rem; color: #6b7280;">
                        Créée le {{ $facture->created_at->format('d/m/Y à H:i') }} par {{ $facture->admin->name ?? 'Système' }}
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        @if($facture->statut === 'brouillon')
                            <form action="{{ route('admin.factures.send', $facture) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; cursor: pointer;">
                                    Envoyer au Client
                                </button>
                            </form>
                        @endif
                        
                        @if($facture->statut === 'envoyee')
                            <form action="{{ route('admin.factures.mark-paid', $facture) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; cursor: pointer;">
                                    Marquer comme Payée
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('admin.factures.edit', $facture) }}" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                            Modifier
                        </a>
                        
                        <a href="{{ route('admin.factures.pdf', $facture) }}" style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                            PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 