<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // Validate custom admin_email and password field
        $request->validate([
            'admin_email' => 'required|email',
            'admin_pw' => 'required|string',
        ]);

        // Credentials must match custom fields in DB
        $credentials = [
            'admin_email' => $request->input('admin_email'),
            'admin_pw' => $request->input('admin_pw'), // still 'password' because Laravel uses it internally
        ];

        // Attempt login using admin guard
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->withErrors([
            'admin_email' => 'Invalid email or password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
