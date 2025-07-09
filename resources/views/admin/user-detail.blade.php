<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de l\'utilisateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="printable-area p-6 md:p-8 text-gray-900">
                    
                    {{-- Header with User Name and Actions --}}
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 border-b pb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                        <div class="no-print mt-4 md:mt-0 flex items-center space-x-2">
                            <a href="{{ route('admin.users') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                                Retour
                            </a>
                            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Imprimer
                            </button>
                            <a href="{{ route('admin.users.pdf', $user) }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                PDF
                            </a>
                        </div>
                    </div>

                    {{-- Pack Information Section --}}
                    @if($user->pack && $user->pack !== 'services_carte')
                        <div style="margin-top: 2rem; background: linear-gradient(135deg, #ede9fe, #ddd6fe); border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #8b5cf6;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                <div style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 50%; width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 1rem;">📦</div>
                                <div>
                                    <h4 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0;">Pack Souscrit</h4>
                                    <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">Package choisi par le client</p>
                                </div>
                                <div style="margin-left: auto;">
                                    @if($user->pack === 'starter')
                                        <span style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600;">PACK STARTER</span>
                                    @elseif($user->pack === 'professionnel')
                                        <span style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600;">PACK PROFESSIONNEL</span>
                                    @elseif($user->pack === 'expert')
                                        <span style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600;">PACK EXPERT</span>
                                    @else
                                        <span style="background: linear-gradient(135deg, #6b7280, #4b5563); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600;">{{ strtoupper($user->pack) }}</span>
                                    @endif
                                </div>
                            </div>

                            <div style="background: white; border-radius: 0.5rem; padding: 1rem; margin-top: 1rem;">
                                @if($user->pack === 'starter')
                                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                                        <div style="text-align: center; padding: 0.75rem; background: #f0fdf4; border-radius: 0.5rem;">
                                            <div style="font-size: 1.5rem; font-weight: 700; color: #16a34a;">5000 DZD</div>
                                            <div style="font-size: 0.75rem; color: #166534; text-transform: uppercase; font-weight: 600;">Prix du pack</div>
                                        </div>
                                        <div style="text-align: center; padding: 0.75rem; background: #eff6ff; border-radius: 0.5rem;">
                                            <div style="font-size: 1.5rem; font-weight: 700; color: #2563eb;">15 jours</div>
                                            <div style="font-size: 0.75rem; color: #1e40af; text-transform: uppercase; font-weight: 600;">Délai de livraison</div>
                                        </div>
                                    </div>
                                    <div style="margin-top: 1rem;">
                                        <div style="font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Services inclus :</div>
                                        <ul style="list-style: none; padding: 0; margin: 0; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 0.5rem;">
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #16a34a;">✓</span> Statistiques descriptives complètes</li>
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #16a34a;">✓</span> Tests de base (t-test, chi-carré)</li>
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #16a34a;">✓</span> Graphiques et tableaux</li>
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #16a34a;">✓</span> Rapport de 10-15 pages</li>
                                        </ul>
                                    </div>
                                @elseif($user->pack === 'professionnel')
                                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                                        <div style="text-align: center; padding: 0.75rem; background: #eff6ff; border-radius: 0.5rem;">
                                            <div style="font-size: 1.5rem; font-weight: 700; color: #2563eb;">12000 DZD</div>
                                            <div style="font-size: 0.75rem; color: #1e40af; text-transform: uppercase; font-weight: 600;">Prix du pack</div>
                                        </div>
                                        <div style="text-align: center; padding: 0.75rem; background: #fef3c7; border-radius: 0.5rem;">
                                            <div style="font-size: 1.5rem; font-weight: 700; color: #d97706;">21 jours</div>
                                            <div style="font-size: 0.75rem; color: #92400e; text-transform: uppercase; font-weight: 600;">Délai de livraison</div>
                                        </div>
                                    </div>
                                    <div style="margin-top: 1rem;">
                                        <div style="font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Services inclus :</div>
                                        <ul style="list-style: none; padding: 0; margin: 0; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 0.5rem;">
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #2563eb;">✓</span> Tout du pack Starter</li>
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #2563eb;">✓</span> Analyses multivariées avancées</li>
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #2563eb;">✓</span> Modélisation prédictive</li>
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #2563eb;">✓</span> Rapport de 20-30 pages</li>
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #2563eb;">✓</span> 1 révision incluse</li>
                                        </ul>
                                    </div>
                                @elseif($user->pack === 'expert')
                                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                                        <div style="text-align: center; padding: 0.75rem; background: #fef3c7; border-radius: 0.5rem;">
                                            <div style="font-size: 1.5rem; font-weight: 700; color: #d97706;">25000 DZD</div>
                                            <div style="font-size: 0.75rem; color: #92400e; text-transform: uppercase; font-weight: 600;">Prix du pack</div>
                                        </div>
                                        <div style="text-align: center; padding: 0.75rem; background: #fee2e2; border-radius: 0.5rem;">
                                            <div style="font-size: 1.5rem; font-weight: 700; color: #dc2626;">30 jours</div>
                                            <div style="font-size: 0.75rem; color: #991b1b; text-transform: uppercase; font-weight: 600;">Délai de livraison</div>
                                        </div>
                                    </div>
                                    <div style="margin-top: 1rem;">
                                        <div style="font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Services inclus :</div>
                                        <ul style="list-style: none; padding: 0; margin: 0; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 0.5rem;">
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #d97706;">✓</span> Tout des packs précédents</li>
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #d97706;">✓</span> Analyses très avancées</li>
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #d97706;">✓</span> Machine Learning & IA</li>
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #d97706;">✓</span> Rapport de 40+ pages</li>
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #d97706;">✓</span> 3 révisions incluses</li>
                                            <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0;"><span style="color: #d97706;">✓</span> Support prioritaire</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- User Information Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-600 mb-3">Informations Personnelles</h4>
                            <dl class="space-y-2">
                                <div class="flex justify-between"><dt class="text-sm text-gray-500">Nom Complet</dt><dd class="text-sm font-medium text-gray-800">{{ $user->nom }} {{ $user->prenom }}</dd></div>
                                <div class="flex justify-between"><dt class="text-sm text-gray-500">Email</dt><dd class="text-sm font-medium text-gray-800">{{ $user->email }}</dd></div>
                                <div class="flex justify-between"><dt class="text-sm text-gray-500">Profession</dt><dd class="text-sm font-medium text-gray-800">{{ $user->profession ?? 'N/A' }}</dd></div>
                                <div class="flex justify-between"><dt class="text-sm text-gray-500">Téléphone</dt><dd class="text-sm font-medium text-gray-800">{{ $user->telephone ?? 'N/A' }}</dd></div>
                            </dl>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-600 mb-3">Informations du Compte</h4>
                            <dl class="space-y-2">
                                <div class="flex justify-between"><dt class="text-sm text-gray-500">Type de Client</dt><dd class="text-sm font-medium text-gray-800">{{ $user->pack === 'services_carte' ? 'Services à la carte' : 'Pack ' . ucfirst($user->pack ?? 'N/A') }}</dd></div>
                                <div class="flex justify-between"><dt class="text-sm text-gray-500">Rôle</dt><dd class="text-sm font-medium text-gray-800">{{ ucfirst($user->role) }}</dd></div>
                                <div class="flex justify-between"><dt class="text-sm text-gray-500">Membre depuis</dt><dd class="text-sm font-medium text-gray-800">{{ $user->created_at->format('d M, Y') }}</dd></div>
                                <div class="flex justify-between"><dt class="text-sm text-gray-500">Email Verifié</dt><dd class="text-sm font-medium text-gray-800">{{ $user->email_verified_at ? $user->email_verified_at->format('d M, Y') : 'Non' }}</dd></div>
                            </dl>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-600 mb-3">Préférences & Paiement</h4>
                            <dl class="space-y-2">
                                <div class="flex justify-between"><dt class="text-sm text-gray-500">Réunion</dt><dd class="text-sm font-medium text-gray-800">{{ $user->meeting_preference ?? 'N/A' }}</dd></div>
                                <div class="flex justify-between"><dt class="text-sm text-gray-500">Paiement</dt><dd class="text-sm font-medium text-gray-800">{{ $user->payment_preference ?? 'N/A' }}</dd></div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500">État Paiement</dt>
                                    <dd class="text-sm font-medium">
                                        @if($user->payment_status === 'paid')
                                            <span class="text-green-600 font-semibold">✓ Payé</span>
                                        @elseif($user->payment_status === 'pending')
                                            <span class="text-yellow-600 font-semibold">⏳ En attente</span>
                                        @else
                                            <span class="text-gray-500">{{ $user->payment_status ?? 'N/A' }}</span>
                                        @endif
                                    </dd>
                                </div>
                                <div class="flex justify-between"><dt class="text-sm text-gray-500">Fichiers</dt><dd class="text-sm font-medium text-gray-800">{{ $user->files->count() }} fichier(s)</dd></div>
                            </dl>
                        </div>
                    </div>

                    {{-- Services à la Carte Section --}}
                    @if($user->pack === 'services_carte' || $user->devis_services || $user->devis_nb_individus || $user->devis_nb_variables || $user->devis_delais || $user->devis_remarques)
                        <div style="margin-top: 2rem; background: linear-gradient(135deg, #f8fafc, #e2e8f0); border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #3b82f6;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                <div style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius: 50%; width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 1rem;">📋</div>
                                <div>
                                    <h4 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0;">Services à la Carte Demandés</h4>
                                    <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">Informations sur la demande de devis personnalisé</p>
                                </div>
                                @if($user->devis_status)
                                    <div style="margin-left: auto;">
                                        @if($user->devis_status === 'en_attente')
                                            <span style="background: linear-gradient(135deg, #fbbf24, #f59e0b); color: white; padding: 0.375rem 0.875rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">En attente</span>
                                        @elseif($user->devis_status === 'traite')
                                            <span style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 0.375rem 0.875rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Traité</span>
                                        @else
                                            <span style="background: linear-gradient(135deg, #6b7280, #4b5563); color: white; padding: 0.375rem 0.875rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Nouveau</span>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            {{-- Project Details --}}
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
                                <div style="background: white; padding: 1rem; border-radius: 0.5rem; border-left: 4px solid #3b82f6; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                                    <div style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Nombre d'Individus</div>
                                    <div style="font-size: 1.125rem; font-weight: 600; color: #111827;">
                                        {{ $user->devis_nb_individus ?: 'Non spécifié' }}
                                        @if(!$user->devis_nb_individus)<span style="color: #ef4444; font-size: 0.875rem; font-weight: 400;">⚠️ À compléter</span>@endif
                                    </div>
                                </div>
                                
                                <div style="background: white; padding: 1rem; border-radius: 0.5rem; border-left: 4px solid #8b5cf6; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                                    <div style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Nombre de Variables</div>
                                    <div style="font-size: 1.125rem; font-weight: 600; color: #111827;">
                                        {{ $user->devis_nb_variables ?: 'Non spécifié' }}
                                        @if(!$user->devis_nb_variables)<span style="color: #ef4444; font-size: 0.875rem; font-weight: 400;">⚠️ À compléter</span>@endif
                                    </div>
                                </div>
                                
                                <div style="background: white; padding: 1rem; border-radius: 0.5rem; border-left: 4px solid #06b6d4; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                                    <div style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Délai Souhaité</div>
                                    <div style="font-size: 1.125rem; font-weight: 600; color: #111827;">
                                        {{ $user->devis_delais ?: 'Non spécifié' }}
                                        @if(!$user->devis_delais)<span style="color: #ef4444; font-size: 0.875rem; font-weight: 400;">⚠️ À compléter</span>@endif
                                    </div>
                                </div>
                            </div>

                            {{-- Selected Services --}}
                            <div style="margin-bottom: 1.5rem;">
                                <h5 style="font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Services Sélectionnés</h5>
                                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                    @if($user->devis_services)
                                        @php
                                            $services = is_string($user->devis_services) ? json_decode($user->devis_services, true) : $user->devis_services;
                                        @endphp
                                        @if(is_array($services) && count($services) > 0)
                                            @foreach($services as $service)
                                                <span style="background: linear-gradient(135deg, #e0e7ff, #c7d2fe); color: #3730a3; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500; border: 1px solid #a5b4fc;">
                                                    {{ $service }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span style="background: linear-gradient(135deg, #fee2e2, #fecaca); color: #991b1b; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500; border: 1px solid #f87171;">
                                                ⚠️ Aucun service sélectionné - À compléter
                                            </span>
                                        @endif
                                    @else
                                        <span style="background: linear-gradient(135deg, #fee2e2, #fecaca); color: #991b1b; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500; border: 1px solid #f87171;">
                                            ⚠️ Aucun service sélectionné - À compléter
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Remarks --}}
                            <div style="background: white; border: 1px solid #fed7aa; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1.5rem;">
                                <div style="font-size: 0.75rem; color: #92400e; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Remarques du Client</div>
                                <div style="color: #78350f; font-size: 0.875rem; line-height: 1.5;">
                                    @if($user->devis_remarques)
                                        {{ $user->devis_remarques }}
                                    @else
                                        <span style="color: #9ca3af; font-style: italic;">Aucune remarque spécifique fournie</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="no-print" style="margin-top: 1.5rem; display: flex; gap: 0.75rem; flex-wrap: wrap;">
                                @if($user->devis_status !== 'traite')
                                    <a href="{{ route('admin.devis.create', $user->id) }}" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.3s ease;">
                                        Créer un Devis
                                    </a>
                                @endif
                                <button onclick="markAsProcessed({{ $user->id }})" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; border: none; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: all 0.3s ease;">
                                    Marquer comme Traité
                                </button>
                            </div>
                        </div>
                    @endif
                    


                    {{-- User Files List --}}
                    <div class="mt-8">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Fichiers Téléchargés</h4>
                        @if($user->files->count() > 0)
                            <div class="overflow-x-auto border rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom du fichier</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Taille</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date de dépôt</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($user->files as $file)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $file->original_name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($file->file_size / 1024, 2) }} KB</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $file->created_at->format('d M, Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-8 bg-gray-50 rounded-lg">
                                <p class="text-gray-500">Cet utilisateur n'a téléchargé aucun fichier.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .printable-area, .printable-area * {
                visibility: visible;
            }
            .printable-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>

    <script>
        function markAsProcessed(userId) {
            if (confirm('Marquer cette demande comme traitée ?')) {
                fetch(`/admin/users/${userId}/mark-processed`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Erreur lors de la mise à jour');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Erreur lors de la mise à jour');
                });
            }
        }
    </script>
</x-app-layout> 