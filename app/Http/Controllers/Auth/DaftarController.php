<?php
// app/Http/Controllers/Auth/DaftarController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DaftarController extends Controller
{
public function daftarForm()
{
return view('auth.daftar');
}

public function register(Request $request)
{
$request->validate([
'name' => 'required|string|max:255',
'email' => 'required|string|email|max:255|unique:users',
'password' => 'required|string|min:8|confirmed',
'phone' => 'required|string|max:15',
]);

User::create([
'name' => $request->name,
'email' => $request->email,
'phone' => $request->phone,
'password' => Hash::make($request->password),
'role' => 'user',
]);

return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
}
}