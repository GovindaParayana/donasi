<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UpdateAdminPasswordSeeder extends Seeder
{
    public function run()
    {
        // Buat admin baru tanpa pengecekan
        Admin::create([
            'name' => 'Admin3', // Ganti dengan nama admin yang diinginkan
            'email' => 'admin3@example.com', // Ganti dengan email yang diinginkan
            'password_hash' => Hash::make('password_admin'), // Ganti dengan password yang diinginkan
            'role' => 'admin', // Setel role admin
            'created_at' => now(),
            'update_at' => now(),
        ]);

        echo "Admin baru berhasil dibuat.\n";
    }
}