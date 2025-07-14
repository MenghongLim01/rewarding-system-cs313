<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // public function login(Request $request)
    // {
    //     // Validate custom admin_email and password field
    //     $request->validate([
    //         'admin_email' => 'required|email',
    //         'admin_pw' => 'required|string',
    //     ]);

    //     // Credentials must match custom fields in DB
    //     $credentials = [
    //         'admin_email' => $request->input('admin_email'),
    //         'admin_pw' => $request->input('admin_pw'), // still 'password' because Laravel uses it internally
    //     ];

    //     // Attempt login using admin guard
    //     if (Auth::guard('admin')->attempt($credentials)) {
    //         return redirect()->route('admin.dashboard');
    //     }

    //     return redirect()->route('admin.login')->withErrors([
    //         'admin_email' => 'Invalid email or password.',
    //     ]);
    // }
// public function login(Request $request)
// {
//     $request->validate([
//         'admin_email' => 'required|email',
//         'admin_pw' => 'required|string',
//     ]);

//     $admin = Admin::where('admin_email', $request->admin_email)->first();

//     if ($admin && Hash::check($request->admin_pw, $admin->admin_pw)) {
//     Auth::guard('admin')->login($admin);
//     return redirect()->route('admin.dashboard');
// }


//     return redirect()->route('admin.login')->withErrors([
//         'admin_email' => 'Invalid email or password.',
//     ]);
// }

    public function login(Request $request)
{
    $request->validate([
        'admin_email' => 'required|email',
        'admin_pw' => 'required|string',
    ]);

    $credentials = [
        'admin_email' => $request->admin_email,
        'password' => $request->admin_pw, // 👈 Laravel expects this key
    ];

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

  public function showProfile()
{
    $admin = Auth::guard('admin')->user();
    return view('admin.profile', compact('admin'));
}

public function updateProfile(Request $request)
{
    $admin = Auth::guard('admin')->user();

    $request->validate([
        'admin_name' => 'required|string|max:255',
        'admin_email' => 'required|email|unique:admins,admin_email,' . $admin->admin_id . ',admin_id',
        'admin_pw' => 'nullable|min:6|confirmed',
        'admin_profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $admin->admin_name = $request->admin_name;
    $admin->admin_email = $request->admin_email;

    if ($request->filled('admin_pw')) {
        $admin->admin_pw = Hash::make($request->admin_pw);
    }

    if ($request->hasFile('admin_profile_image')) {
        $filename = time() . '.' . $request->admin_profile_image->extension();
        $request->admin_profile_image->move(public_path('images'), $filename);
        $admin->admin_profile_image = $filename;
    }

    $admin->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}

}
