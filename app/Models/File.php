<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'original_name',
        'file_name',
        'file_path',
        'mime_type',
        'file_extension',
        'file_size',
        'status',
        'description',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'file_size' => 'integer',
    ];

    /**
     * Get the user that owns the file
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get formatted file size
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get file type icon
     */
    public function getIconAttribute(): string
    {
        return match ($this->file_extension) {
            'pdf' => '📄',
            'xlsx', 'xls' => '📊',
            'docx', 'doc' => '📝',
            'csv' => '📋',
            'spss' => '🔢',
            default => '📁'
        };
    }

    /**
     * Get file icon (alias for consistency with views)
     */
    public function getFileIconAttribute(): string
    {
        return $this->getIconAttribute();
    }

    /**
     * Check if file is an image
     */
    public function isImage(): bool
    {
        return in_array($this->file_extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']);
    }

    /**
     * Get the list of supported file extensions
     */
    public static function getSupportedExtensions(): array
    {
        return ['pdf', 'xlsx', 'xls', 'docx', 'doc', 'csv', 'spss'];
    }

    public static function getIconMap(): array
    {
        return [
            'pdf' => '📄',
            'xlsx' => '📊',
            'xls' => '📊',
            'docx' => '📝',
            'doc' => '📝',
            'csv' => '📋',
            'spss' => '🔢',
        ];
    }
}
