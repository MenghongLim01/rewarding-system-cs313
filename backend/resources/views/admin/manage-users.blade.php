@extends('admin.layouts.layout')

@section('title', 'Manage Users')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-users.css') }}">

<style>
    .btn-add-staff {
        background-color: #614cafff;
        color: white;
        padding: 10px 16px;
        font-size: 14px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-bottom: 10px;
    }

    .btn-add-staff:hover {
        background-color: #45a049;
    }

    .btn-edit, .btn-delete {
        padding: 6px 12px;
        font-size: 14px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 5px;
    }

    .btn-edit {
        background-color: #4f46e5;
        color: white;
    }

    .btn-edit:hover {
        background-color: #4338ca;
    }

    .btn-delete {
        background-color: #dc2626;
        color: white;
    }

    .btn-delete:hover {
        background-color: #b91c1c;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .header h1 {
        font-size: 24px;
        font-weight: 600;
    }

    .back-link {
        font-size: 14px;
        color: #4f46e5;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }
</style>

<div class="users-container">
    <!-- Header -->
    <div class="header">
        <h1>Users Management 👥</h1>
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Back to Dashboard</a>
    </div>

    <button class="btn-add-staff" onclick="window.location.href='{{ route('admin.users.create') }}'">Add New User</button>

    <!-- Users Table -->
    <div class="table-wrapper mt-4">
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
                    <td class="text-right">
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
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
