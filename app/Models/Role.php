<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Get all users with this role
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Check if role is admin
     */
    public function isAdmin(): bool
    {
        return $this->name === 'admin';
    }

    /**
     * Check if role is user
     */
    public function isUser(): bool
    {
        return $this->name === 'user';
    }

    /**
     * Get admin role
     */
    public static function getAdminRole(): ?Role
    {
        return self::where('name', 'admin')->first();
    }

    /**
     * Get user role
     */
    public static function getUserRole(): ?Role
    {
        return self::where('name', 'user')->first();
    }
}
