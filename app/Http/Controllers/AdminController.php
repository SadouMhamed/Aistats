<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\File;
use App\Models\AdminUserFile;
use App\Models\Devis;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $adminUsers = User::where('role', 'admin')->count();
        $regularUsers = User::where('role', 'user')->count();
        
        // File statistics
        $totalFiles = File::count();
        $totalFileSize = File::sum('file_size');
        $recentFiles = File::whereDate('created_at', '>=', now()->subDays(7))->count();
        $usersWithFiles = User::has('files')->count();
        
        return view('admin.dashboard', compact(
            'totalUsers', 
            'adminUsers', 
            'regularUsers',
            'totalFiles',
            'totalFileSize',
            'recentFiles',
            'usersWithFiles'
        ));
    }

    /**
     * Show all users
     */
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    /**
     * Update user role
     */
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin'
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->back()->with('success', 'User role updated successfully!');
    }

    /**
     * Show all files
     */
    public function files()
    {
        $files = File::with('user')->latest()->paginate(15);
        $totalFiles = File::count();
        $totalSize = File::sum('file_size');
        $fileTypes = File::selectRaw('file_extension, COUNT(*) as count')
            ->groupBy('file_extension')
            ->orderBy('count', 'desc')
            ->get();

        return view('admin.files', compact('files', 'totalFiles', 'totalSize', 'fileTypes'));
    }

    /**
     * Show file statistics
     */
    public function fileStats()
    {
        $stats = [
            'total_files' => File::count(),
            'total_size' => File::sum('file_size'),
            'files_today' => File::whereDate('created_at', today())->count(),
            'files_this_week' => File::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'files_this_month' => File::whereMonth('created_at', now()->month)->count(),
            'users_with_files' => User::has('files')->count(),
            'file_types' => File::selectRaw('file_extension, COUNT(*) as count')
                ->groupBy('file_extension')
                ->orderBy('count', 'desc')
                ->get(),
            'top_uploaders' => User::withCount('files')
                ->orderBy('files_count', 'desc')
                ->limit(5)
                ->get()
        ];

        return view('admin.file-stats', compact('stats'));
    }

    /**
     * Delete file as admin
     */
    public function deleteFile(File $file)
    {
        // Delete the physical file
        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }

        // Delete the database record
        $file->delete();

        return redirect()->back()->with('success', 'Fichier supprimé avec succès!');
    }

    /**
     * Show a specific user's details.
     */
    public function show(User $user)
    {
        $user->load('files');
        return view('admin.user-detail', compact('user'));
    }

    /**
     * Download user details as a PDF.
     */
    public function downloadPDF(User $user)
    {
        $user->load('files');
        $pdf = Pdf::loadView('admin.user-detail-pdf', compact('user'));
        $fileName = 'user-details-' . $user->id . '-' . Str::slug($user->name) . '.pdf';
        return $pdf->download($fileName);
    }

    /**
     * Update user payment status.
     */
    public function updatePaymentStatus(Request $request, User $user)
    {
        $request->validate([
            'payment_status' => 'required|in:En attente,Payé,Échoué,Annulé,Remboursé'
        ]);

        $user->update(['payment_status' => $request->payment_status]);

        return redirect()->back()->with('success', 'Statut de paiement mis à jour avec succès!');
    }

    /**
     * Show form to send file to user
     */
    public function showSendFileForm()
    {
        $users = User::where('role', 'user')->orderBy('name')->get();
        return view('admin.send-file', compact('users'));
    }

    /**
     * Send file to a specific user
     */
    public function sendFileToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,csv,spss|max:10240',
            'message' => 'nullable|string|max:500'
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . Str::random(10) . '.' . $fileExtension;
        
        // Store the file
        $filePath = $file->storeAs('admin_files', $fileName, 'public');

        // Create database record
        AdminUserFile::create([
            'admin_id' => Auth::id(),
            'user_id' => $request->user_id,
            'original_name' => $originalName,
            'file_path' => $filePath,
            'file_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'message' => $request->message,
            'download_permission' => false, // Default to no permission
        ]);

        $user = User::find($request->user_id);
        return redirect()->back()->with('success', "Fichier envoyé avec succès à {$user->name}!");
    }

    /**
     * Show files sent to users
     */
    public function sentFiles()
    {
        $sentFiles = AdminUserFile::with(['user', 'admin'])
            ->where('admin_id', Auth::id())
            ->latest()
            ->paginate(15);

        return view('admin.sent-files', compact('sentFiles'));
    }

    /**
     * Toggle download permission for a sent file
     */
    public function toggleDownloadPermission(AdminUserFile $adminUserFile)
    {
        // Check if current admin is the one who sent the file
        if ($adminUserFile->admin_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $adminUserFile->update([
            'download_permission' => !$adminUserFile->download_permission
        ]);

        $status = $adminUserFile->download_permission ? 'autorisé' : 'restreint';
        $user = $adminUserFile->user;

        return redirect()->back()->with('success', "Téléchargement {$status} pour {$user->name}!");
    }

    /**
     * Delete a sent file
     */
    public function deleteSentFile(AdminUserFile $adminUserFile)
    {
        // Check if current admin is the one who sent the file
        if ($adminUserFile->admin_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the physical file
        if (Storage::disk('public')->exists($adminUserFile->file_path)) {
            Storage::disk('public')->delete($adminUserFile->file_path);
        }

        // Delete the database record
        $adminUserFile->delete();

        return redirect()->back()->with('success', 'Fichier supprimé avec succès!');
    }

    // ====================================
    // CLIENT MANAGEMENT METHODS
    // ====================================

    /**
     * Show clients with services à la carte requests
     */
    public function clientsServices()
    {
        $clients = User::where('role', 'user')
            ->where(function($query) {
                $query->whereNotNull('devis_services')
                      ->orWhereNotNull('devis_nb_individus')
                      ->orWhereNotNull('devis_nb_variables')
                      ->orWhereNotNull('devis_delais')
                      ->orWhereNotNull('devis_remarques');
            })
            ->latest()
            ->paginate(10);

        return view('admin.clients-services', compact('clients'));
    }

    /**
     * Show detailed user information (alternative to show method for new UI)
     */
    public function userDetail(User $user)
    {
        $user->load('files');
        return view('admin.user-detail', compact('user'));
    }

    /**
     * Mark user's devis request as processed
     */
    public function markAsProcessed(User $user)
    {
        $user->update(['devis_status' => 'traite']);
        
        return response()->json(['success' => true]);
    }

    // ====================================
    // DEVIS MANAGEMENT METHODS
    // ====================================

    /**
     * Show form to create devis for a specific user
     */
    public function createDevis(User $user)
    {
        return view('admin.devis-create', compact('user'));
    }

    /**
     * Store a new devis
     */
    public function storeDevis(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:services_carte,pack_landing,personnalise',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix_base' => 'required|numeric|min:0',
            'ajustement_complexite' => 'nullable|numeric',
            'remise_pourcentage' => 'nullable|numeric|min:0|max:100',
            'tva_pourcentage' => 'nullable|numeric|min:0',
            'sous_total' => 'required|numeric|min:0',
            'montant_tva' => 'required|numeric|min:0',
            'total_ttc' => 'required|numeric|min:0',
            'services_inclus' => 'nullable|string',
            'conditions' => 'nullable|string',
            'date_echeance' => 'nullable|date',
            'date_validite' => 'nullable|date',
            'validite_jours' => 'nullable|integer|min:1|max:365',
        ]);

        // Calculate validity date based on validite_jours or use provided date_validite
        $validiteJours = (int) ($request->validite_jours ?? 30);
        
        // Ensure we have a valid integer for addDays
        if (!is_int($validiteJours) || $validiteJours < 1) {
            $validiteJours = 30;
        }
        
        $dateValidite = $request->date_validite ? 
            \Carbon\Carbon::parse($request->date_validite) : 
            now()->addDays($validiteJours);

        $devis = Devis::create([
            'user_id' => $request->user_id,
            'admin_id' => Auth::id(),
            'numero' => Devis::generateNumeroDevis(),
            'type' => $request->type,
            'titre' => $request->titre,
            'description' => $request->description,
            'prix_base' => $request->prix_base,
            'ajustement_complexite' => $request->ajustement_complexite ?? 0,
            'remise_pourcentage' => $request->remise_pourcentage ?? 0,
            'tva_pourcentage' => $request->tva_pourcentage ?? 0,
            'sous_total' => $request->sous_total,
            'montant_tva' => $request->montant_tva,
            'total_ttc' => $request->total_ttc,
            'services_inclus' => $request->services_inclus,
            'conditions' => $request->conditions,
            'date_validite' => $dateValidite,
            'date_echeance' => $request->date_echeance,
            'validite_jours' => $validiteJours,
            'statut' => 'brouillon',
            'created_by' => Auth::id(),
        ]);

        // Update user's devis status
        $user = User::find($request->user_id);
        $user->update(['devis_status' => 'en_attente']);

        return redirect()->route('admin.devis.show', $devis)
            ->with('success', 'Devis créé avec succès!');
    }

    /**
     * Show all devis
     */
    public function devisList()
    {
        $devis = Devis::with('user')->latest()->paginate(15);
        
        return view('admin.devis-list', compact('devis'));
    }

    /**
     * Show a specific devis
     */
    public function showDevis(Devis $devis)
    {
        $devis->load('user');
        
        return view('admin.devis-show', compact('devis'));
    }

    /**
     * Update devis status or details
     */
    public function updateDevis(Request $request, Devis $devis)
    {
        $request->validate([
            'titre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'prix_base' => 'nullable|numeric|min:0',
            'ajustement_complexite' => 'nullable|numeric',
            'remise_pourcentage' => 'nullable|numeric|min:0|max:100',
            'tva_pourcentage' => 'nullable|numeric|min:0',
            'sous_total' => 'nullable|numeric|min:0',
            'montant_tva' => 'nullable|numeric|min:0',
            'total_ttc' => 'nullable|numeric|min:0',
            'services_inclus' => 'nullable|string',
            'conditions' => 'nullable|string',
            'date_echeance' => 'nullable|date',
            'date_validite' => 'nullable|date',
            'validite_jours' => 'nullable|integer|min:1|max:365',
            'statut' => 'nullable|in:brouillon,envoye,accepte,refuse,expire',
            'notes_admin' => 'nullable|string',
        ]);

        // Handle date_validite calculation if not provided
        if (!$request->date_validite && $request->validite_jours) {
            $validiteJours = (int) ($request->validite_jours ?? 30);
            if (!is_int($validiteJours) || $validiteJours < 1) {
                $validiteJours = 30;
            }
            $request->merge(['date_validite' => now()->addDays($validiteJours)]);
        }

        $devis->update($request->except(['_token', '_method', 'user_id']));

        return redirect()->route('admin.devis.show', $devis)->with('success', 'Devis mis à jour avec succès!');
    }

    /**
     * Send devis to client
     */
    public function sendDevis(Devis $devis)
    {
        // Update status to sent and set date_envoi
        $devis->update([
            'statut' => 'envoye',
            'date_envoi' => now(),
        ]);

        // Here you could add email notification logic
        // Mail::to($devis->user->email)->send(new DevisMailNotification($devis));

        return redirect()->back()->with('success', 'Devis envoyé avec succès!');
    }

    /**
     * Show form to edit devis
     */
    public function editDevis(Devis $devis)
    {
        $user = $devis->user;
        return view('admin.devis-edit', compact('devis', 'user'));
    }

    /**
     * Delete devis
     */
    public function deleteDevis(Devis $devis)
    {
        // Check if devis can be deleted (not sent or accepted)
        if (in_array($devis->statut, ['envoye', 'accepte'])) {
            return redirect()->back()->with('error', 'Impossible de supprimer un devis envoyé ou accepté.');
        }

        $devis->delete();

        return redirect()->route('admin.devis.index')->with('success', 'Devis supprimé avec succès!');
    }

    /**
     * Preview devis in HTML format
     */
    public function previewDevis(Devis $devis)
    {
        $devis->load('user', 'admin');
        $isPdfGeneration = false;
        
        return view('admin.devis-pdf', compact('devis', 'isPdfGeneration'));
    }

    /**
     * Download devis as PDF
     */
    public function downloadDevisPDF(Devis $devis)
    {
        $devis->load('user', 'admin');
        
        // Generate PDF using DomPDF with PDF generation flag
        $isPdfGeneration = true;
        $pdf = Pdf::loadView('admin.devis-pdf', compact('devis', 'isPdfGeneration'));
        
        // Set PDF options
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'sans-serif',
            'isRemoteEnabled' => false,
            'isPhpEnabled' => false,
            'isHtml5ParserEnabled' => true,
            'isFontSubsettingEnabled' => true,
        ]);
        
        // Download the PDF
        return $pdf->download('devis-' . $devis->numero . '.pdf');
    }

    // ====================================
    // FACTURATION METHODS
    // ====================================

    /**
     * Show all factures
     */
    public function facturesList()
    {
        $factures = Facture::with('devis.user')->latest()->paginate(15);
        
        return view('admin.factures-list', compact('factures'));
    }

    /**
     * Create facture from devis
     */
    public function createFacture(Devis $devis)
    {
        // Check if devis is accepted
        if ($devis->statut !== 'accepte') {
            return redirect()->back()->with('error', 'Le devis doit être accepté pour créer une facture.');
        }

        // Check if facture already exists for this devis
        if ($devis->factures->count() > 0) {
            return redirect()->route('admin.factures.show', $devis->factures->first())
                ->with('info', 'Une facture existe déjà pour ce devis.');
        }

        $facture = Facture::create([
            'user_id' => $devis->user_id,
            'admin_id' => Auth::id(),
            'devis_id' => $devis->id,
            'numero' => Facture::generateNumeroFacture(),
            'titre' => 'Facture pour ' . $devis->titre,
            'description' => $devis->description,
            'services' => $devis->services ?? [], // Services du devis
            'prix_base' => $devis->prix_base,
            'ajustement_complexite' => $devis->ajustement_complexite,
            'remise_pourcentage' => $devis->remise_pourcentage,
            'tva_pourcentage' => $devis->tva_pourcentage,
            'sous_total' => $devis->sous_total,
            'montant_tva' => $devis->montant_tva,
            'total_ttc' => $devis->total_ttc,
            'services_inclus' => $devis->services_inclus,
            'conditions_paiement' => 'Paiement à 30 jours à réception de facture.',
            'statut' => 'envoyee',
            'date_echeance' => now()->addDays(30),
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.factures.show', $facture)
            ->with('success', 'Facture créée avec succès!');
    }

    /**
     * Show a specific facture
     */
    public function showFacture(Facture $facture)
    {
        $facture->load('devis.user');
        
        return view('admin.factures-show', compact('facture'));
    }

    /**
     * Show form to edit facture
     */
    public function editFacture(Facture $facture)
    {
        $facture->load('devis.user');
        return view('admin.factures-edit', compact('facture'));
    }

    /**
     * Update facture
     */
    public function updateFacture(Request $request, Facture $facture)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix_base' => 'required|numeric|min:0',
            'ajustement_complexite' => 'nullable|numeric',
            'remise_pourcentage' => 'nullable|numeric|min:0|max:100',
            'tva_pourcentage' => 'required|numeric|min:0',
            'services_inclus' => 'nullable|string',
            'conditions_paiement' => 'nullable|string',
            'date_echeance' => 'nullable|date',
            'statut' => 'required|in:brouillon,envoyee,payee,annulee,en_retard',
        ]);

        // Recalculate pricing if base values changed
        $prixBase = $request->prix_base;
        $ajustementComplexite = $request->ajustement_complexite ?? 0;
        $remisePourcentage = $request->remise_pourcentage ?? 0;
        $tvaPourcentage = $request->tva_pourcentage ?? 19;

        $sousTotal = ($prixBase + $ajustementComplexite) * (1 - $remisePourcentage / 100);
        $montantTva = $sousTotal * ($tvaPourcentage / 100);
        $totalTtc = $sousTotal + $montantTva;

        $facture->update(array_merge($request->except(['_token', '_method']), [
            'sous_total' => $sousTotal,
            'montant_tva' => $montantTva,
            'total_ttc' => $totalTtc,
        ]));

        return redirect()->route('admin.factures.show', $facture)
            ->with('success', 'Facture mise à jour avec succès!');
    }

    /**
     * Send facture to client
     */
    public function sendFacture(Facture $facture)
    {
        $facture->update([
            'statut' => 'envoyee',
            'date_envoi' => now(),
        ]);

        // Here you could add email notification logic
        // Mail::to($facture->user->email)->send(new FactureMailNotification($facture));

        return redirect()->back()->with('success', 'Facture envoyée avec succès!');
    }

    /**
     * Mark facture as paid
     */
    public function markFacturePaid(Request $request, Facture $facture)
    {
        $facture->update([
            'statut' => 'payee',
            'date_paiement' => now(),
            'methode_paiement' => $request->methode_paiement ?? 'non_specifie',
            'reference_paiement' => $request->reference_paiement,
        ]);

        return redirect()->back()->with('success', 'Facture marquée comme payée!');
    }

    /**
     * Download facture as PDF
     */
    public function downloadFacturePDF(Facture $facture)
    {
        $facture->load('devis.user', 'admin');
        
        // Generate PDF using DomPDF
        $isPdfGeneration = true;
        $pdf = Pdf::loadView('admin.factures-pdf', compact('facture', 'isPdfGeneration'));
        
        // Set PDF options
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'sans-serif',
            'isRemoteEnabled' => false,
            'isPhpEnabled' => false,
            'isHtml5ParserEnabled' => true,
            'isFontSubsettingEnabled' => true,
        ]);
        
        return $pdf->download('facture-' . $facture->numero . '.pdf');
    }

    /**
     * Send reminder for unpaid facture
     */
    public function sendFactureReminder(Facture $facture)
    {
        if ($facture->statut === 'payee') {
            return redirect()->back()->with('error', 'Cette facture est déjà payée.');
        }

        // Here you could add email reminder logic
        // Mail::to($facture->user->email)->send(new FactureReminderMail($facture));

        return redirect()->back()->with('success', 'Rappel envoyé avec succès!');
    }

    /**
     * Store new facture
     */
    public function storeFacture(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix_base' => 'required|numeric|min:0',
            'ajustement_complexite' => 'nullable|numeric',
            'remise_pourcentage' => 'nullable|numeric|min:0|max:100',
            'tva_pourcentage' => 'required|numeric|min:0',
            'services_inclus' => 'nullable|string',
            'conditions_paiement' => 'nullable|string',
            'date_echeance' => 'nullable|date',
        ]);

        // Calculate pricing
        $prixBase = $request->prix_base;
        $ajustementComplexite = $request->ajustement_complexite ?? 0;
        $remisePourcentage = $request->remise_pourcentage ?? 0;
        $tvaPourcentage = $request->tva_pourcentage ?? 19;

        $sousTotal = ($prixBase + $ajustementComplexite) * (1 - $remisePourcentage / 100);
        $montantTva = $sousTotal * ($tvaPourcentage / 100);
        $totalTtc = $sousTotal + $montantTva;

        $facture = Facture::create(array_merge($request->except(['_token']), [
            'admin_id' => Auth::id(),
            'numero' => Facture::generateNumeroFacture(),
            'sous_total' => $sousTotal,
            'montant_tva' => $montantTva,
            'total_ttc' => $totalTtc,
            'statut' => 'brouillon',
            'created_by' => Auth::id(),
        ]));

        return redirect()->route('admin.factures.show', $facture)
            ->with('success', 'Facture créée avec succès!');
    }

    /**
     * Delete facture
     */
    public function deleteFacture(Facture $facture)
    {
        // Check if facture can be deleted (only if not paid)
        if ($facture->statut === 'payee') {
            return redirect()->back()->with('error', 'Impossible de supprimer une facture payée.');
        }

        $facture->delete();

        return redirect()->route('admin.factures.index')->with('success', 'Facture supprimée avec succès!');
    }
}
