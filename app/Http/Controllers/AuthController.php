<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Models\Utilisateur;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     return view('auth.login');
    // }
    public function register(Request $request){
        return view('auth.register');
    }
    // Show Registration Form
    public function handleLogin(AuthRequest $request)
    {
        $credentials = $request->only('Email', 'Password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error_msg', 'email or password incorrect');
        }
    }

    // Handle Logout
    public function logout(Request $request) {}
}
