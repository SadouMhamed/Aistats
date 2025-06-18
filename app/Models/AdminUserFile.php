<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUserFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'user_id',
        'original_name',
        'file_path',
        'file_type',
        'file_size',
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFileSizeFormattedAttribute()
    {
        return number_format($this->file_size / 1024, 2) . ' KB';
    }
}
