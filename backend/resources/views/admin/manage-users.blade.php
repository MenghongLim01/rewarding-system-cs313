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
</style>

<div class="users-container">
    <!-- Header -->
    <div class="header">
        <h1>Manage Users 👥</h1>
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Back to Dashboard</a>
    </div>

    <!-- Add User Button -->
    <button class="btn-add-user" onclick="openModal('addUserModal')">Add User</button>

    <!-- Users Table -->
    <div class="table-wrapper">
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Role</th>
                    <th>Points</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="users-list">
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>john.doe@example.com</td>
                    <td>Company A</td>
                    <td>User</td>
                    <td>1500</td>
                    <td class="text-right">
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Message Modal -->
<div id="messageModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('messageModal')">&times;</span>
        <h2>Info</h2>
        <p>This is a test message.</p>
        <button onclick="closeModal('messageModal')">Got It</button>
    </div>
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('addUserModal')">&times;</span>
        <h2 class="text-xl font-bold mb-4">Add New User</h2>
        <form onsubmit="event.preventDefault(); alert('Add user submitted'); closeModal('addUserModal');">
            <label for="id">ID</label>
            <input type="text" name="id" class="modal-input" required>

            <label for="name">Name</label>
            <input type="text" name="name" class="modal-input" required>

            <label for="email">Email</label>
            <input type="email" name="email" class="modal-input" required>

            <label for="company">Company</label>
            <input type="text" name="company" class="modal-input" required>

            <label for="role">Role</label>
            <input type="text" name="role" class="modal-input" required>

            <label for="points">Points</label>
            <input type="number" name="points" class="modal-input" required>

            <div class="mt-4 flex justify-end">
                <button type="button" class="btn-cancel" onclick="closeModal('addUserModal')">Cancel</button>
                <button type="submit" class="btn-confirm ml-2">Add User</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('editUserModal')">&times;</span>
        <h2 class="text-xl font-bold mb-4">Edit User</h2>
        <form onsubmit="event.preventDefault(); alert('Edit user submitted'); closeModal('editUserModal');">
            <label for="id">ID</label>
            <input type="text" name="id" class="modal-input" value="1" required>

            <label for="name">Name</label>
            <input type="text" name="name" class="modal-input" value="John Doe" required>

            <label for="email">Email</label>
            <input type="email" name="email" class="modal-input" value="john.doe@example.com" required>

            <label for="company">Company</label>
            <input type="text" name="company" class="modal-input" value="Company A" required>

            <label for="role">Role</label>
            <input type="text" name="role" class="modal-input" value="User" required>

            <label for="points">Points</label>
            <input type="number" name="points" class="modal-input" value="1500" required>

            <div class="mt-4 flex justify-end">
                <button type="button" class="btn-cancel" onclick="closeModal('editUserModal')">Cancel</button>
                <button type="submit" class="btn-confirm ml-2">Update</button>
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
document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', () => openModal('editUserModal'));
});
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', () => openModal('messageModal'));
});
</script>
@endsection
