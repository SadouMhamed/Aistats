<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        try {
            // Préparer les données pour l'email
            $data = [
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'message' => $request->message,
                'date' => now()->format('d/m/Y H:i'),
            ];

            // Envoyer l'email (configuration mail nécessaire)
            Mail::send('emails.contact', $data, function ($message) use ($data) {
                $message->to('contact.walidpro@gmail.com')
                        ->subject('Nouvelle demande de contact - AIStats')
                        ->replyTo($data['email'], $data['prenom'] . ' ' . $data['nom']);
            });

            return back()->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');

        } catch (\Exception $e) {
            Log::error('Erreur envoi email contact: ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer ou nous contacter directement.');
        }
    }
} 