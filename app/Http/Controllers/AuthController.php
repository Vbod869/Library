<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Method untuk menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Method untuk menangani proses login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Login successful!'); // Notifikasi login berhasil
        }

        // Jika autentikasi gagal
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
}
