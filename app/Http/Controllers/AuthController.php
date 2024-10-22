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

        $validatedData = $request->validate([
            'username' => 'Required',
            'password' => 'Required',
        ]);

        $cekLogin = Auth::attempt($validatedData);

        if ($cekLogin != 1) {

            return back()->with(['error' => 'Username Atau Password Salah!']);
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
