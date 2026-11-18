<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'body',
        'author_name', 'author_bio', 'author_avatar',
        'category_id', 'city_id',
        'cover_image', 'gallery_images',
        'type', 'section', 'status',
        'is_cover', 'is_featured',
        'read_time', 'meta_title', 'meta_description',
        'published_at',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_cover'       => 'boolean',
        'is_featured'    => 'boolean',
        'published_at'   => 'datetime',
    ];

    // ── Relationships ──────────────────────────────────────

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // ── Scopes ─────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
                     ->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeCover(Builder $query): Builder
    {
        return $query->where('is_cover', true);
    }

    public function scopeForCity(Builder $query, string $slug): Builder
    {
        return $query->whereHas('city', fn ($q) => $q->where('slug', $slug));
    }

    public function scopeForSection(Builder $query, string $section): Builder
    {
        return $query->where('section', $section);
    }
}
