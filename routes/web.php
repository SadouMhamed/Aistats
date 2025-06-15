<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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
});

// File Management Routes
Route::middleware('auth')->prefix('files')->group(function () {
    Route::get('/', [FileController::class, 'index'])->name('files.index');
    Route::get('/create', [FileController::class, 'create'])->name('files.create');
    Route::post('/', [FileController::class, 'store'])->name('files.store');
    Route::get('/{file}', [FileController::class, 'show'])->name('files.show');
    Route::get('/{file}/edit', [FileController::class, 'edit'])->name('files.edit');
    Route::patch('/{file}', [FileController::class, 'update'])->name('files.update');
    Route::delete('/{file}', [FileController::class, 'destroy'])->name('files.destroy');
    Route::get('/{file}/download', [FileController::class, 'download'])->name('files.download');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
