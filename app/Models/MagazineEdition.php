<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MagazineEdition extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id', 'title', 'issue_number', 'cover_image',
        'description', 'published_date', 'is_active',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'published_date' => 'date',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
