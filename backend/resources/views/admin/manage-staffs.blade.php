@extends('admin.layouts.layout')

@section('title', 'Staffs Management')

@section('content')

<div class="users-container">
    <div class="header">
        <h1>Staffs Management👥</h1>
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Back to Dashboard</a>
    </div>

    <button class="btn-add-staff" onclick="window.location.href='{{ route('admin.staff.create') }}'">Add New Staff</button>

    <div class="table-wrapper mt-4">
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <!-- <tbody>
                @foreach($staff as $member)
                    <tr>
                        <td>{{ $member->staff_id }}</td>
                        <td>{{ $member->staff_name }}</td>
                        <td>{{ $member->staff_email }}</td>
                        <td>{{ $member->company->company_name ?? 'N/A' }}</td>
                        <td class="text-right d-flex">
                        <a href="{{ route('admin.staff.edit', $member->staff_id) }}" class="btn btn-sm btn-primary me-2">Edit</a>
                        <form id="delete-form-{{ $member->staff_id }}" 
                        action="{{ route('admin.staff.destroy', $member->staff_id) }}" 
                        method="POST" 
                        lass="d-inline">
                            @csrf
                            @method('DELETE')
                                <a href="#" 
                                    onclick="if(confirm('Are you sure you want to delete this staff?')) document.getElementById('delete-form-{{ $member->staff_id }}').submit();"
                                    class="btn btn-sm btn-danger">
                                    Delete
                                </a>
                            </form>

                    </td>
                    </tr>
                @endforeach
            </tbody> -->
            <tbody>
    @foreach($staff as $member)
        <tr>
            <td>{{ $member->staff_id }}</td>
            <td>{{ $member->staff_name }}</td>
            <td>{{ $member->staff_email }}</td>
            <td>{{ $member->company->company_name ?? 'N/A' }}</td>
            <td class="text-right d-flex">
                <!-- Edit Button -->
                <a href="{{ route('admin.staff.edit', $member->staff_id) }}" class="btn btn-sm btn-primary me-2">Edit</a>

                <!-- Delete Button -->
                <form id="delete-form-{{ $member->staff_id }}" action="{{ route('admin.staff.destroy', $member->staff_id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <a href="#" 
                        onclick="if(confirm('Are you sure you want to delete this staff?')) document.getElementById('delete-form-{{ $member->staff_id }}').submit();"
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
