<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Trait الصلاحيات من الباكدج
use Solutions\AccessControl\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];


    public function roles()
    {
        return $this->belongsToMany(
            \Solutions\AccessControl\Models\Role::class,
            'user_role',      // غيّر الاسم لو Pivot مختلف
            'user_id',
            'role_id'
        )->withTimestamps();
    }


    public function role()
    {
        return $this->belongsTo(
            \Solutions\AccessControl\Models\Role::class,
            'role_id'
        );
    }


    public function permissions()
    {
        return $this->roles()
            ->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->unique('id')
            ->values();
    }


    public function canKey(string $key): bool
    {
        if ($this->roles()->exists()) {
            return $this->roles()
                ->whereHas('permissions', fn($q) => $q->where('key', $key))
                ->exists();
        }

        if ($this->role()->exists()) {
            return $this->role()
                ->whereHas('permissions', fn($q) => $q->where('key', $key))
                ->exists();
        }

        return false;
    }
}
