@extends('staff.layouts.layout')

@section('title', 'Staff Profile')

@section('content')
<h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Staff Profile 👤</h1>

<div class="w-[80%] mx-auto">
    <section class="mb-10">
        <div class="bg-gradient-to-r from-purple-600 to-indigo-700 text-white p-6 rounded-lg shadow-md mb-8 flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center mb-4 md:mb-0">
                <!-- Profile Image -->
                <img 
                    src="{{ Auth::guard('staff')->user()->profile_image 
                        ? asset('storage/' . Auth::guard('staff')->user()->profile_image) 
                        : 'https://placehold.co/80x80/8B5CF6/FFFFFF?text=ST' }}" 
                    alt="Staff Profile"
                    class="rounded-full border-2 border-white mr-4 w-20 h-20 object-cover"
                >
                <div>
                    <p class="text-2xl font-semibold">{{ Auth::guard('staff')->user()->staff_name }}</p>
                    <p class="text-sm opacity-90">{{ Auth::guard('staff')->user()->staff_email }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">Update Profile</h2>
            <form method="POST" action="{{ route('staff.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Display Profile Image Preview -->
<!-- <div class="flex items-center justify-center mb-6">
    <img 
        src="{{ Auth::guard('staff')->user()->profile_image ? asset('storage/' . Auth::guard('staff')->user()->profile_image) : 'https://placehold.co/100x100/8B5CF6/FFFFFF?text=S' }}"
        alt="Staff Profile Image"
        class="w-24 h-24 rounded-full object-cover border-2 border-gray-300"
    />
</div> -->

<!-- Upload Profile Image -->
<div>
    <label for="profile_image" class="block text-sm font-medium text-gray-700 mb-1">Upload Profile Image</label>
    <input type="file" id="profile_image" name="profile_image" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
</div>

<!-- Name -->
<div class="mt-4">
    <label for="staff_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
    <input type="text" id="staff_name" name="staff_name" value="{{ old('staff_name', Auth::guard('staff')->user()->staff_name) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
</div>

<!-- Email -->
<div class="mt-4">
    <label for="staff_email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
    <input type="email" id="staff_email" name="staff_email" value="{{ old('staff_email', Auth::guard('staff')->user()->staff_email) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
</div>

<!-- Company (Readonly) -->
<div class="mt-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Company</label>
    <input type="text" value="{{ Auth::guard('staff')->user()->company->company_name ?? 'N/A' }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100" readonly>
</div>

<!-- Save Button -->
<div class="flex justify-end mt-6">
    <button type="submit" class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold shadow-md">Save Changes</button>
</div>

            </form>
        </div>
    </section>
</div>
@endsection
