<?php

// app/Http/Middleware/EnsureAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah login dengan guard 'admin'
        if (Auth::guard('admin')->check()) {
            Log::info('User logged in as admin');  // Log jika pengguna adalah admin
            return $next($request);
        }

        // Log jika pengguna mencoba mengakses tanpa izin
        Log::warning('Non-admin user attempted to access admin page', [
            'user_id' => Auth::id(),
            'guard' => Auth::getDefaultDriver()
        ]);

        // Redirect jika bukan admin
        return redirect('/login')->withErrors('Anda harus login sebagai admin untuk mengakses halaman ini.');
    }
}