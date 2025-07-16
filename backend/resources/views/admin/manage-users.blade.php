@extends('admin.layouts.layout')

@section('title', 'Manage Users')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-users.css') }}">



<div class="users-container">
    <!-- Header -->
    <div class="header">
        <h1>Users Management 👥</h1>
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Back to Dashboard</a>
    </div>

    <button class="btn-add-staff" onclick="window.location.href='{{ route('admin.users.create') }}'">Add New User</button>

    <!-- Users Table -->
    <div class="table-wrapper mt-4">
         @if (session('success'))
        <div class="alert alert-success mb-4 text-green-700 bg-green-100 p-4 rounded">
        {{ session('success') }}
        </div>
        @endif
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
                    <!-- <td class="text-right">
                        <a href="{{ route('admin.users.edit', $user->user_id) }}" class="btn-edit">Edit</a>
                        <form id="delete-form-{{ $user->user_id }}" 
                              action="{{ route('admin.users.delete', $user->user_id) }}" 
                              method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete"
                                onclick="return confirm('Are you sure you want to delete this user?');">
                                Delete
                            </button>
                        </form>
                    </td> -->
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
