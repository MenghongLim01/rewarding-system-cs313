@extends('admin.layouts.layout')

@section('title', 'Manage Staff')

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

<!-- Container for the entire page -->


<div class="users-container">
    <!-- Header -->
    <div class="header">
        <h1>Manage Staff 👥</h1>
        <a href="#" class="back-link">← Back to Dashboard</a> <!-- Removed route -->
    </div>

    <button class="btn-add-staff" onclick="openModal('addStaffModal')">Add Staff</button>

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
        <h2 id="message-modal-title">Info</h2>
        <p id="message-modal-message">This is a test message.</p>
        <button onclick="closeModal('messageModal')">Got It</button>
    </div>
</div>

<!-- Add Staff Modal -->
<div id="addStaffModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('addStaffModal')">&times;</span>
        <h2 class="text-xl font-bold mb-4">Add New Staff</h2>

        <!-- Simulate form without route -->
        <form onsubmit="event.preventDefault(); alert('Submit pressed'); closeModal('addStaffModal');">
            <label for="id">ID</label>
            <input type="text" name="id" class="modal-input" required>

            <label for="name">Name</label>
            <input type="text" name="name" class="modal-input" required>

            <label for="email">Email</label>
            <input type="email" name="email" class="modal-input" required>

            <label for="role">Role</label>
            <input type="text" name="role" class="modal-input" required>

            <label for="company">Company</label>
            <input type="text" name="company" class="modal-input" required>

            <div class="mt-4 flex justify-end">
                <button type="button" class="btn-cancel" onclick="closeModal('addStaffModal')">Cancel</button>
                <button type="submit" class="btn-confirm ml-2">Add Staff</button>
            </div>
        </form>
    </div>
</div>

<!-- Adjust Points Modal -->
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


<!-- Edit Staff Modal -->
<div id="editStaffModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('editStaffModal')">&times;</span>
        <h2 class="text-xl font-bold mb-4">Edit Staff</h2>

        <!-- Simulate form -->
        <form onsubmit="event.preventDefault(); alert('Edit Submit pressed'); closeModal('editStaffModal');">
            <label for="id">ID</label>
            <input type="text" name="id" class="modal-input" value="1" required>

            <label for="name">Name</label>
            <input type="text" name="name" class="modal-input" value="John Doe" required>

            <label for="email">Email</label>
            <input type="email" name="email" class="modal-input" value="john.doe@example.com" required>

            <label for="role">Role</label>
            <input type="text" name="role" class="modal-input" value="Staff" required>  

            <label for="company">Company</label>
            <input type="text" name="company" class="modal-input" value="Company A" disabled>

            <div class="mt-4 flex justify-end">
                <button type="button" class="btn-cancel" onclick="closeModal('editStaffModal')">Cancel</button>
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
    btn.addEventListener('click', () => openModal('editStaffModal'));
    });

    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', () => openModal('messageModal'));
    });

</script>
@endsection
