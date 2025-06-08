<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Get the role for this user
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        // Load relasi role jika belum di-load
        if (!$this->relationLoaded('role')) {
            $this->load('role');
        }

        return $this->role && $this->role->name === 'admin';
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        // Load relasi role jika belum di-load
        if (!$this->relationLoaded('role')) {
            $this->load('role');
        }

        return $this->role && $this->role->name === 'user';
    }

    /**
     * Check if user has specific role
     */
    public function hasRole(string $roleName): bool
    {
        return $this->role && $this->role->name === $roleName;
    }

    /**
     * Get role name
     */
    public function getRoleName(): string
    {
        return $this->role ? $this->role->name : 'user';
    }

    /**
     * Get role display name (capitalized)
     */
    public function getRoleDisplayName(): string
    {
        return $this->role ? ucfirst($this->role->name) : 'User';
    }

    /**
     * Scope to get only admin users
     */
    public function scopeAdmins($query)
    {
        return $query->whereHas('role', function ($q) {
            $q->where('name', 'admin');
        });
    }

    /**
     * Scope to get only regular users
     */
    public function scopeRegularUsers($query)
    {
        return $query->whereHas('role', function ($q) {
            $q->where('name', 'user');
        });
    }

    /**
     * Relasi dengan Prestasi
     */
    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }
}
