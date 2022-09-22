<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('/home')->with('success', 'Login Berhasil');
        }
        return redirect('/')->with('error', 'Email Atau Password Salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
