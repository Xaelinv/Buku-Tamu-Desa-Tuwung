<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Halaman Login
    public function loginForm()
    {
        return view('admin.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ]))
        {
            $request->session()->regenerate();

            return redirect('/admin/dashboard');
        }

        return back()->with('error','Email atau Password salah.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}