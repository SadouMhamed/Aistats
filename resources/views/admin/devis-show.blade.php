@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">
                    <div>
                        <h1 style="font-size: 1.875rem; font-weight: 700; color: #1f2937; margin: 0;">Devis {{ $devis->numero }}</h1>
                        <p style="color: #6b7280; margin-top: 0.25rem;">Détails du devis pour {{ $devis->user->name }}</p>
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        @if($devis->statut === 'brouillon')
                            <span style="background: linear-gradient(135deg, #fee2e2, #fecaca); color: #991b1b; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500;">Brouillon</span>
                        @elseif($devis->statut === 'envoye')
                            <span style="background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #1e40af; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500;">Envoyé</span>
                        @elseif($devis->statut === 'accepte')
                            <span style="background: linear-gradient(135deg, #dcfce7, #bbf7d0); color: #166534; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500;">Accepté</span>
                        @elseif($devis->statut === 'refuse')
                            <span style="background: linear-gradient(135deg, #fef3c7, #fde68a); color: #92400e; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500;">Refusé</span>
                        @else
                            <span style="background: linear-gradient(135deg, #f3f4f6, #e5e7eb); color: #374151; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500;">Expiré</span>
                        @endif
                        <a href="{{ route('admin.devis.index') }}" style="background: linear-gradient(135deg, #6b7280, #4b5563); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                            Retour à la liste
                        </a>
                    </div>
                </div>

                <!-- Client Info -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                    <div style="background: #f8fafc; border-radius: 0.75rem; padding: 1.5rem;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Informations Client</h3>
                        <div style="space-y: 0.5rem;">
                            <div><strong>Nom :</strong> {{ $devis->user->nom }} {{ $devis->user->prenom }}</div>
                            <div><strong>Email :</strong> {{ $devis->user->email }}</div>
                            @if($devis->user->telephone)
                                <div><strong>Téléphone :</strong> {{ $devis->user->telephone }}</div>
                            @endif
                            @if($devis->user->profession)
                                <div><strong>Profession :</strong> {{ $devis->user->profession }}</div>
                            @endif
                        </div>
                    </div>

                    <div style="background: #f8fafc; border-radius: 0.75rem; padding: 1.5rem;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Détails du Devis</h3>
                        <div style="space-y: 0.5rem;">
                            <div><strong>Type :</strong> 
                                @if($devis->type === 'services_carte')
                                    <span style="color: #3b82f6;">Services à la carte</span>
                                @elseif($devis->type === 'pack_landing')
                                    <span style="color: #8b5cf6;">Pack Landing</span>
                                @else
                                    <span style="color: #6b7280;">Personnalisé</span>
                                @endif
                            </div>
                            <div><strong>Créé le :</strong> {{ $devis->created_at->format('d/m/Y à H:i') }}</div>
                            @if($devis->date_echeance)
                                <div><strong>Échéance :</strong> {{ $devis->date_echeance->format('d/m/Y') }}</div>
                            @endif
                            <div><strong>Validité :</strong> {{ $devis->validite_jours }} jours</div>
                        </div>
                    </div>
                </div>

                <!-- Devis Content -->
                <div style="background: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem;">
                    <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">{{ $devis->titre }}</h3>
                    
                    @if($devis->description)
                        <p style="color: #6b7280; margin-bottom: 1.5rem; line-height: 1.6;">{{ $devis->description }}</p>
                    @endif

                    @if($devis->services_inclus)
                        <div style="margin-bottom: 1.5rem;">
                            <h4 style="font-size: 1rem; font-weight: 600; color: #374151; margin-bottom: 0.75rem;">Services Inclus</h4>
                            <div style="background: #f8fafc; border-radius: 0.5rem; padding: 1rem;">
                                <pre style="white-space: pre-wrap; font-family: inherit; color: #374151; font-size: 0.875rem; line-height: 1.5;">{{ $devis->services_inclus }}</pre>
                            </div>
                        </div>
                    @endif

                    @if($devis->conditions)
                        <div style="margin-bottom: 1.5rem;">
                            <h4 style="font-size: 1rem; font-weight: 600; color: #374151; margin-bottom: 0.75rem;">Conditions Particulières</h4>
                            <div style="background: #fef3c7; border: 1px solid #fed7aa; border-radius: 0.5rem; padding: 1rem;">
                                <pre style="white-space: pre-wrap; font-family: inherit; color: #92400e; font-size: 0.875rem; line-height: 1.5;">{{ $devis->conditions }}</pre>
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
                                <span style="font-weight: 600;">{{ number_format($devis->prix_base, 2) }} DZD</span>
                            </div>
                            @if($devis->ajustement_complexite != 0)
                                <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #f3f4f6;">
                                    <span style="color: #6b7280;">Ajustement complexité :</span>
                                    <span style="font-weight: 600; color: {{ $devis->ajustement_complexite > 0 ? '#ef4444' : '#10b981' }};">
                                        {{ $devis->ajustement_complexite > 0 ? '+' : '' }}{{ number_format($devis->ajustement_complexite, 2) }} DZD
                                    </span>
                                </div>
                            @endif
                            @if($devis->remise_pourcentage > 0)
                                <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #f3f4f6;">
                                    <span style="color: #6b7280;">Remise ({{ $devis->remise_pourcentage }}%) :</span>
                                    <span style="font-weight: 600; color: #10b981;">
                                        -{{ number_format(($devis->prix_base + $devis->ajustement_complexite) * $devis->remise_pourcentage / 100, 2) }} DZD
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div style="background: #f8fafc; border-radius: 0.5rem; padding: 1rem;">
                            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e5e7eb;">
                                <span style="color: #6b7280;">Sous-total :</span>
                                <span style="font-weight: 600;">{{ number_format($devis->sous_total, 2) }} DZD</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e5e7eb;">
                                <span style="color: #6b7280;">TVA ({{ $devis->tva_pourcentage }}%) :</span>
                                <span style="font-weight: 600;">{{ number_format($devis->montant_tva, 2) }} DZD</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; font-size: 1.125rem;">
                                <span style="font-weight: 700; color: #111827;">Total TTC :</span>
                                <span style="font-weight: 700; color: #059669; font-size: 1.25rem;">{{ number_format($devis->total_ttc, 2) }} DZD</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                    <div style="font-size: 0.875rem; color: #6b7280;">
                        Créé le {{ $devis->created_at->format('d/m/Y à H:i') }} par {{ $devis->admin->name ?? 'Système' }}
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        @if($devis->statut === 'brouillon')
                            <form action="{{ route('admin.devis.send', $devis) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; cursor: pointer;">
                                    Envoyer au Client
                                </button>
                            </form>
                        @endif
                        
                        @if($devis->statut === 'accepte' && $devis->factures->count() === 0)
                            <form action="{{ route('admin.factures.create', $devis) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; cursor: pointer;">
                                    Créer Facture
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('admin.devis.edit', $devis) }}" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                            Modifier
                        </a>
                        
                        <a href="{{ route('admin.devis.preview', $devis) }}" target="_blank" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                            👁️ Aperçu
                        </a>
                        
                        <a href="{{ route('admin.devis.pdf', $devis) }}" style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500; display: inline-block;">
                            📄 Télécharger PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 