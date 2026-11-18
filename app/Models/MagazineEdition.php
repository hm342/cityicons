<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MagazineEdition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'issue_number', 'cover_image',
        'description', 'published_date', 'is_active',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'published_date' => 'date',
    ];
}
