<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'about';

    protected $fillable = [
        'description',
        'vision',
        'mission',
        'image_1',
        'image_2',
        'updated_by'
    ];

    protected $casts = [
        'updated_at' => 'datetime:d M Y',
    ];

    // Relasi ke user
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
