<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
}
