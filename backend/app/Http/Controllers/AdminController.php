<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Company;
use App\Models\Staff;
use App\Models\Reward;

class AdminController extends Controller
{

    public function adminDashboard()
    {
         $totalUsers = User::count();
         $totalStaffs = Staff::count();
         $totalRewards = Reward::count();
         $totalCompanies = Company::count();
        $totalPoints = User::sum('points');
    return view('admin.admin-dashboard', compact('totalUsers', 'totalPoints', 'totalCompanies','totalStaffs','totalRewards'));
    }
    
    public function adminSettings()
    {
        $admin = Auth::guard('admin')->user();
    return view('admin.setting', compact('admin'));
    }

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
        $users = User::with('company')->get(); // eager load company if there's a relation
        return view('admin.manage-users', compact('users'));
    }
    public function updateUser(Request $request, $user_id)
{
    $request->validate([
        'user_name' => 'required|string|max:255',
        'user_email' => 'required|email|max:255',
        'company_id' => 'required|exists:companies,company_id',
    ]);

    $user = User::where('user_id', $user_id)->firstOrFail(); // ✅ use user_id

    $user->user_name = $request->user_name;
    $user->user_email = $request->user_email;
    $user->company_id = $request->company_id;
    $user->save();

    return redirect()->route('admin.users')->with('success', 'User updated successfully!');

}
    public function editUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $companies = Company::all();
        return view('admin.edit-user', compact('user','companies'));
    }

    public function deleteUser($user_id)
    {
        $user = User::where('user_id', $user_id)->firstOrFail();
        $user->delete();

     return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function createUser()
{
    $companies = Company::all();
    return view('admin.create-user', compact('companies'));
}

public function storeUser(Request $request)
    {
        $request->validate([
        'user_name' => 'required|string|max:255',
        'user_email' => 'required|email|unique:users,user_email',
        'password' => 'required|confirmed|min:6',
        'company_id' => 'required|exists:companies,company_id',
    ]);

    try {
        $user = new User();
        $user->user_name = $request->user_name;
        $user->user_email = $request->user_email;
        $user->user_password = bcrypt($request->password);
        $user->company_id = $request->company_id;
        $user->points = 0;

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to create user: ' . $e->getMessage());
    }

    // return redirect()->route('admin.users')->with('success', 'User created successfully.');
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
    public function transactionHistory()
    {
        $data = [
            'title' => 'Transaction History',
            'active' => 'transaction-history',
        ];

        // Note the underscore (_) here
        return view('admin.transaction_history', compact('data'));
    }

}
