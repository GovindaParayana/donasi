<?php
// app/Http/Controllers/Auth/LoginController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Login sebagai admin
        if (Auth::guard('admin')->attempt($credentials)) {
            session(['role' => 'admin']); // Tambahkan tanda role admin di session
            return redirect()->intended('/admin');
        }
    
        // Login sebagai user biasa
        if (Auth::guard('web')->attempt($credentials)) {
            session(['role' => 'user']); // Tambahkan tanda role user di session
            return redirect()->intended('/');
        }
    
        // Jika login gagal
        return back()->withErrors([
            'email' => 'Kredensial yang Anda berikan tidak cocok dengan data kami.',
        ]);
    }
    
    public function logout(Request $request)
    {
        // Logout dari kedua guard 'web' dan 'admin'
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();

        // Hapus semua data session, termasuk role
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama dengan pesan status "Anda belum login"
        return redirect('/')->with('status', 'Anda belum login');
    }
}