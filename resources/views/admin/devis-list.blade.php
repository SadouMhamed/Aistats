@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">
                    <div>
                        <h1 style="font-size: 1.875rem; font-weight: 700; color: #1f2937; margin: 0;">Gestion des Devis</h1>
                        <p style="color: #6b7280; margin-top: 0.25rem;">Tous les devis créés dans le système</p>
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        <span style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500;">
                            {{ $devis->total() }} devis
                        </span>
                        <a href="{{ route('admin.dashboard') }}" style="background: linear-gradient(135deg, #6b7280, #4b5563); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                            Retour Dashboard
                        </a>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                    @php
                        $brouillons = $devis->where('statut', 'brouillon')->count();
                        $envoyes = $devis->where('statut', 'envoye')->count();
                        $acceptes = $devis->where('statut', 'accepte')->count();
                        $refuses = $devis->where('statut', 'refuse')->count();
                        $totalAmount = $devis->where('statut', 'accepte')->sum('total_ttc');
                    @endphp
                    
                    <div style="background: linear-gradient(135deg, #fee2e2, #fecaca); border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #ef4444;">
                        <div style="font-size: 0.75rem; color: #991b1b; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">Brouillons</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: #dc2626;">{{ $brouillons }}</div>
                    </div>
                    
                    <div style="background: linear-gradient(135deg, #dbeafe, #bfdbfe); border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #3b82f6;">
                        <div style="font-size: 0.75rem; color: #1e40af; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">Envoyés</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: #2563eb;">{{ $envoyes }}</div>
                    </div>
                    
                    <div style="background: linear-gradient(135deg, #dcfce7, #bbf7d0); border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #22c55e;">
                        <div style="font-size: 0.75rem; color: #166534; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">Acceptés</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: #16a34a;">{{ $acceptes }}</div>
                    </div>
                    
                    <div style="background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #f59e0b;">
                        <div style="font-size: 0.75rem; color: #92400e; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">CA Total</div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: #d97706;">{{ number_format($totalAmount, 2) }} DZD</div>
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
                                <option value="envoye" {{ request('statut') == 'envoye' ? 'selected' : '' }}>Envoyé</option>
                                <option value="accepte" {{ request('statut') == 'accepte' ? 'selected' : '' }}>Accepté</option>
                                <option value="refuse" {{ request('statut') == 'refuse' ? 'selected' : '' }}>Refusé</option>
                                <option value="expire" {{ request('statut') == 'expire' ? 'selected' : '' }}>Expiré</option>
                            </select>
                        </div>
                        
                        <div style="flex: 1; min-width: 200px;">
                            <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Type</label>
                            <select name="type" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                                <option value="">Tous les types</option>
                                <option value="services_carte" {{ request('type') == 'services_carte' ? 'selected' : '' }}>Services à la carte</option>
                                <option value="pack_landing" {{ request('type') == 'pack_landing' ? 'selected' : '' }}>Pack Landing</option>
                                <option value="personnalise" {{ request('type') == 'personnalise' ? 'selected' : '' }}>Personnalisé</option>
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
                            <a href="{{ route('admin.devis.index') }}" style="background: #f3f4f6; color: #374151; padding: 0.5rem 1rem; border: 1px solid #d1d5db; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                @if($devis->isEmpty())
                    <div style="text-align: center; padding: 3rem; background: linear-gradient(135deg, #f8fafc, #e2e8f0); border-radius: 0.75rem; border: 2px dashed #cbd5e1;">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">📋</div>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Aucun devis trouvé</h3>
                        <p style="color: #6b7280;">Les devis créés apparaîtront ici.</p>
                    </div>
                @else
                    <!-- Devis List -->
                    <div style="background: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden;">
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead style="background: #f9fafb;">
                                    <tr>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Numéro</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Client</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Titre</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Type</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Montant</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Statut</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Date</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($devis as $devisItem)
                                        <tr style="border-bottom: 1px solid #f3f4f6;">
                                            <td style="padding: 1rem; font-weight: 600; color: #111827;">{{ $devisItem->numero }}</td>
                                            <td style="padding: 1rem;">
                                                <div style="font-weight: 500; color: #111827;">{{ $devisItem->user->name }}</div>
                                                <div style="font-size: 0.875rem; color: #6b7280;">{{ $devisItem->user->email }}</div>
                                            </td>
                                            <td style="padding: 1rem;">
                                                <div style="font-weight: 500; color: #111827;">{{ Str::limit($devisItem->titre, 30) }}</div>
                                                @if($devisItem->description)
                                                    <div style="font-size: 0.875rem; color: #6b7280;">{{ Str::limit($devisItem->description, 50) }}</div>
                                                @endif
                                            </td>
                                            <td style="padding: 1rem;">
                                                @if($devisItem->type === 'services_carte')
                                                    <span style="background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #1e40af; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Services à la carte</span>
                                                @elseif($devisItem->type === 'pack_landing')
                                                    <span style="background: linear-gradient(135deg, #ede9fe, #ddd6fe); color: #6b21a8; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Pack Landing</span>
                                                @else
                                                    <span style="background: linear-gradient(135deg, #f3f4f6, #e5e7eb); color: #374151; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Personnalisé</span>
                                                @endif
                                            </td>
                                            <td style="padding: 1rem; font-weight: 600; color: #111827;">{{ number_format($devisItem->total_ttc, 2) }} DZD</td>
                                            <td style="padding: 1rem;">
                                                @if($devisItem->statut === 'brouillon')
                                                    <span style="background: linear-gradient(135deg, #fee2e2, #fecaca); color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Brouillon</span>
                                                @elseif($devisItem->statut === 'envoye')
                                                    <span style="background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #1e40af; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Envoyé</span>
                                                @elseif($devisItem->statut === 'accepte')
                                                    <span style="background: linear-gradient(135deg, #dcfce7, #bbf7d0); color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Accepté</span>
                                                @elseif($devisItem->statut === 'refuse')
                                                    <span style="background: linear-gradient(135deg, #fef3c7, #fde68a); color: #92400e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Refusé</span>
                                                @else
                                                    <span style="background: linear-gradient(135deg, #f3f4f6, #e5e7eb); color: #374151; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Expiré</span>
                                                @endif
                                            </td>
                                            <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">
                                                {{ $devisItem->created_at->format('d/m/Y') }}
                                                <div style="font-size: 0.75rem;">{{ $devisItem->created_at->format('H:i') }}</div>
                                            </td>
                                            <td style="padding: 1rem;">
                                                <div style="display: flex; gap: 0.5rem;">
                                                    <a href="{{ route('admin.devis.show', $devisItem) }}" 
                                                       style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 0.375rem 0.75rem; border-radius: 0.375rem; text-decoration: none; font-size: 0.75rem; font-weight: 500;">
                                                        Voir
                                                    </a>
                                                    @if($devisItem->statut === 'accepte' && !$devisItem->facture)
                                                        <form action="{{ route('admin.factures.create', $devisItem) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" 
                                                                    style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 0.375rem 0.75rem; border: none; border-radius: 0.375rem; font-size: 0.75rem; font-weight: 500; cursor: pointer;">
                                                                Facturer
                                                            </button>
                                                        </form>
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
                    @if($devis->hasPages())
                        <div style="margin-top: 2rem; display: flex; justify-content: center;">
                            {{ $devis->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 