<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Company;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use App\Models\Redemption;
use App\Models\Reward;

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


    public function CustomerOrdersForm()
    {
        $company_id = Auth::guard('staff')->user()->company_id;
        $users = User::where('company_id', $company_id)->get();
        $company = Company::find($company_id); 
        return view('staff.process-customer-orders', compact('users','company'));
    }

   public function processCustomerOrders(Request $request)
    {
        // Validate the form data
        $request->validate([
            'user_id' => 'required|exists:users,user_id',  // Ensure the selected user exists
            'order_items' => 'required|string',  // Accept order_items as a string (JSON)
            'total' => 'required|numeric',  // Ensure total amount is provided
            'points_awarded' => 'required|integer',  // Ensure points are provided
        ]);

        // Decode the order_items JSON string into an array
        $order_items = json_decode($request->order_items, true);

        // Get the company_id and staff_id of the currently authenticated staff using the 'staff' guard
        $company_id = Auth::guard('staff')->user()->company_id;  // Get the company_id from the authenticated staff
        $staff_id = Auth::guard('staff')->id();  // Get the staff_id from the authenticated staff

        // Create the order for the selected user
        $order = Order::create([
            'user_id' => $request->user_id,
            'company_id' => $company_id,
            'order_items' => $order_items,  // Store order items as an array
            'total' => $request->total,
            'points_awarded' => $request->points_awarded,
            'staff_id' => $staff_id,  // Add the staff member who processed the order
        ]);

        // Update the user's points (adding the awarded points)
        $user = User::find($request->user_id);
        $user->points += $request->points_awarded;
        $user->save();  // Save the updated points
        
        // Return back to the staff dashboard with a success message
        return redirect()->route('staff.process-customer-orders')->with('success', 'Order processed and points awarded!');
    }
    //     public function orderHistory()
    // {
    //     $company_id = Auth::guard('staff')->user()->company_id; // Get the company ID from the authenticated staff
    //     $orders = Order::where('company_id', $company_id)->with(['user', 'staff'])->get(); // Get orders for the staff's company

    //     return view('staff.order-history', compact('orders'));
    // }
    public function orderHistory()
    {
        // Get the company_id for the currently authenticated staff
        $company_id = Auth::guard('staff')->user()->company_id;

        // Fetch orders, eager load user and staff relationships
        $orders = Order::where('company_id', $company_id)
                        ->with(['user', 'staff']) // eager load relationships
                        ->get(); 

        // Pass the orders to the view
        return view('staff.order-history', compact('orders'));
    }



    // public function addPoints(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'user_id' => 'required|exists:users,user_id',
    //         'points' => 'required|integer|min:1',
    //     ]);

    //     // Find the user and add points
    //     $user = User::find($request->user_id);
    //     $user->points += $request->points;
    //     $user->save();

    //     // Return success message and redirect
    //     return redirect()->route('staff.customer-order')->with('success', 'Points added successfully!');
    // }


    //profile update
    public function updateProfile(Request $request)
    {
        $staff = Auth::guard('staff')->user();

        $request->validate([
            'staff_name' => 'required|string|max:255',
            'staff_email' => 'required|email|unique:staff,staff_email,' . $staff->staff_id . ',staff_id',
            'staff_pw' => 'nullable|string|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($staff->profile_image && Storage::disk('public')->exists($staff->profile_image)) {
                Storage::disk('public')->delete($staff->profile_image);
            }
            $staff->profile_image = $request->file('profile_image')->store('staff_images', 'public');
        }

        $staff->staff_name = $request->staff_name;
        $staff->staff_email = $request->staff_email;

        if ($request->filled('staff_pw')) {
            $staff->staff_pw = bcrypt($request->staff_pw);
        }

        $staff->save();

        return redirect()->route('staff.profile')->with('success', 'Profile updated successfully.');
    }

    public function profile()
    {
        $staff = Auth::guard('staff')->user();

        if (!$staff) {
            return redirect()->route('staff.login'); // Ensure staff is logged in
        }

        // Eager load company if needed
        $staff->load('company');

        return view('staff.staff-profile', compact('staff'));
    }


   public function viewTransactionHistory()
    {
        $company_id = auth()->guard('staff')->user()->company_id;

        // Fetch both earnings and redemptions
        $earnings = \App\Models\Order::with('user', 'staff')
            ->where('company_id', $company_id)
            ->get()
            ->map(function ($order) {
                return [
                    'user_name'    => $order->user->user_name,
                    'type'         => 'earn',
                    'points'       => $order->points_awarded,
                    'processed_by' => $order->staff->staff_name ?? 'System',
                    'date'         => $order->created_at,
                ];
            });

        $redemptions = \App\Models\Redemption::with('user', 'reward')
            ->whereHas('user', fn($q) => $q->where('company_id', $company_id))
            ->get()
            ->map(function ($redeem) {
                return [
                    'user_name'    => $redeem->user->user_name,
                    'type'         => 'redeem',
                    'points'       => $redeem->status === 'rejected' ? 0 : -$redeem->point_spent,
                    'processed_by' => '—', // optional: show staff if you later add staff_id
                    'date'         => $redeem->created_at,
                ];
            });

        $transactions = $earnings->merge($redemptions)->sortByDesc('date')->values();

        return view('staff.transaction', compact('transactions')); // Make sure view name matches!
    }


    public function showRedemptions()
    {
        $staff = auth()->guard('staff')->user(); // get logged-in staff

        $redemptions = Redemption::where('status', 'pending')
            ->whereHas('user', function ($query) use ($staff) {
                $query->where('company_id', $staff->company_id); // filter by same company
            })
            ->with(['user', 'reward'])
            ->get();

        return view('staff.redemptions', compact('redemptions'));
    }

    public function approve($id)
    {
        $redemption = Redemption::findOrFail($id);
        if ($redemption->status !== 'pending') {
            return back()->with('error', 'This redemption has already been processed.');
        }
        $redemption->status = 'approved';
        $redemption->staff_id = auth()->guard('staff')->user()->staff_id;
        $redemption->save();

        // Decrement reward stock
        $reward = $redemption->reward;
        if ($reward && $reward->reward_stock > 0) {
            $reward->reward_stock -= 1;
            $reward->save();
        }

        return back()->with('success', 'Redemption approved and reward stock updated.');
    }

    public function reject($id)
    {
        $redemption = Redemption::findOrFail($id);
        $redemption->status = 'rejected';
        $redemption->staff_id = auth()->guard('staff')->user()->staff_id;
        $redemption->save();

        // Refund points to user
        $user = $redemption->user;
        if ($user) {
            $user->points += $redemption->point_spent;
            $user->save();
        }

        return back()->with('success', 'Redemption rejected and points refunded.');
    }

    public function rewardInventory()
    {
        $staff = Auth::guard('staff')->user(); 
        // $rewards = Reward::with('company')->get(); // or paginate if many
        $rewards = Reward::with('company')
            ->where('company_id', $staff->company_id)
            ->get();
        return view('staff.reward-inventory', compact('rewards'));
    }



}



