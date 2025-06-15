<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * Display a listing of user's files
     */
    public function index()
    {
        $files = Auth::user()->files()->latest()->paginate(10);
        $supportedExtensions = File::getSupportedExtensions();
        
        return view('files.index', compact('files', 'supportedExtensions'));
    }

    /**
     * Show the form for creating a new file upload
     */
    public function create()
    {
        $supportedExtensions = File::getSupportedExtensions();
        return view('files.create', compact('supportedExtensions'));
    }

    /**
     * Store a newly uploaded file
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'max:10240', // 10MB max
                'mimes:pdf,xlsx,xls,docx,doc,csv,sps'
            ],
            'description' => 'nullable|string|max:500'
        ]);

        $uploadedFile = $request->file('file');
        $originalName = $uploadedFile->getClientOriginalName();
        $extension = $uploadedFile->getClientOriginalExtension();
        $fileName = Str::uuid() . '.' . $extension;
        
        // Store the file
        $filePath = $uploadedFile->storeAs('uploads/' . Auth::id(), $fileName, 'public');
        
        // Create file record
        $file = File::create([
            'user_id' => Auth::id(),
            'original_name' => $originalName,
            'file_name' => $fileName,
            'file_path' => $filePath,
            'mime_type' => $uploadedFile->getMimeType(),
            'file_extension' => strtolower($extension),
            'file_size' => $uploadedFile->getSize(),
            'description' => $request->description,
            'status' => 'uploaded'
        ]);

        return redirect()->route('files.index')
            ->with('success', 'Fichier téléchargé avec succès!');
    }

    /**
     * Download the specified file
     */
    public function download(File $file)
    {
        // Check if user owns the file or is admin
        if ($file->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        if (!Storage::disk('public')->exists($file->file_path)) {
            return redirect()->back()->with('error', 'Fichier non trouvé');
        }

        return Storage::disk('public')->download($file->file_path, $file->original_name);
    }

    /**
     * Display the specified file details
     */
    public function show(File $file)
    {
        // Check if user owns the file or is admin
        if ($file->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        return view('files.show', compact('file'));
    }

    /**
     * Show the form for editing the file
     */
    public function edit(File $file)
    {
        // Check if user owns the file
        if ($file->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        return view('files.edit', compact('file'));
    }

    /**
     * Update the specified file
     */
    public function update(Request $request, File $file)
    {
        // Check if user owns the file
        if ($file->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        $request->validate([
            'description' => 'nullable|string|max:500'
        ]);

        $file->update([
            'description' => $request->description
        ]);

        return redirect()->route('files.show', $file)
            ->with('success', 'Description mise à jour avec succès!');
    }

    /**
     * Remove the specified file
     */
    public function destroy(File $file)
    {
        // Check if user owns the file or is admin
        if ($file->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        // Delete the physical file
        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }

        // Delete the database record
        $file->delete();

        return redirect()->route('files.index')
            ->with('success', 'Fichier supprimé avec succès!');
    }
}
