<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Selected Pack Information -->
        @if(request('pack'))
            <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg text-center">
                <p class="font-semibold text-gray-800">Vous avez sélectionné :</p>
                <h2 class="text-xl font-bold text-blue-600">{{ request('pack') }}</h2>
            </div>
        @endif

        <!-- Services à la carte Information -->
        @if(request('devis'))
            <div id="devis-info" class="mb-6 p-6 bg-green-50 border border-green-200 rounded-lg" style="display: none;">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">📋 Votre demande de devis :</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h4 class="font-medium text-gray-700 mb-2">Services sélectionnés :</h4>
                        <ul id="services-list" class="list-disc list-inside text-sm text-gray-600 space-y-1">
                            <!-- Services will be populated by JavaScript -->
                        </ul>
                    </div>
                    
                    <div class="space-y-2">
                        <div>
                            <span class="font-medium text-gray-700">Nombre d'individus :</span>
                            <span id="nb-individus-display" class="text-gray-600"></span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Nombre de variables :</span>
                            <span id="nb-variables-display" class="text-gray-600 font-semibold"></span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Délai souhaité :</span>
                            <span id="delais-display" class="text-gray-600 font-semibold"></span>
                        </div>
                    </div>
                </div>
                
                <div id="remarques-section" class="mt-4" style="display: none;">
                    <span class="font-medium text-gray-700">Remarques :</span>
                    <p id="remarques-display" class="text-gray-600 italic mt-1"></p>
                </div>
                
                <div class="mt-4 p-3 bg-blue-100 rounded-lg">
                    <p class="text-sm text-blue-800">
                        💡 <strong>Après votre inscription :</strong> Notre équipe recevra automatiquement votre demande de devis avec tous ces détails et vous contactera rapidement pour finaliser votre projet.
                    </p>
                </div>
            </div>

            <!-- Hidden inputs for devis data -->
            <input type="hidden" id="devis-services" name="devis_services" value="">
            <input type="hidden" id="devis-nb-individus" name="devis_nb_individus" value="">
            <input type="hidden" id="devis-nb-variables" name="devis_nb_variables" value="">
            <input type="hidden" id="devis-delais" name="devis_delais" value="">
            <input type="hidden" id="devis-remarques" name="devis_remarques" value="">
        @endif

        <!-- Hidden input for the pack -->
        <input type="hidden" name="pack" value="{{ request('pack') }}">

        <!-- Name (keeping for compatibility) -->
        <div>
            <x-input-label for="name" :value="__('Nom d\'utilisateur')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Nom -->
        <div class="mt-4">
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autocomplete="family-name" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- Prenom -->
        <div class="mt-4">
            <x-input-label for="prenom" :value="__('Prénom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autocomplete="given-name" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <!-- Profession -->
        <div class="mt-4">
            <x-input-label for="profession" :value="__('Profession')" />
            <x-text-input id="profession" class="block mt-1 w-full" type="text" name="profession" :value="old('profession')" required autocomplete="organization-title" />
            <x-input-error :messages="$errors->get('profession')" class="mt-2" />
        </div>

        <!-- Telephone -->
        <div class="mt-4">
            <x-input-label for="telephone" :value="__('Numéro de téléphone')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="tel" name="telephone" :value="old('telephone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Meeting Preference -->
        <div class="mt-4">
            <x-input-label value="Préférence de réunion" />
            <div class="mt-2 space-y-2">
                <label for="meeting_online" class="inline-flex items-center">
                    <input id="meeting_online" type="radio" class="form-radio" name="meeting_preference" value="en ligne" required>
                    <span class="ml-2">En ligne</span>
                </label>
                <label for="meeting_in_person" class="inline-flex items-center ml-4">
                    <input id="meeting_in_person" type="radio" class="form-radio" name="meeting_preference" value="en présentiel">
                    <span class="ml-2">En présentiel</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('meeting_preference')" class="mt-2" />
        </div>

        <!-- Payment Preference -->
        <div class="mt-4">
            <x-input-label value="Préférence de paiement" />
            <div class="mt-2 space-y-2">
                <label for="payment_online" class="inline-flex items-center">
                    <input id="payment_online" type="radio" class="form-radio" name="payment_preference" value="en ligne" required>
                    <span class="ml-2">En ligne</span>
                </label>
                <label for="payment_in_person" class="inline-flex items-center ml-4">
                    <input id="payment_in_person" type="radio" class="form-radio" name="payment_preference" value="main à main">
                    <span class="ml-2">Main à main</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('payment_preference')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Déjà inscrit?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('S\'inscrire') }}
            </x-primary-button>
        </div>
    </form>

    @if(request('devis'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Récupérer les données du devis depuis localStorage
            const devisData = localStorage.getItem('devis_data');
            
            if (devisData) {
                try {
                    const data = JSON.parse(devisData);
                    
                    // Afficher la section devis
                    const devisInfo = document.getElementById('devis-info');
                    if (devisInfo) {
                        devisInfo.style.display = 'block';
                    }
                    
                    // Remplir les services sélectionnés
                    const servicesList = document.getElementById('services-list');
                    if (data.services && data.services.length > 0) {
                        servicesList.innerHTML = '';
                        data.services.forEach(service => {
                            const li = document.createElement('li');
                            li.textContent = service;
                            servicesList.appendChild(li);
                        });
                    }
                    
                    // Remplir les autres informations
                    const nbIndividusDisplay = document.getElementById('nb-individus-display');
                    if (nbIndividusDisplay) {
                        nbIndividusDisplay.textContent = data.nb_individus || 'Non spécifié';
                    }
                    
                    const nbVariablesDisplay = document.getElementById('nb-variables-display');
                    if (nbVariablesDisplay) {
                        nbVariablesDisplay.textContent = data.nb_variables || 'Non spécifié';
                    }
                    
                    const delaisDisplay = document.getElementById('delais-display');
                    if (delaisDisplay) {
                        delaisDisplay.textContent = data.delais || 'Non spécifié';
                    }
                    
                    // Afficher les remarques si présentes
                    if (data.remarques && data.remarques.trim()) {
                        const remarquesSection = document.getElementById('remarques-section');
                        const remarquesDisplay = document.getElementById('remarques-display');
                        if (remarquesSection && remarquesDisplay) {
                            remarquesDisplay.textContent = data.remarques;
                            remarquesSection.style.display = 'block';
                        }
                    }
                    
                    // Remplir les champs cachés pour l'envoi du formulaire
                    document.getElementById('devis-services').value = JSON.stringify(data.services);
                    document.getElementById('devis-nb-individus').value = data.nb_individus || '';
                    document.getElementById('devis-nb-variables').value = data.nb_variables || '';
                    document.getElementById('devis-delais').value = data.delais || '';
                    document.getElementById('devis-remarques').value = data.remarques || '';
                    
                } catch (error) {
                    console.error('Erreur lors du parsing des données de devis:', error);
                }
            }
        });
    </script>
    @endif
</x-guest-layout>
