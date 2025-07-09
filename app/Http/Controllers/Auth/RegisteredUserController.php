<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Debug logging
        Log::info('Registration attempt', [
            'email' => $request->email,
            'has_devis_services' => $request->filled('devis_services'),
            'devis_services' => $request->devis_services,
            'pack' => $request->pack
        ]);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'profession' => ['nullable', 'string', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'pack' => ['nullable', 'string', 'max:255'],
            'meeting_preference' => ['required', 'string', 'in:en ligne,en présentiel'],
            'payment_preference' => ['required', 'string', 'in:en ligne,main à main'],
            // Validation pour les données du devis
            'devis_services' => ['nullable', 'string'],
            'devis_nb_individus' => ['nullable', 'numeric'],
            'devis_nb_variables' => ['nullable', 'numeric'],
            'devis_delais' => ['nullable', 'string', 'max:255'],
            'devis_remarques' => ['nullable', 'string'],
        ]);

        // Si c'est une demande de devis services à la carte, définir le pack
        $pack = $request->pack;
        if ($request->filled('devis_services') && !$pack) {
            $pack = 'services_carte';
        }

        $user = User::create([
            'name' => $request->name,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'profession' => $request->profession,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pack' => $pack,
            'meeting_preference' => $request->meeting_preference,
            'payment_preference' => $request->payment_preference,
            'devis_services' => $request->devis_services ? json_decode($request->devis_services, true) : null,
            'devis_nb_individus' => $request->devis_nb_individus ? (int)$request->devis_nb_individus : null,
            'devis_nb_variables' => $request->devis_nb_variables ? (int)$request->devis_nb_variables : null,
            'devis_delais' => $request->devis_delais,
            'devis_remarques' => $request->devis_remarques,
        ]);

        Log::info('User created successfully', [
            'user_id' => $user->id,
            'email' => $user->email,
            'pack' => $user->pack,
            'devis_services' => $user->devis_services
        ]);

        event(new Registered($user));

        // Si des données de devis sont présentes, envoyer un email à l'admin
        if ($request->filled('devis_services')) {
            $this->sendDevisNotificationToAdmin($user, $request);
        }

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Envoyer une notification email à l'admin avec les données du devis
     */
    private function sendDevisNotificationToAdmin(User $user, Request $request): void
    {
        try {
            $services = $request->devis_services ? json_decode($request->devis_services, true) : [];
            
            $emailData = [
                'user' => $user,
                'services' => $services,
                'nb_individus' => $request->devis_nb_individus,
                'nb_variables' => $request->devis_nb_variables,
                'delais' => $request->devis_delais,
                'remarques' => $request->devis_remarques,
            ];

            // Utiliser l'email de contact comme destinataire admin
            $adminEmail = 'Aistat2025@gmail.com';

            Mail::send('emails.devis-notification', $emailData, function ($message) use ($adminEmail, $user) {
                $message->to($adminEmail)
                        ->subject('Nouvelle demande de devis - ' . $user->prenom . ' ' . $user->nom)
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });

        } catch (\Exception $e) {
            // Log l'erreur mais ne pas interrompre l'inscription
            Log::error('Erreur envoi email devis: ' . $e->getMessage());
        }
    }
}
