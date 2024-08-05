<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->role === 'admin' || auth()->user()->role === 'librarian') {
                return redirect()->intended('/admin')->with('success', 'Login berhasil!');
            }
            return redirect()->intended('/')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['login_error' => 'Username dan password salah, harap masukkan kembali!']);
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
