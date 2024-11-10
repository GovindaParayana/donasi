<?php

// app/Models/Admin.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin';  // Nama tabel

    protected $fillable = [
        'name', 'email', 'password_hash', 'role', 'created_at', 'updated_at',
    ];

    protected $hidden = [
        'password_hash', 'remember_token',
    ];

    // Pastikan ini menunjuk ke kolom `password_hash`
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}