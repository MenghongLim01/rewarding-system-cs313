@extends('admin.layouts.layout')

@section('title', 'Admin Profile')
<script src="https://cdn.tailwindcss.com"></script>

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Update Profile</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block font-medium">Name</label>
            <input type="text" name="admin_name" value="{{ old('admin_name', $admin->admin_name) }}" class="w-full p-2 border rounded">
            @error('admin_name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="admin_email" value="{{ old('admin_email', $admin->admin_email) }}" class="w-full p-2 border rounded">
            @error('admin_email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">New Password (optional)</label>
            <input type="password" name="admin_pw" class="w-full p-2 border rounded">
            <input type="password" name="admin_pw_confirmation" placeholder="Confirm password" class="w-full mt-2 p-2 border rounded">
            @error('admin_pw') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Profile Image</label>
            <input type="file" name="admin_profile_image" class="w-full">
            @if ($admin->admin_profile_image)
                <img src="{{ asset('uploads/admins/' . $admin->admin_profile_image) }}" alt="Profile" class="w-20 h-20 mt-2 rounded-full">
            @endif
            @error('admin_profile_image') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Profile</button>
    </form>
</div>
@endsection