<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Company;
class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::with('company')->get(); // Eager load the company relationship
        return view('admin.manage-staffs', compact('staff'));
    }

    // Show form to create new staff
    public function create()
    {
        $companies = Company::all(); // Get all companies
        return view('admin.create-staff', compact('companies'));
    }

    // Store new staff
    public function store(Request $request)
{
     $request->validate([
        'staff_name' => 'required|string|max:255',
        'staff_email' => 'required|email|unique:staff,staff_email',
        'password' => 'required|string|min:6|confirmed',
        'company_id' => 'nullable|exists:companies,company_id', // Ensure company_id exists or is nullable
    ]);

    try {
        $staff = new Staff();
        $staff->staff_name = $request->staff_name;
        $staff->staff_email = $request->staff_email;
        $staff->staff_pw = bcrypt($request->password); // Store in 'staff_pw' column
        $staff->company_id = $request->company_id; // Store the company_id
        $staff->save(); // Save the staff record

        return redirect()->route('admin.staff.index')->with('success', 'Staff created successfully!');
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to create staff: ' . $e->getMessage());
    }
}

    // Show form to edit a staff
    public function edit($staff_id)
    {
        $staff = Staff::findOrFail($staff_id);
        $companies = Company::all(); // Get all companies for the dropdown
        return view('admin.edit-staff', compact('staff', 'companies'));
    }

    // Update staff
    public function update(Request $request, $staff_id)
    {
        $request->validate([
            'staff_name' => 'required|string|max:255',
            'staff_email' => 'required|email|unique:staff,staff_email,' . $staff_id . ',staff_id',
            'staff_pw' => 'nullable|string|min:6',
            'company_id' => 'nullable|exists:companies,company_id',
        ]);

        $staff = Staff::findOrFail($staff_id);
        $staff->update([
            'staff_name' => $request->staff_name,
            'staff_email' => $request->staff_email,
            'staff_pw' => $request->staff_pw ? bcrypt($request->staff_pw) : $staff->staff_pw, // Only update if password is provided
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff updated successfully!');
    }

    // Delete staff
    public function destroy($staff_id)
    {
        $staff = Staff::findOrFail($staff_id);
        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Staff deleted successfully!');
    }
    public function showLoginForm()
    {
        return view('staff.auth.login'); // This points to your login form (staff login)
    }
    public function login(Request $request)
{
    // Validate the form input
    $request->validate([
        'staff_email' => 'required|email',
        'staff_pw' => 'required|string|min:6', // This should match the field name from the form (staff_pw)
    ]);

    // Attempt to authenticate the staff user using 'staff_pw' for the password
    if (Auth::guard('staff')->attempt([
        'staff_email' => $request->staff_email,
        'password' => $request->staff_pw, // This should match 'staff_pw'
    ], $request->remember)) {
        // Redirect to staff dashboard or home page after successful login
        return redirect()->route('staff.process-customer-orders');
    }

    // If login fails, redirect back with error message
    return back()->withErrors(['staff_email' => 'These credentials do not match our records.']);
}
    public function logout(Request $request)
    {
    // Log the staff out
        Auth::guard('staff')->logout();

    // Invalidate the session to prevent session fixation attacks
        $request->session()->invalidate();

    // Regenerate the session to avoid session hijacking
        $request->session()->regenerateToken();

    // Redirect back to the login page or any other page you prefer
        return redirect()->route('staff.login.form'); // Adjust to your login route
    }


    public function processCustomerOrders()
    {
        return view('staff.process-customer-orders');
    }

    public function viewTransactionHistory()
    {
        return view('staff.transaction');
    }
}
    


