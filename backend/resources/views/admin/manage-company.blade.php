@extends('admin.layouts.layout')

@section('title', 'Admin Companies Management')
<!-- <script src="https://cdn.tailwindcss.com"></script> -->

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-users.css') }}">

<div class="users-container">
    <!-- Header -->
     <div class="header">
        <h1>Company Management👥</h1>
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Back to Dashboard</a>
    </div>

    <!-- <button class="btn-add-staff" onclick="window.location.href='{{ route('admin.staff.create') }}'">Add New Staff</button> -->
<button class="btn-add-staff" onclick="window.location.href='{{ route('admin.companies.create') }}'">Add New Company</button>
</div>


    <!-- Users Table -->
    <div class="table-wrapper">
         @if (session('success'))
        <div class="alert alert-success mb-4 text-green-700 bg-green-100 p-4 rounded">
        {{ session('success') }}
        </div>
        @endif
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="users-list">
                @foreach($companies as $company)
                <tr>
                    <td>{{ $company->company_id }}</td>
                    <td>{{ $company->company_name }}</td>
                    <td>{{ $company->company_type }}</td>
                    <td>{{ $company->company_desc }}</td>
                    <td class="text-right d-flex">
                        <a href="{{ route('admin.companies.edit', $company->company_id) }}" class="btn btn-sm btn-primary me-2">Edit</a>
                        <form id="delete-form-{{ $company->company_id }}" 
                        action="{{ route('admin.companies.destroy', $company->company_id) }}" 
                        method="POST" 
                        lass="d-inline">
                            @csrf
                            @method('DELETE')
                                <a href="#" 
                                    onclick="if(confirm('Are you sure you want to delete this company?')) document.getElementById('delete-form-{{ $company->company_id }}').submit();"
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

<!-- Modals -->
<div id="messageModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('messageModal')">&times;</span>
        <h2 id="message-modal-title">Info</h2>
        <p id="message-modal-message">This is a test message.</p>
        <button onclick="closeModal('messageModal')">Got It</button>
    </div>
</div>

<div id="adjustPointsModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('adjustPointsModal')">&times;</span>
        <h2 class="text-xl font-bold mb-4">Adjust Points</h2>
        <form id="adjust-points-form">
            <label>Name</label>
            <input type="text" readonly value="User Name" class="modal-input" />
            <label>Current Points</label>
            <input type="text" readonly value="1500" class="modal-input" />
            <label>Adjustment</label>
            <input type="number" required class="modal-input" />
            <div class="mt-4 flex justify-end">
                <button type="button" onclick="closeModal('adjustPointsModal')" class="btn-cancel">Cancel</button>
                <button type="submit" class="btn-confirm ml-2">Apply</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    // Button event listeners (mock)
    document.querySelectorAll('.btn-adjust').forEach(btn => {
        btn.addEventListener('click', () => openModal('adjustPointsModal'));
    });
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', () => openModal('messageModal'));
    });
</script>
@endsection
