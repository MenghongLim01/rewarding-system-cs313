@extends('admin.layouts.layout')

@section('title', 'Admin Settings')

@section('content')
<div class="min-vh-100 d-flex justify-content-center align-items-start py-5 bg-light">
    <div class="bg-white shadow rounded p-4 w-100" style="max-width: 500px; min-height: 460px;">
        <h2 class="h4 fw-bold text-center mb-4">Update Admin Profile</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.profile.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Profile Image -->
            <div class="d-flex flex-column align-items-center mb-4">
                <img src="{{ asset('images/' . Auth::guard('admin')->user()->admin_profile_image) }}" 
                     alt="Avatar"
                     class="rounded-circle border border-3 border-secondary shadow-sm mb-2"
                     style="width: 96px; height: 96px; object-fit: cover;">
                
                <label for="avatar" class="form-label text-muted">Change Avatar</label>
                <input type="file" name="avatar" id="avatar" accept="image/*" class="form-control form-control-sm">
            </div>

            <!-- Admin Name -->
            <div class="mb-3">
                <label for="admin_name" class="form-label">Admin Name</label>
                <input type="text" name="admin_name" id="admin_name"
                       value="{{ old('admin_name', Auth::guard('admin')->user()->admin_name) }}"
                       class="form-control">
            </div>

            <!-- Submit -->
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary fw-semibold" style="background-color:#6b46c1">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
