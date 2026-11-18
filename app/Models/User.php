<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ── Role Helpers ──────────────────────────────────────

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isEditor(): bool
    {
        return in_array($this->role, ['super_admin', 'editor']);
    }

    public function isContributor(): bool
    {
        return in_array($this->role, ['super_admin', 'editor', 'contributor']);
    }

    public function canAccessAdmin(): bool
    {
        return in_array($this->role, ['super_admin', 'editor', 'contributor']);
    }
}
