<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Company;
use App\Models\User;
use App\Models\Reward;
class RewardController extends Controller
{
    public function manageReward(Request $request)
    {
        // Get the logged-in user's company ID
        // $company_id = auth()->user()->company_id;
        // $rewards = Reward::with('company') 
        //              ->where('company_id', $company_id)
        //              ->get();
        $rewards = Reward::with('company')->get(); 
        return view('admin.manage-reward', compact('rewards'));
    }
    public function create()
    {
        $companies = Company::all();  // Get all companies for the dropdown
        return view('admin.create-reward', compact('companies'));
    }
    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'reward_name' => 'required|string|max:255',
            'reward_desc' => 'required|string',
            'reward_stock' => 'required|integer',
            'reward_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'point_required' => 'required|integer',
            'company_id' => 'required|exists:companies,company_id', // Ensure the company exists
        ]);

        // Handle the image upload (if any)
        $imagePath = null;
        if ($request->hasFile('reward_image')) {
            $imagePath = $request->file('reward_image')->store('reward_images', 'public');  // Store the image in the 'public/reward_images' folder
        }

        // Create a new reward record
        Reward::create([
            'reward_name' => $request->reward_name,
            'reward_desc' => $request->reward_desc,
            'reward_stock' => $request->reward_stock,
            'reward_image' => $imagePath,  // Store the image path if it exists
            'point_required' => $request->point_required,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('admin.reward.index')->with('success', 'Reward created successfully!');
    }
    public function show($reward_id)
    {
        $reward = Reward::with('company')->findOrFail($reward_id);
        return view('admin.show-reward', compact('reward'));
    }
    public function edit($reward_id)
    {
        $reward = Reward::findOrFail($reward_id);
        $companies = Company::all();  // For the company dropdown
        return view('admin.edit-reward', compact('reward', 'companies'));
    }
    public function update(Request $request, $reward_id)
    {       
        $request->validate([
            'reward_name' => 'required|string|max:255',
            'reward_desc' => 'required|string',
            'reward_stock' => 'required|integer',
            'reward_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'point_required' => 'required|integer',
            'company_id' => 'required|exists:companies,company_id',
        ]);

        $reward = Reward::findOrFail($reward_id);

    // Handle the image upload (if any)
        $imagePath = $reward->reward_image; // Retain the old image if no new image is uploaded
        if ($request->hasFile('reward_image')) {
        // Delete the old image if it exists
            if ($imagePath && file_exists(storage_path('app/public/' . $imagePath))) {
                unlink(storage_path('app/public/' . $imagePath)); 
        }

        // Store the new image
        $imagePath = $request->file('reward_image')->store('reward_images', 'public');
        }

    // Update the reward record
        $reward->update([
            'reward_name' => $request->reward_name,
            'reward_desc' => $request->reward_desc,
            'reward_stock' => $request->reward_stock,
            'reward_image' => $imagePath,
            'point_required' => $request->point_required,
            'company_id' => $request->company_id,
        ]);

    return redirect()->route('admin.reward.index')->with('success', 'Reward updated successfully!');
    }

    public function destroy($reward_id)
    {
        $reward = Reward::findOrFail($reward_id);

        // Delete the image if it exists
        if ($reward->reward_image && file_exists(storage_path('app/public/' . $reward->reward_image))) {
            unlink(storage_path('app/public/' . $reward->reward_image));
        }

        $reward->delete();  // Delete the reward from the database

        return redirect()->route('admin.reward.index')->with('success', 'Reward deleted successfully!');
    }

}
