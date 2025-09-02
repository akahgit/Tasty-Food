<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'image',
        'is_published',
        'created_by'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function author() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
