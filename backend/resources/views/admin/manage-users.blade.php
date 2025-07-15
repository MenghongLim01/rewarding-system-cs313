
<!-- <link rel="stylesheet" href="{{ asset('css/manage-users.css') }}"> -->


<div class="users-container">
    <!-- Header -->
 @extends('admin.layouts.layout')

@section('title', 'Admin Users Management')
<script src="https://cdn.tailwindcss.com"></script>

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-users.css') }}">

<div class="users-container">
    <!-- Header -->
     <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-800">Users Management 👥</h1>
    </div>

  <div class="header mb-6 mt-4">
    <div class="flex items-center justify-between">
        <button 
            class="adduser bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out"
            onclick="window.location.href='{{ route('admin.users.create') }}'">
            + Add New User
        </button>
    </div>

    <div class="flex justify-end mt-4">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline text-sm">← Back to Dashboard</a>
    </div>
</div>

    <!-- Users Table -->
    <div class="table-wrapper">
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Points</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="users-list">
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->user_name }}</td>
                    <td>{{ $user->user_email }}</td>
                    <td>{{ $user->company->company_name ?? 'N/A' }}</td>
                    <td>{{ $user->points }}</td>
                    <td class="text-right d-flex">
                        <a href="{{ route('admin.users.edit', $user->user_id) }}" class="btn btn-sm btn-primary me-2">Edit</a>

                        <form id="delete-form-{{ $user->user_id }}" 
                        action="{{ route('admin.users.delete', $user->user_id) }}" 
                        method="POST" 
                        lass="d-inline">
                            @csrf
                            @method('DELETE')
                                <a href="#" 
                                    onclick="if(confirm('Are you sure you want to delete this user?')) document.getElementById('delete-form-{{ $user->user_id }}').submit();"
                                    class="btn btn-sm btn-danger">
                                    Delete
                                </a>
                            </form>

                    </td>
                    </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>

@endsection
