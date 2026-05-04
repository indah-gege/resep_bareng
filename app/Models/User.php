<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    // AKU TAMBAHKAN HasFactory DI SINI BIAR SEEDER JALAN
    use Notifiable, HasFactory;

    protected $fillable = ['name', 'email', 'password', 'role'];
    protected $hidden   = ['password', 'remember_token'];

    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'superadmin']);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }

    public function bookmarks()
    {
        return $this->belongsToMany(Resep::class, 'bookmarks');
    }
}