<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => 'Kolom email wajib diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Kolom password wajib diisi',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }
        return back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.index')->with('success','Anda berhasil logout');
    }
}
