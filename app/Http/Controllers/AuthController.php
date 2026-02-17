<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Check if user is active
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account has been deactivated. Please contact an administrator.',
                ])->onlyInput('email');
            }
            
            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                // Cashiers go directly to POS
                return redirect()->intended('/pos');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }

    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            \Log::error('Google OAuth Redirect Error: ' . $e->getMessage());
            return redirect('/login')->withErrors([
                'email' => 'Unable to connect to Google. Please try again or use email/password login.',
            ]);
        }
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if ($user) {
                // Update existing user with Google info
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            } else {
                // Create new customer user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'role' => 'customer',
                    'is_active' => true,
                ]);
            }

            Auth::login($user, true);
            
            // Check if user is active
            if (!$user->is_active) {
                Auth::logout();
                return redirect('/login')->withErrors([
                    'email' => 'Your account has been deactivated. Please contact an administrator.',
                ]);
            }
            
            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } else if ($user->role === 'cashier') {
                return redirect('/pos');
            }
            
            // Default for other roles (like customer)
            return redirect('/pos');

        } catch (Exception $e) {
            // Log the error for debugging
            \Log::error('Google OAuth Callback Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect('/login')->withErrors([
                'email' => 'Unable to login with Google. Please try email/password login instead.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
