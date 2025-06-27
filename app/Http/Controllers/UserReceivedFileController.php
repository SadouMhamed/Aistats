<?php

namespace App\Http\Controllers;

use App\Models\AdminUserFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserReceivedFileController extends Controller
{
    /**
     * Display files received from admin
     */
    public function index()
    {
        $receivedFiles = AdminUserFile::with('admin')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(15);

        return view('user.received-files', compact('receivedFiles'));
    }

    /**
     * Show a specific received file
     */
    public function show(AdminUserFile $adminUserFile)
    {
        // Check if the file belongs to the current user
        if ($adminUserFile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        // Check if download permission is granted
        if (!$adminUserFile->download_permission) {
            return redirect()->back()->with('error', 'Vous n\'avez pas encore la permission de voir ce fichier. Contactez l\'administrateur.');
        }

        // Mark as read
        if (!$adminUserFile->is_read) {
            $adminUserFile->update(['is_read' => true]);
        }

        return view('user.received-file-detail', compact('adminUserFile'));
    }

    /**
     * Download a received file
     */
    public function download(AdminUserFile $adminUserFile)
    {
        // Check if the file belongs to the current user
        if ($adminUserFile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        // Check if download permission is granted
        if (!$adminUserFile->download_permission) {
            return redirect()->back()->with('error', 'Vous n\'avez pas encore la permission de télécharger ce fichier. Contactez l\'administrateur.');
        }

        // Check if file exists
        if (!Storage::disk('public')->exists($adminUserFile->file_path)) {
            return redirect()->back()->with('error', 'Fichier non trouvé.');
        }

        // Mark as read if not already
        if (!$adminUserFile->is_read) {
            $adminUserFile->update(['is_read' => true]);
        }

        return Storage::disk('public')->download($adminUserFile->file_path, $adminUserFile->original_name);
    }
}
