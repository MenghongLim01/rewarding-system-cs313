<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{

    public function adminDashboard()
    {
        $admin = Auth::guard('admin')->user(); // 🧠 This MUST return the logged-in admin

    if (!$admin) {
        // Session isn't persisting the login
        return redirect()->route('admin.login')->withErrors(['admin_email' => 'Session lost']);
    }

    return view('admin.admin-dashboard', compact('admin'));
    }
    
    public function adminSettings()
    {
        $admin = Auth::guard('admin')->user();
    return view('admin.setting', compact('admin'));
    }

// public function uploadProfileImage(Request $request)
// {
//     $request->validate([
//         'admin_name' => 'required|string|max:255',
//         'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//     ]);

//     $admin = Auth::guard('admin')->user();
//     $admin->admin_name = $request->admin_name;
//     // Delete old image (optional)
//     $oldImage = public_path('images/' . $admin->admin_profile_image);
//     if ($admin->admin_profile_image !== 'avatar1.jpg' && File::exists($oldImage)) {
//         File::delete($oldImage);
//     }

//     // Save new image
//     $filename = time() . '.' . $request->avatar->extension();
//     $request->avatar->move(public_path('images'), $filename);

//     // Update DB
//     $admin->admin_profile_image = $filename;
//     $admin->save();

//     return redirect()->back()->with('success', 'Profile image updated.');
// }
    public function uploadProfileImage(Request $request)
{
    $request->validate([
        'admin_name' => 'required|string|max:255',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 👈 make avatar optional
    ]);

    $admin = Auth::guard('admin')->user();

    // ✅ Update admin name
    $admin->admin_name = $request->admin_name;

    // ✅ Update image only if uploaded
    if ($request->hasFile('avatar')) {
        $oldImage = public_path('images/' . $admin->admin_profile_image);

        if ($admin->admin_profile_image !== 'avatar1.jpg' && File::exists($oldImage)) {
            File::delete($oldImage);
        }

        $filename = time() . '.' . $request->avatar->extension();
        $request->avatar->move(public_path('images'), $filename);
        $admin->admin_profile_image = $filename;
    }

    $admin->save(); // ✅ Save both name and (maybe) image

    return redirect()->back()->with('success', 'Profile updated successfully.');
}
    public function manageUser()
    {
        $data = [
            'title' => 'Manage User',
            'active' => 'manage-user',
        ];

        return view('admin.manage-users', compact('data'));
    }

    public function managerReward()
    {
        $data = [
            'title' => 'Manage Reward',
            'active' => 'manage-reward',
        ];

        return view('admin.manage-reward', compact('data'));
    }

    public function adminUserLog()
    {
        $data = [
            'title' => 'Admin User Log',
            'active' => 'admin-user-log',
        ];

        return view('admin.admin-user-logs', compact('data'));
    }

    public function apiDocumentation()
    {
        $data = [
            'title' => 'API Documentation',
            'active' => 'api-documentation',
        ];

        return view('admin.api-docs', compact('data'));
    }
    public function manageStaffs()
    {
        $data = [
            'title' => 'Manage Staffs',
            'active' => 'manage-staffs',
        ];

        return view('admin.manage-staffs', compact('data'));
    }
    public function processCustomerOrders()
    {
        $data = [
            'title' => 'Process Customer Orders',
            'active' => 'process-customer-orders',
        ];

        return view('admin.process-customer-orders', compact('data'));
    }

}
