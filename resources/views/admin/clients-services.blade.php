@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">
                    <div>
                        <h1 style="font-size: 1.875rem; font-weight: 700; color: #1f2937; margin: 0;">Clients avec Services à la Carte</h1>
                        <p style="color: #6b7280; margin-top: 0.25rem;">Gérez les clients qui ont demandé des services personnalisés</p>
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        <span style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500;">
                            {{ $clients->count() }} client(s)
                        </span>
                    </div>
                </div>

                @if($clients->isEmpty())
                    <div style="text-align: center; padding: 3rem; background: linear-gradient(135deg, #f8fafc, #e2e8f0); border-radius: 0.75rem; border: 2px dashed #cbd5e1;">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">📋</div>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Aucun client avec services à la carte</h3>
                        <p style="color: #6b7280;">Les clients qui demandent des services personnalisés apparaîtront ici.</p>
                    </div>
                @else
                    <div style="display: grid; gap: 1rem;">
                        @foreach($clients as $client)
                            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; position: relative; overflow: hidden;">
                                <!-- Header Background -->
                                <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #3b82f6, #8b5cf6, #06b6d4);"></div>
                                
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                                    <div style="flex: 1;">
                                        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                                            <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 1.125rem;">
                                                {{ strtoupper(substr($client->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin: 0;">{{ $client->name }}</h3>
                                                <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">{{ $client->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display: flex; gap: 0.5rem; align-items: center;">
                                        @if($client->devis_status === 'en_attente')
                                            <span style="background: linear-gradient(135deg, #fbbf24, #f59e0b); color: white; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">En attente</span>
                                        @elseif($client->devis_status === 'traite')
                                            <span style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Traité</span>
                                        @else
                                            <span style="background: linear-gradient(135deg, #6b7280, #4b5563); color: white; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Nouveau</span>
                                        @endif
                                        <a href="{{ route('admin.user.detail', $client->id) }}" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.3s ease;">
                                            Voir détails
                                        </a>
                                    </div>
                                </div>

                                <!-- Client Info -->
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                                    @if($client->devis_nb_individus)
                                        <div style="background: #f8fafc; padding: 0.75rem; border-radius: 0.5rem; border-left: 4px solid #3b82f6;">
                                            <div style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">Nb. Individus</div>
                                            <div style="font-weight: 600; color: #111827;">{{ $client->devis_nb_individus }}</div>
                                        </div>
                                    @endif
                                    @if($client->devis_nb_variables)
                                        <div style="background: #f8fafc; padding: 0.75rem; border-radius: 0.5rem; border-left: 4px solid #8b5cf6;">
                                            <div style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">Nb. Variables</div>
                                            <div style="font-weight: 600; color: #111827;">{{ $client->devis_nb_variables }}</div>
                                        </div>
                                    @endif
                                    @if($client->devis_delais)
                                        <div style="background: #f8fafc; padding: 0.75rem; border-radius: 0.5rem; border-left: 4px solid #06b6d4;">
                                            <div style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">Délai</div>
                                            <div style="font-weight: 600; color: #111827;">{{ $client->devis_delais }}</div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Selected Services -->
                                @if($client->devis_services)
                                    @php
                                        $services = is_string($client->devis_services) ? json_decode($client->devis_services, true) : $client->devis_services;
                                    @endphp
                                    <div style="margin-bottom: 1rem;">
                                        <h4 style="font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Services Sélectionnés</h4>
                                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                            @if(is_array($services))
                                                @foreach($services as $service)
                                                    <span style="background: linear-gradient(135deg, #e0e7ff, #c7d2fe); color: #3730a3; padding: 0.375rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; border: 1px solid #a5b4fc;">
                                                        {{ $service }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <!-- Remarks -->
                                @if($client->devis_remarques)
                                    <div style="background: #fffbeb; border: 1px solid #fed7aa; border-radius: 0.5rem; padding: 0.875rem;">
                                        <div style="font-size: 0.75rem; color: #92400e; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Remarques</div>
                                        <div style="color: #78350f; font-size: 0.875rem;">{{ $client->devis_remarques }}</div>
                                    </div>
                                @endif

                                <!-- Registration Date -->
                                <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                                    <div style="color: #6b7280; font-size: 0.875rem;">
                                        Inscrit le {{ $client->created_at->format('d/m/Y à H:i') }}
                                    </div>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <a href="{{ route('admin.devis.create', $client->id) }}" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.3s ease;">
                                            Créer Devis
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($clients->hasPages())
                        <div style="margin-top: 2rem; display: flex; justify-content: center;">
                            {{ $clients->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 