<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Nomination extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominee_name', 'nominee_city', 'nominee_profession',
        'nominee_category_id', 'nominee_description',
        'nominee_social_instagram', 'nominee_social_linkedin', 'nominee_website',
        'nominee_image_path',
        'nominator_name', 'nominator_email', 'nominator_phone',
        'relationship_to_nominee',
        'status', 'admin_notes', 'converted_to_person_id',
        'consent_accuracy', 'consent_sharing', 'consent_editorial',
        'consent_no_payment', 'consent_terms',
        'submitted_at',
    ];

    protected $casts = [
        'consent_accuracy'   => 'boolean',
        'consent_sharing'    => 'boolean',
        'consent_editorial'  => 'boolean',
        'consent_no_payment' => 'boolean',
        'consent_terms'      => 'boolean',
        'submitted_at'       => 'datetime',
    ];

    // ── Relationships ──────────────────────────────────────

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'nominee_category_id');
    }

    public function convertedPerson(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'converted_to_person_id');
    }

    // ── Scopes ─────────────────────────────────────────────

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }
}
