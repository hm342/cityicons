<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'name',
        'slug',
        'type',
        'color',
        'sort_order',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeForCity($query, $cityId)
    {
        return $query->where(function ($q) use ($cityId) {
            $q->whereNull('city_id');
            if ($cityId) {
                $q->orWhere('city_id', $cityId);
            }
        });
    }

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
