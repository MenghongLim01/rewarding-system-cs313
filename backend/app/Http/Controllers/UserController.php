<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
     public function showLoginForm()
    {
        return view('user.auth.login'); // Create this Blade view
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_email' => ['required', 'email'],
            'password' => ['required'],
        ]);

    // Custom field mapping for Auth
        if (Auth::guard('user')->attempt(['user_email' => $credentials['user_email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // Adjust your redirect target
        }

        return back()->withErrors([
            'user_email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }



    public function showRegisterForm()
    {
        $companies = Company::all();
        return view('user.auth.register', compact('companies'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,user_email',
            'password' => 'required|string|min:6|confirmed', // Laravel will look for "password_confirmation"
            'company_id' => 'required|exists:companies,company_id',
        ]);

        try {
            User::create([
                'user_name' => $validated['user_name'],
                'user_email' => $validated['user_email'],
                'user_password' => Hash::make($validated['password']), // ✅ custom column
                'company_id' => $validated['company_id'],
            ]);

            return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
            'registration_error' => 'Something went wrong. Please try again.',
            ]);
        }
    }
    public function index()
    {
        return view('user.index'); // Create this Blade view
    }
     public function dashboard()
    {
        return view('user.dashboard'); // Create this Blade view
    }
}
