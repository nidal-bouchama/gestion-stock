<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('login');
    }

    public function register(Request $request): View|RedirectResponse
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required|string|max:150',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);

            try {
                // Special case for Nidal - make admin
                $role = 'user'; // Default role for new users
                if (strtolower($validated['name']) === 'user' || 
                    strtolower($validated['email']) === 'user@example.com') {
                    $role = 'admin';
                }
                
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => bcrypt($validated['password']),
                    'role' => $role,
                ]);

                Auth::login($user);
                
                // Redirect based on role
                if ($user->isAdmin()) {
                    return redirect()->route('dashboard')->with('success', 'Registration successful!');
                } else {
                    return redirect()->route('user.dashboard')->with('success', 'Registration successful!');
                }
            } catch (Exception $e) {
                return back()->withErrors(['error' => 'Registration failed: ' . $e->getMessage()])->withInput();
            }
        }
        return view('register');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Redirect based on user role
            $user = Auth::user();
            if ($user->role === 'super_admin' || $user->role === 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        return back()
            ->with('error', 'The email or password you entered is incorrect. Please try again.')
            ->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
