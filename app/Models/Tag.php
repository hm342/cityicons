<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['city_id', 'name', 'slug'];

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

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }
}
