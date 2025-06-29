<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserReceivedFileController;
use App\Http\Controllers\DashboardController;
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

// User received files routes
Route::middleware('auth')->prefix('received-files')->group(function () {
    Route::get('/', [UserReceivedFileController::class, 'index'])->name('received_files.index');
    Route::get('/{adminUserFile}', [UserReceivedFileController::class, 'show'])->name('received_files.show');
    Route::get('/{adminUserFile}/download', [UserReceivedFileController::class, 'download'])->name('received_files.download');
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
});

// Route pour le formulaire de contact
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

require __DIR__.'/auth.php';
