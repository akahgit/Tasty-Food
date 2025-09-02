<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'caption',
        'order',
        'is_featured',
        'uploaded_by',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    // Relasi gambar diupload oleh user
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}