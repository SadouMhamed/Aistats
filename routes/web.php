<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserReceivedFileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{user}/update-role', [AdminController::class, 'updateRole'])->name('admin.users.update_role');
    Route::get('/files', [AdminController::class, 'files'])->name('admin.files');
    Route::get('/files/stats', [AdminController::class, 'fileStats'])->name('admin.files.stats');
    Route::delete('/files/{file}', [AdminController::class, 'deleteFile'])->name('admin.files.delete');
    Route::get('/users/{user}', [AdminController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{user}/pdf', [AdminController::class, 'downloadPDF'])->name('admin.users.pdf');
    Route::post('/users/{user}/update-payment-status', [AdminController::class, 'updatePaymentStatus'])->name('admin.users.update_payment_status');
    
    // Admin file sending routes
    Route::get('/send-file', [AdminController::class, 'showSendFileForm'])->name('admin.send_file');
    Route::post('/send-file', [AdminController::class, 'sendFileToUser'])->name('admin.send_file.store');
    Route::get('/sent-files', [AdminController::class, 'sentFiles'])->name('admin.sent_files');
    Route::delete('/sent-files/{adminUserFile}', [AdminController::class, 'deleteSentFile'])->name('admin.sent_files.delete');
    Route::post('/sent-files/{adminUserFile}/toggle-permission', [AdminController::class, 'toggleDownloadPermission'])->name('admin.sent_files.toggle_permission');
    
    // Client management routes
    Route::get('/clients-services', [AdminController::class, 'clientsServices'])->name('admin.clients.services');
    Route::get('/users/{user}/detail', [AdminController::class, 'userDetail'])->name('admin.user.detail');
    Route::post('/users/{user}/mark-processed', [AdminController::class, 'markAsProcessed'])->name('admin.users.mark_processed');
    
    // Devis management routes
    Route::get('/devis/create/{user}', [AdminController::class, 'createDevis'])->name('admin.devis.create');
    Route::post('/devis/store', [AdminController::class, 'storeDevis'])->name('admin.devis.store');
    Route::get('/devis', [AdminController::class, 'devisList'])->name('admin.devis.index');
    Route::get('/devis/{devis}', [AdminController::class, 'showDevis'])->name('admin.devis.show');
    Route::patch('/devis/{devis}', [AdminController::class, 'updateDevis'])->name('admin.devis.update');
    Route::post('/devis/{devis}/send', [AdminController::class, 'sendDevis'])->name('admin.devis.send');
    Route::get('/devis/{devis}/edit', [AdminController::class, 'editDevis'])->name('admin.devis.edit');
    Route::get('/devis/{devis}/preview', [AdminController::class, 'previewDevis'])->name('admin.devis.preview');
    Route::get('/devis/{devis}/pdf', [AdminController::class, 'downloadDevisPDF'])->name('admin.devis.pdf');
    Route::delete('/devis/{devis}', [AdminController::class, 'deleteDevis'])->name('admin.devis.delete');
    
    // Facturation routes
    Route::get('/factures', [AdminController::class, 'facturesList'])->name('admin.factures.index');
    Route::post('/factures/create/{devis}', [AdminController::class, 'createFacture'])->name('admin.factures.create');
    Route::get('/factures/{facture}', [AdminController::class, 'showFacture'])->name('admin.factures.show');
    Route::get('/factures/{facture}/edit', [AdminController::class, 'editFacture'])->name('admin.factures.edit');
    Route::patch('/factures/{facture}', [AdminController::class, 'updateFacture'])->name('admin.factures.update');
    Route::patch('/factures/{facture}/send', [AdminController::class, 'sendFacture'])->name('admin.factures.send');
    Route::patch('/factures/{facture}/mark-paid', [AdminController::class, 'markFacturePaid'])->name('admin.factures.mark-paid');
    Route::get('/factures/{facture}/pdf', [AdminController::class, 'downloadFacturePDF'])->name('admin.factures.pdf');
    Route::get('/factures/{facture}/send-reminder', [AdminController::class, 'sendFactureReminder'])->name('admin.factures.send-reminder');
    Route::post('/factures/store', [AdminController::class, 'storeFacture'])->name('admin.factures.store');
    Route::delete('/factures/{facture}', [AdminController::class, 'deleteFacture'])->name('admin.factures.delete');
});

