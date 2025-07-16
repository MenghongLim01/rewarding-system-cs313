@extends('user.layouts.layout')

@section('title', 'User Profile')

@section('content')
<h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Your Profile 👤</h1>

<div class="w-[80%] mx-auto">
    <section class="mb-10">
        <div class="bg-gradient-to-r from-purple-600 to-indigo-700 text-white p-6 rounded-lg shadow-md mb-8 flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center mb-4 md:mb-0">
                <img 
                    src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://placehold.co/80x80/8B5CF6/FFFFFF?text=JD' }}" 
                    alt="User Profile"
                    class="w-20 h-20 object-cover rounded-full border-2 border-white mr-4"
                />
                <div>
                    <p class="text-2xl font-semibold">{{ $user->user_name }}</p>
                    <p class="text-sm opacity-90">{{ $user->user_email }}</p>
                </div>
            </div>
            <div class="text-right">
                <span class="text-3xl font-bold">Points: {{ $user->points ?? 0 }}</span>
                <p class="text-sm opacity-90 mt-1">Current points balance</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">Personal Details</h2>
            <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="profile_image" class="block text-sm font-medium text-gray-700 mb-1">Upload Profile Image</label>
                    <input type="file" id="profile_image" name="profile_image" class="block w-full border border-gray-300 rounded-md px-4 py-2">
                </div>

                <div class="mb-4">
                    <label for="user_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="user_name" name="user_name" value="{{ old('user_name', $user->user_name) }}" class="block w-full border border-gray-300 rounded-md px-4 py-2">
                </div>

                <div class="mb-4">
                    <label for="user_email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="user_email" name="user_email" value="{{ old('user_email', $user->user_email) }}" class="block w-full border border-gray-300 rounded-md px-4 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Company</label>
                    <input type="text" value="{{ $user->company->company_name ?? 'N/A' }}" class="block w-full bg-gray-100 border border-gray-300 rounded-md px-4 py-2 cursor-not-allowed" readonly>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" id="password" name="password" class="block w-full border border-gray-300 rounded-md px-4 py-2">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="block w-full border border-gray-300 rounded-md px-4 py-2">
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-3 rounded-md shadow-md transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </section>

    <div class="text-center mt-6">
        <a href="{{ route('dashboard') }}" class="text-purple-600 hover:text-purple-500 font-medium">← Back to Dashboard</a>
    </div>
</div>
@endsection
