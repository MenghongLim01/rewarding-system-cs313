@extends('admin.layouts.layout')

@section('title', 'Manage Users')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-users.css') }}">

<style>
/* Button style reused from Staff */
.btn-add-user {
    background-color: #614cafff;
    color: white;
    padding: 10px 16px;
    font-size: 14px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-bottom: 10px;
}
.btn-add-user:hover {
    background-color: #45a049;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
    justify-content: center;
    align-items: center;
}
.modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
}
.modal-input {
    width: 100%;
    padding: 8px;
    margin-bottom: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.btn-cancel, .btn-confirm {
    padding: 8px 14px;
    border: none;
    border-radius: 4px;
}
.btn-cancel {
    background-color: #ccc;
}
.btn-confirm {
    background-color: #4CAF50;
    color: white;
}
.btn-edit,
.btn-delete {
    padding: 6px 14px;
    font-size: 13px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}

.btn-edit {
    background-color: #6b46c1;
    color: white;
}
</style>

<div class="users-container">
    <!-- Header -->
    <div class="header">
        <h1>Manage Users 👥</h1>
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Back to Dashboard</a>
    </div>

    <!-- Add User Button -->
    <button class="btn-add-user" onclick="openModal('addUserModal')">Add User</button>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
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
