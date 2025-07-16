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

    // Update profile
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,user_email,' . Auth::guard('user')->user()->user_id . ',user_id',
            'password' => 'nullable|string|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $user = Auth::guard('user')->user();
            $user->user_name = $validated['user_name'];
            $user->user_email = $validated['user_email'];

            if ($request->hasFile('profile_image')) {
                if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
                    Storage::delete('public/' . $user->profile_image);
                }
                $imagePath = $request->file('profile_image')->store('profile_images', 'public');
                $user->profile_image = $imagePath;
            }

            if ($request->filled('password')) {
                $user->user_password = Hash::make($validated['password']);
            }

            $user->save();

            return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['update_error' => 'Something went wrong. Please try again.']);
        }
    }






    // view
    public function index()
    {
        return view('user.index'); // Create this Blade view
    }
     public function dashboard()
    {
        $user = Auth::user();  // Get the currently logged-in user
        // $company = $user->company;  // Assuming the user has a relationship with the company
        // $points = $user->points;  // Assuming points is a column in the users table
        return view('user.dashboard'); // Create this Blade view
    }

    public function history()
    {
        return view('user.history');
    }
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

        public function redeem()
    {
        return view('user.redeem');
    }

    public function profile()
    {
        $user = Auth::guard('user')->user(); // ✅ explicitly use 'user' guard

        if (!$user) {
            return redirect()->route('login'); // fallback
        }

        $user->load('company'); // ✅ now it's safe to call
        return view('user.profile', compact('user'));
    }

}
