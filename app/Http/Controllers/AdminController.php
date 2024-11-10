<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna login sebagai admin
        if (!Auth::guard('admin')->check()) {
            return redirect('/login')->withErrors('Anda harus login sebagai admin untuk mengakses halaman ini.');
        }

        

        // Tampilkan dashboard admin
        return view('admin', ['role' => 'admin']);
    }
}