// File Management Routes
Route::middleware('auth')->prefix('files')->group(function () {
    Route::get('/', [FileController::class, 'index'])->name('files.index');
    Route::get('/create', [FileController::class, 'create'])->name('files.create');
    Route::post('/', [FileController::class, 'store'])->name('files.store');
    Route::get('/pdf-report', [FileController::class, 'generatePDF'])->name('files.pdf');
    Route::get('/{file}', [FileController::class, 'show'])->name('files.show');
    Route::get('/{file}/edit', [FileController::class, 'edit'])->name('files.edit');
    Route::patch('/{file}', [FileController::class, 'update'])->name('files.update');
    Route::delete('/{file}', [FileController::class, 'destroy'])->name('files.destroy');
    Route::get('/{file}/download', [FileController::class, 'download'])->name('files.download');
});



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/user-dashboard', [DashboardController::class, 'userView'])
    ->middleware(['auth'])
    ->name('user.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Files management
    Route::get('/files', [FileController::class, 'index'])->name('files.index');
    Route::get('/files/create', [FileController::class, 'create'])->name('files.create');
    Route::post('/files', [FileController::class, 'store'])->name('files.store');
    Route::get('/files/{file}', [FileController::class, 'show'])->name('files.show');
    Route::get('/files/{file}/edit', [FileController::class, 'edit'])->name('files.edit');
    Route::patch('/files/{file}', [FileController::class, 'update'])->name('files.update');
    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');

    // User received files management
    Route::get('/received-files', [UserReceivedFileController::class, 'index'])->name('user.received_files.index');
    Route::get('/received-files/{adminUserFile}', [UserReceivedFileController::class, 'show'])->name('user.received_files.show');
    Route::get('/received-files/{adminUserFile}/download', [UserReceivedFileController::class, 'download'])->name('user.received_files.download');
    
    // Client espace - Devis et Factures
    Route::prefix('client')->name('client.')->group(function () {
        Route::get('/devis', [ClientController::class, 'devisIndex'])->name('devis.index');
        Route::get('/devis/{devis}', [ClientController::class, 'devisShow'])->name('devis.show');
        Route::post('/devis/{devis}/accept', [ClientController::class, 'acceptDevis'])->name('devis.accept');
        Route::post('/devis/{devis}/reject', [ClientController::class, 'rejectDevis'])->name('devis.reject');
        Route::get('/devis/{devis}/pdf', [ClientController::class, 'downloadDevisPDF'])->name('devis.pdf');
        
        Route::get('/factures', [ClientController::class, 'facturesIndex'])->name('factures.index');
        Route::get('/factures/{facture}', [ClientController::class, 'facturesShow'])->name('factures.show');
        Route::get('/factures/{facture}/pdf', [ClientController::class, 'downloadFacturePDF'])->name('factures.pdf');
    });
});

// Route pour le formulaire de contact
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

// Language routes
Route::get('/language/{locale}', [LanguageController::class, 'changeLanguage'])->name('language.change');

Route::get('/test-services-carte', function() {
    // Simuler des données de services à la carte
    $testData = [
        'name' => 'Test User',
        'nom' => 'TestNom',
        'prenom' => 'TestPrenom',
        'profession' => 'Test Profession',
        'telephone' => '0123456789',
        'email' => 'test-services@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'pack' => null,
        'meeting_preference' => 'en ligne',
        'payment_preference' => 'en ligne',
        'devis_services' => json_encode(['Service 1', 'Service 2']),
        'devis_nb_individus' => '100',
        'devis_nb_variables' => '5',
        'devis_delais' => '2 semaines',
        'devis_remarques' => 'Test remarques'
    ];
    
    // Vérifier si un utilisateur avec cet email existe déjà
    $existingUser = \App\Models\User::where('email', $testData['email'])->first();
    if ($existingUser) {
        $existingUser->delete();
    }
    
    return view('test-services-registration', compact('testData'));
})->name('test.services.carte');

require __DIR__.'/auth.php';
