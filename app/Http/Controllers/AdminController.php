<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\File;
use App\Models\AdminUserFile;
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
}
