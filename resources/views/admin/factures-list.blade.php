@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">
                    <div>
                        <h1 style="font-size: 1.875rem; font-weight: 700; color: #1f2937; margin: 0;">Gestion des Factures</h1>
                        <p style="color: #6b7280; margin-top: 0.25rem;">Toutes les factures émises dans le système</p>
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        <span style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500;">
                            {{ $factures->total() }} factures
                        </span>
                        <a href="{{ route('admin.dashboard') }}" style="background: linear-gradient(135deg, #6b7280, #4b5563); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                            Retour Dashboard
                        </a>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                    @php
                        $brouillons = $factures->where('statut', 'brouillon')->count();
                        $envoyees = $factures->where('statut', 'envoyee')->count();
                        $payees = $factures->where('statut', 'payee')->count();
                        $enRetard = $factures->where('statut', 'en_retard')->count();
                        $totalAmount = $factures->where('statut', 'payee')->sum('total_ttc');
                        $totalEnAttente = $factures->whereIn('statut', ['envoyee', 'en_retard'])->sum('total_ttc');
                    @endphp
                    
                    <div style="background: linear-gradient(135deg, #fee2e2, #fecaca); border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #ef4444;">
                        <div style="font-size: 0.75rem; color: #991b1b; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">Brouillons</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: #dc2626;">{{ $brouillons }}</div>
                    </div>
                    
                    <div style="background: linear-gradient(135deg, #dbeafe, #bfdbfe); border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #3b82f6;">
                        <div style="font-size: 0.75rem; color: #1e40af; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">Envoyées</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: #2563eb;">{{ $envoyees }}</div>
                    </div>
                    
                    <div style="background: linear-gradient(135deg, #dcfce7, #bbf7d0); border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #22c55e;">
                        <div style="font-size: 0.75rem; color: #166534; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">Payées</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: #16a34a;">{{ $payees }}</div>
                    </div>
                    
                    <div style="background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #f59e0b;">
                        <div style="font-size: 0.75rem; color: #92400e; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">CA Réalisé</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: #d97706;">{{ number_format($totalAmount, 2) }} DZD</div>
                    </div>
                    
                    <div style="background: linear-gradient(135deg, #fde68a, #fcd34d); border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #f59e0b;">
                        <div style="font-size: 0.75rem; color: #92400e; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">En Attente</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: #d97706;">{{ number_format($totalEnAttente, 2) }} DZD</div>
                    </div>
                </div>

                <!-- Filters -->
                <div style="background: #f8fafc; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem;">
                    <form method="GET" style="display: flex; gap: 1rem; align-items: end; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 200px;">
                            <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Statut</label>
                            <select name="statut" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                                <option value="">Tous les statuts</option>
                                <option value="brouillon" {{ request('statut') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                <option value="envoyee" {{ request('statut') == 'envoyee' ? 'selected' : '' }}>Envoyée</option>
                                <option value="payee" {{ request('statut') == 'payee' ? 'selected' : '' }}>Payée</option>
                                <option value="en_retard" {{ request('statut') == 'en_retard' ? 'selected' : '' }}>En retard</option>
                                <option value="annulee" {{ request('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                            </select>
                        </div>
                        
                        <div style="flex: 1; min-width: 200px;">
                            <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Période</label>
                            <select name="periode" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                                <option value="">Toutes les périodes</option>
                                <option value="mois_actuel" {{ request('periode') == 'mois_actuel' ? 'selected' : '' }}>Mois actuel</option>
                                <option value="trimestre_actuel" {{ request('periode') == 'trimestre_actuel' ? 'selected' : '' }}>Trimestre actuel</option>
                                <option value="annee_actuelle" {{ request('periode') == 'annee_actuelle' ? 'selected' : '' }}>Année actuelle</option>
                            </select>
                        </div>
                        
                        <div style="flex: 1; min-width: 200px;">
                            <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Client</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom ou email du client" 
                                   style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                        </div>
                        
                        <div style="display: flex; gap: 0.5rem;">
                            <button type="submit" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; cursor: pointer;">
                                Filtrer
                            </button>
                            <a href="{{ route('admin.factures.index') }}" style="background: #f3f4f6; color: #374151; padding: 0.5rem 1rem; border: 1px solid #d1d5db; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                @if($factures->isEmpty())
                    <div style="text-align: center; padding: 3rem; background: linear-gradient(135deg, #f8fafc, #e2e8f0); border-radius: 0.75rem; border: 2px dashed #cbd5e1;">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🧾</div>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Aucune facture trouvée</h3>
                        <p style="color: #6b7280;">Les factures émises apparaîtront ici.</p>
                    </div>
                @else
                    <!-- Factures List -->
                    <div style="background: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden;">
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead style="background: #f9fafb;">
                                    <tr>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Numéro</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Client</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Devis</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Montant</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Échéance</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Statut</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Date</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($factures as $facture)
                                        <tr style="border-bottom: 1px solid #f3f4f6;">
                                            <td style="padding: 1rem; font-weight: 600; color: #111827;">{{ $facture->numero }}</td>
                                            <td style="padding: 1rem;">
                                                <div style="font-weight: 500; color: #111827;">{{ $facture->user->name }}</div>
                                                <div style="font-size: 0.875rem; color: #6b7280;">{{ $facture->user->email }}</div>
                                            </td>
                                            <td style="padding: 1rem;">
                                                @if($facture->devis)
                                                    <a href="{{ route('admin.devis.show', $facture->devis) }}" style="color: #3b82f6; text-decoration: underline; font-weight: 500;">
                                                        {{ $facture->devis->numero }}
                                                    </a>
                                                @else
                                                    <span style="color: #6b7280; font-style: italic;">Aucun devis</span>
                                                @endif
                                            </td>
                                            <td style="padding: 1rem; font-weight: 600; color: #111827;">{{ number_format($facture->total_ttc, 2) }} DZD</td>
                                            <td style="padding: 1rem;">
                                                @if($facture->date_echeance)
                                                    <div style="font-size: 0.875rem; color: #111827;">{{ $facture->date_echeance->format('d/m/Y') }}</div>
                                                    @php
                                                        $joursRestants = $facture->date_echeance->diffInDays(now(), false);
                                                    @endphp
                                                    @if($joursRestants > 0)
                                                        <div style="font-size: 0.75rem; color: #ef4444;">Retard: {{ $joursRestants }} jours</div>
                                                    @elseif($joursRestants < 0)
                                                        <div style="font-size: 0.75rem; color: #10b981;">{{ abs($joursRestants) }} jours restants</div>
                                                    @else
                                                        <div style="font-size: 0.75rem; color: #f59e0b;">Échéance aujourd'hui</div>
                                                    @endif
                                                @else
                                                    <span style="color: #6b7280; font-style: italic;">Non définie</span>
                                                @endif
                                            </td>
                                            <td style="padding: 1rem;">
                                                @if($facture->statut === 'brouillon')
                                                    <span style="background: linear-gradient(135deg, #fee2e2, #fecaca); color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Brouillon</span>
                                                @elseif($facture->statut === 'envoyee')
                                                    <span style="background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #1e40af; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Envoyée</span>
                                                @elseif($facture->statut === 'payee')
                                                    <span style="background: linear-gradient(135deg, #dcfce7, #bbf7d0); color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Payée</span>
                                                @elseif($facture->statut === 'en_retard')
                                                    <span style="background: linear-gradient(135deg, #fef3c7, #fde68a); color: #92400e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">En retard</span>
                                                @else
                                                    <span style="background: linear-gradient(135deg, #f3f4f6, #e5e7eb); color: #374151; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Annulée</span>
                                                @endif
                                            </td>
                                            <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">
                                                {{ $facture->created_at->format('d/m/Y') }}
                                                <div style="font-size: 0.75rem;">{{ $facture->created_at->format('H:i') }}</div>
                                            </td>
                                            <td style="padding: 1rem;">
                                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                                    <a href="{{ route('admin.factures.show', $facture) }}" 
                                                       style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 0.375rem 0.75rem; border-radius: 0.375rem; text-decoration: none; font-size: 0.75rem; font-weight: 500;">
                                                        Voir
                                                    </a>
                                                    @if($facture->statut === 'envoyee')
                                                        <form action="{{ route('admin.factures.mark-paid', $facture) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" 
                                                                    style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 0.375rem 0.75rem; border: none; border-radius: 0.375rem; font-size: 0.75rem; font-weight: 500; cursor: pointer;">
                                                                Marquer payée
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if(in_array($facture->statut, ['envoyee', 'en_retard']))
                                                        <a href="{{ route('admin.factures.send-reminder', $facture) }}" 
                                                           style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 0.375rem 0.75rem; border-radius: 0.375rem; text-decoration: none; font-size: 0.75rem; font-weight: 500;">
                                                            Relancer
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination -->
                    @if($factures->hasPages())
                        <div style="margin-top: 2rem; display: flex; justify-content: center;">
                            {{ $factures->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 