<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ClientController extends Controller
{
    /**
     * Display a list of devis for the authenticated client
     */
    public function devisIndex()
    {
        $user = Auth::user();
        $devis = $user->devis()->with('admin')->orderBy('created_at', 'desc')->get();
        
        return view('client.devis.index', compact('devis'));
    }

    /**
     * Show a specific devis for the authenticated client
     */
    public function devisShow(Devis $devis)
    {
        // Ensure the devis belongs to the authenticated user
        if ($devis->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé à ce devis.');
        }

        $devis->load('admin');
        
        return view('client.devis.show', compact('devis'));
    }

    /**
     * Accept a devis
     */
    public function acceptDevis(Devis $devis)
    {
        // Ensure the devis belongs to the authenticated user
        if ($devis->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé à ce devis.');
        }

        // Check if devis is still valid
        if ($devis->statut !== 'envoye') {
            return redirect()->back()->with('error', 'Ce devis ne peut plus être accepté.');
        }

        $devis->update([
            'statut' => 'accepte',
            'date_reponse' => now()
        ]);

        return redirect()->back()->with('success', 'Devis accepté avec succès! Une facture sera générée prochainement.');
    }

    /**
     * Reject a devis
     */
    public function rejectDevis(Devis $devis)
    {
        // Ensure the devis belongs to the authenticated user
        if ($devis->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé à ce devis.');
        }

        // Check if devis can be rejected
        if ($devis->statut !== 'envoye') {
            return redirect()->back()->with('error', 'Ce devis ne peut plus être refusé.');
        }

        $devis->update([
            'statut' => 'refuse',
            'date_reponse' => now()
        ]);

        return redirect()->back()->with('success', 'Devis refusé.');
    }

    /**
     * Download devis as PDF
     */
    public function downloadDevisPDF(Devis $devis)
    {
        // Ensure the devis belongs to the authenticated user
        if ($devis->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé à ce devis.');
        }

        $devis->load('user', 'admin');
        
        $pdf = Pdf::loadView('client.devis.pdf', compact('devis'));
        
        return $pdf->download('devis-' . $devis->numero . '.pdf');
    }

    /**
     * Display a list of factures for the authenticated client
     */
    public function facturesIndex()
    {
        $user = Auth::user();
        $factures = $user->factures()->with(['admin', 'devis'])->orderBy('created_at', 'desc')->get();
        
        return view('client.factures.index', compact('factures'));
    }

    /**
     * Show a specific facture for the authenticated client
     */
    public function facturesShow(Facture $facture)
    {
        // Ensure the facture belongs to the authenticated user
        if ($facture->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé à cette facture.');
        }

        $facture->load(['admin', 'devis']);
        
        return view('client.factures.show', compact('facture'));
    }

    /**
     * Download facture as PDF
     */
    public function downloadFacturePDF(Facture $facture)
    {
        // Ensure the facture belongs to the authenticated user
        if ($facture->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé à cette facture.');
        }

        $facture->load('user', 'admin', 'devis');
        
        $pdf = Pdf::loadView('client.factures.pdf', compact('facture'));
        
        return $pdf->download('facture-' . $facture->numero . '.pdf');
    }
} 