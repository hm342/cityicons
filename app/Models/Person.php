<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'type',
        'tagline', 'bio', 'profession', 'organization',
        'cover_image', 'portrait_image', 'gallery_images',
        'city_id', 'category_id',
        'year', 'month', 'edition_number',
        'social_instagram', 'social_linkedin', 'website',
        'is_featured', 'status', 'sort_order',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_featured'    => 'boolean',
    ];

    // ── Relationships ──────────────────────────────────────

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'person_tag');
    }

    public function nomination(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Nomination::class, 'converted_to_person_id');
    }

    // ── Scopes ─────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeIcons(Builder $query): Builder
    {
        return $query->where('type', 'icon');
    }

    public function scopeRising(Builder $query): Builder
    {
        return $query->where('type', 'rising');
    }

    public function scopeForTheList(Builder $query, int $year, int $month): Builder
    {
        return $query->where('year', $year)->where('month', $month);
    }
}
