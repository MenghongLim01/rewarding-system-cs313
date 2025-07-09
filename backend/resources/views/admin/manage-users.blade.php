<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Plugin System - View Users</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for the Inter font and general body styling */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5; /* Light gray background */
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align items to the start to allow scrolling */
            min-height: 100vh; /* Minimum height to fill the viewport */
            padding: 20px; /* Padding around the content */
            box-sizing: border-box; /* Include padding in element's total width and height */
        }

        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Basic modal styling */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            text-align: center;
            position: relative;
        }

        .close-button {
            color: #aaa;
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Specific modal for points adjustment form */
        #adjustPointsModal .modal-content {
            text-align: left;
        }
    </style>
</head>
<body class="antialiased">

    <!-- Main container for the View Users content -->
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-6xl w-full">
        <!-- Navigation Menu -->
        <nav class="flex justify-between items-center mb-10 pb-4 border-b border-gray-200">
            <div class="text-2xl font-extrabold text-purple-700">Admin Panel</div>
            <ul class="flex space-x-6">
                <li><a href="/admin/dashboard" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Dashboard</a></li>
                <li><a href="/admin/rewards" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Manage Rewards</a></li>
                <li><a href="/admin/users" class="text-purple-600 font-medium transition duration-300">Manage Users</a></li>
                <li><a href="/admin/logs" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">View Logs</a></li>
                <li><a href="/admin/settings" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Settings</a></li>
                <li><a href="/logout" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Logout</a></li>
            </ul>
        </nav>

        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Manage Users 👥</h1>

        <!-- User List Section -->
        <section class="mb-10">
            <h2 class="text-3xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">All Users</h2>
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Points Balance
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="users-list" class="bg-white divide-y divide-gray-200">
                            <!-- Example Users (will be dynamically loaded in a real app) -->
                            <tr class="hover:bg-gray-50" data-id="user1">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">John Doe</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">john.doe@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">User</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-points="1500">1500</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="adjust-points-button text-purple-600 hover:text-purple-900 mr-4" data-id="user1">Adjust Points</button>
                                    <button class="view-activity-button text-blue-600 hover:text-blue-900 mr-4" data-id="user1">View Activity</button>
                                    <button class="delete-user-button text-red-600 hover:text-red-900" data-id="user1">Delete</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50" data-id="user2">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Jane Smith</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">jane.smith@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">User</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-points="800">800</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="adjust-points-button text-purple-600 hover:text-purple-900 mr-4" data-id="user2">Adjust Points</button>
                                    <button class="view-activity-button text-blue-600 hover:text-blue-900 mr-4" data-id="user2">View Activity</button>
                                    <button class="delete-user-button text-red-600 hover:text-red-900" data-id="user2">Delete</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50" data-id="admin1">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Admin User</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">admin@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-700 font-bold">Admin</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-points="0">0</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="adjust-points-button text-purple-600 hover:text-purple-900 mr-4" data-id="admin1">Adjust Points</button>
                                    <button class="view-activity-button text-blue-600 hover:text-blue-900 mr-4" data-id="admin1">View Activity</button>
                                    <button class="delete-user-button text-red-600 hover:text-red-900" data-id="admin1">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-6">
                    <a href="/admin/dashboard" class="text-purple-600 hover:text-purple-500 font-medium">Back to Admin Dashboard</a>
                </div>
            </div>
        </section>
    </div>

    <!-- The Modal for general messages (success/error) -->
    <div id="messageModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal('messageModal')">&times;</span>
            <h2 id="message-modal-title" class="text-2xl font-bold text-gray-800 mb-4"></h2>
            <p id="message-modal-message" class="text-gray-700 mb-6"></p>
            <button class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-purple-700 transition duration-300" onclick="closeModal('messageModal')">Got It!</button>
        </div>
    </div>

    <!-- The Modal for Adjust Points Form -->
    <div id="adjustPointsModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal('adjustPointsModal')">&times;</span>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Adjust User Points</h2>
            <form id="adjust-points-form" class="space-y-4">
                <div>
                    <label for="user-name-display" class="block text-sm font-medium text-gray-700 mb-1">User</label>
                    <input type="text" id="user-name-display" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed" readonly>
                </div>
                <div>
                    <label for="current-points-display" class="block text-sm font-medium text-gray-700 mb-1">Current Points</label>
                    <input type="text" id="current-points-display" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed" readonly>
                </div>
                <div>
                    <label for="points-adjustment" class="block text-sm font-medium text-gray-700 mb-1">Points Adjustment</label>
                    <input type="number" id="points-adjustment" name="points-adjustment" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                    <p class="mt-1 text-xs text-gray-500">Enter positive value to add, negative to subtract.</p>
                </div>
                <input type="hidden" id="adjust-user-id">
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal('adjustPointsModal')" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-300">
                        Cancel
                    </button>
                    <button type="submit"
                            class="bg-purple-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-purple-700 transition duration-300 shadow-md">
                        Apply Adjustment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // General Modal functions
        const messageModal = document.getElementById('messageModal');
        const messageModalTitle = document.getElementById('message-modal-title');
        const messageModalMessage = document.getElementById('message-modal-message');

        function openModal(modalId, title = '', message = '') {
            const modal = document.getElementById(modalId);
            if (modalId === 'messageModal') {
                messageModalTitle.textContent = title;
                messageModalMessage.textContent = message;
            }
            modal.style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        window.addEventListener('click', (event) => {
            if (event.target == messageModal) {
                closeModal('messageModal');
            }
            if (event.target == adjustPointsModal) {
                closeModal('adjustPointsModal');
            }
        });

        // User Management Specific Logic
        const usersListTableBody = document.getElementById('users-list');
        const adjustPointsModal = document.getElementById('adjustPointsModal');
        const adjustPointsForm = document.getElementById('adjust-points-form');
        const userNameDisplay = document.getElementById('user-name-display');
        const currentPointsDisplay = document.getElementById('current-points-display');
        const pointsAdjustmentInput = document.getElementById('points-adjustment');
        const adjustUserIdInput = document.getElementById('adjust-user-id');

        let users = [
            { id: 'user1', name: 'John Doe', email: 'john.doe@example.com', role: 'User', points_balance: 1500 },
            { id: 'user2', name: 'Jane Smith', email: 'jane.smith@example.com', role: 'User', points_balance: 800 },
            { id: 'admin1', name: 'Admin User', email: 'admin@example.com', role: 'Admin', points_balance: 0 }
        ];

        // Function to render users table
        function renderUsers() {
            usersListTableBody.innerHTML = ''; // Clear existing rows
            if (users.length === 0) {
                usersListTableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 italic">
                            No users found.
                        </td>
                    </tr>
                `;
                return;
            }

            users.forEach(user => {
                const row = document.createElement('tr');
                row.classList.add('hover:bg-gray-50');
                row.dataset.id = user.id;
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${user.name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${user.email}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm ${user.role === 'Admin' ? 'text-purple-700 font-bold' : 'text-gray-900'}">${user.role}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-points="${user.points_balance}">${user.points_balance}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="adjust-points-button text-purple-600 hover:text-purple-900 mr-4" data-id="${user.id}">Adjust Points</button>
                        <button class="view-activity-button text-blue-600 hover:text-blue-900 mr-4" data-id="${user.id}">View Activity</button>
                        <button class="delete-user-button text-red-600 hover:text-red-900" data-id="${user.id}">Delete</button>
                    </td>
                `;
                usersListTableBody.appendChild(row);
            });

            // Re-attach event listeners after rendering
            attachUserButtonListeners();
        }

        // Function to attach event listeners to user action buttons
        function attachUserButtonListeners() {
            document.querySelectorAll('.adjust-points-button').forEach(button => {
                button.onclick = (event) => openAdjustPointsModal(event.target.dataset.id);
            });
            document.querySelectorAll('.view-activity-button').forEach(button => {
                button.onclick = (event) => viewUserActivity(event.target.dataset.id);
            });
            document.querySelectorAll('.delete-user-button').forEach(button => {
                button.onclick = (event) => deleteUser(event.target.dataset.id);
            });
        }

        // Open Adjust Points Modal
        function openAdjustPointsModal(userId) {
            const user = users.find(u => u.id === userId);
            if (user) {
                userNameDisplay.value = user.name;
                currentPointsDisplay.value = user.points_balance;
                pointsAdjustmentInput.value = ''; // Clear previous adjustment
                adjustUserIdInput.value = user.id;
                openModal('adjustPointsModal');
            } else {
                openModal('messageModal', 'Error', 'User not found.');
            }
        }

        // Handle Adjust Points Form Submission
        adjustPointsForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const userId = adjustUserIdInput.value;
            const adjustment = parseInt(pointsAdjustmentInput.value);

            if (isNaN(adjustment)) {
                openModal('messageModal', 'Invalid Input', 'Please enter a valid number for points adjustment.');
                return;
            }

            const userIndex = users.findIndex(u => u.id === userId);
            if (userIndex !== -1) {
                users[userIndex].points_balance += adjustment;
                openModal('messageModal', 'Success!', `Points for ${users[userIndex].name} adjusted successfully.`);
                closeModal('adjustPointsModal');
                renderUsers(); // Re-render the table
            } else {
                openModal('messageModal', 'Error', 'User not found for points adjustment.');
            }
        });

        // View User Activity Function (Placeholder)
        function viewUserActivity(userId) {
            // In a real application, this would redirect to /admin/user-activity page
            // or open a modal with the user's activity logs.
            console.log(`Navigating to user activity for user ID: ${userId}`);
            openModal('messageModal', 'View Activity', `Simulating navigation to activity logs for user ID: ${userId}`);
            // window.location.href = `/admin/user-activity?userId=${userId}`; // Example redirection
        }

        // Delete User Function
        function deleteUser(userId) {
            // Using a custom modal instead of confirm()
            openModal('messageModal', 'Confirm Deletion', 'Are you sure you want to delete this user? This action cannot be undone.', () => {
                users = users.filter(u => u.id !== userId);
                openModal('messageModal', 'Success!', 'User deleted successfully.');
                renderUsers(); // Re-render the table
            }, true); // Pass true to indicate it's a confirmation modal

            // A more robust confirmation would involve a custom modal with Yes/No buttons
            // For now, using a simplified approach with a single "Got It!" button and console log for confirmation.
            // If a true confirmation is needed:
            // if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
            //     users = users.filter(u => u.id !== userId);
            //     openModal('messageModal', 'Success!', 'User deleted successfully.');
            //     renderUsers(); // Re-render the table
            // }
        }

        // Override openModal for confirmation specific logic
        const originalOpenModal = openModal;
        openModal = function(modalId, title, message, onConfirmCallback = null, isConfirmation = false) {
            originalOpenModal(modalId, title, message);
            if (isConfirmation && onConfirmCallback) {
                // For demonstration, the "Got It!" button acts as confirmation.
                // In a real app, you'd have separate "Confirm" and "Cancel" buttons.
                document.querySelector(`#${modalId} .modal-content button`).onclick = () => {
                    onConfirmCallback();
                    closeModal(modalId);
                };
            } else {
                 document.querySelector(`#${modalId} .modal-content button`).onclick = () => {
                    closeModal(modalId);
                };
            }
        };


        // Initial render when page loads
        document.addEventListener('DOMContentLoaded', renderUsers);
    </script>
</body>
</html>

