<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function login_attempt(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);
        if (!Auth::attempt($attr)) {
            return redirect()->back()->with('error', 'Credentials not match!');
        }
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return redirect()->route('login');
    }
}
