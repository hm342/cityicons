<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'color',
        'sort_order',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function nominations(): HasMany
    {
        return $this->hasMany(Nomination::class, 'nominee_category_id');
    }
}
