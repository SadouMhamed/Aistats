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
</x-guest-layout>
