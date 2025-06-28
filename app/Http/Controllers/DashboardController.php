<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use App\Models\AdminUserFile;

class DashboardController extends Controller
{
    /**
     * Show the user dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // If admin, redirect to admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        return $this->showUserDashboard($user, false);
    }

    /**
     * Show user dashboard view for admins (preview mode)
     */
    public function userView()
    {
        $user = Auth::user();
        return $this->showUserDashboard($user, true);
    }

    /**
     * Private method to generate dashboard data
     */
    private function showUserDashboard($user, $isAdminPreview = false)
    {
        // User statistics
        $totalFiles = $user->files()->count();
        $totalSize = $user->files()->sum('file_size');
        $recentFiles = $user->files()->whereDate('created_at', '>=', now()->subDays(7))->count();
        $latestFiles = $user->files()->latest()->limit(5)->get();
        
        // File types breakdown
        $fileTypes = $user->files()
            ->selectRaw('file_extension, COUNT(*) as count')
            ->groupBy('file_extension')
            ->orderBy('count', 'desc')
            ->get();
        
        // Received files from admin
        $receivedFiles = AdminUserFile::where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();
        
        $unreadReceivedFiles = AdminUserFile::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();
        
        return view('dashboard', compact(
            'totalFiles',
            'totalSize', 
            'recentFiles',
            'latestFiles',
            'fileTypes',
            'receivedFiles',
            'unreadReceivedFiles',
            'isAdminPreview'
        ));
    }
} 