@extends('admin.layouts.layout')

@section('title', 'Manage Staff')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-users.css') }}">

<div class="users-container">
    <!-- Header -->
    <div class="header">
        <h1>Manage Staff 👥</h1>
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Back to Dashboard</a>
    </div>

    <!-- Staff Table -->
    <div class="table-wrapper">
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Company</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="staff-list">
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>john.doe@example.com</td>
                    <td>Staff</td>
                    <td>Company A</td>
                    <td class="text-right">
                        <button class="btn-adjust">Adjust Points</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jane Smith</td>
                    <td>jane.smith@example.com</td>
                    <td>Staff</td>
                    <td>Company B</td>
                    <td class="text-right">
                        <button class="btn-adjust">Adjust Points</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Admin User</td>
                    <td>admin@example.com</td>
                    <td class="text-purple-600 font-semibold">Admin</td>
                    <td>Company C</td>
                    <td class="text-right">
                        <button class="btn-adjust">Adjust Points</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
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

        <div>
            <label>ID</label>
            <input type="text" readonly value="1" class="modal-input" />
            <label>Name</label>
            <input type="text" readonly value="John Doe" class="modal-input" />
            <label>Company</label>
            <input type="text" readonly value="Company A" class="modal-input" />
            <label>Current Points</label>
            <input type="text" readonly value="1500" class="modal-input" />
            <label>Adjustment</label>
            <input type="number" class="modal-input" placeholder="Enter adjustment value" />
            <div class="mt-4 flex justify-end">
                <button type="button" onclick="closeModal('adjustPointsModal')" class="btn-cancel">Cancel</button>
                <button type="button" class="btn-confirm ml-2">Apply</button>
            </div>
        </div>

    </div>
</div>

<script>
    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    // Mock buttons for static interaction
    document.querySelectorAll('.btn-adjust').forEach(btn => {
        btn.addEventListener('click', () => openModal('adjustPointsModal'));
    });
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', () => openModal('messageModal'));
    });
</script>
@endsection
