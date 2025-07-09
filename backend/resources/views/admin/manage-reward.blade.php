<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Plugin System - Manage Rewards</title>
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

        /* Specific modal for add/edit reward form */
        #rewardFormModal .modal-content {
            text-align: left;
        }
    </style>
</head>
<body class="antialiased">

    <!-- Main container for the Manage Rewards content -->
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-6xl w-full">
        <!-- Navigation Menu -->
        <nav class="flex justify-between items-center mb-10 pb-4 border-b border-gray-200">
            <div class="text-2xl font-extrabold text-purple-700">Admin Panel</div>
            <ul class="flex space-x-6">
                <li><a href="/admin/dashboard" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Dashboard</a></li>
                <li><a href="/admin/rewards" class="text-purple-600 font-medium transition duration-300">Manage Rewards</a></li>
                <li><a href="/admin/users" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Manage Users</a></li>
                <li><a href="/admin/logs" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">View Logs</a></li>
                <li><a href="/admin/settings" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Settings</a></li>
                <li><a href="/logout" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Logout</a></li>
            </ul>
        </nav>

        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Manage Rewards 🏆</h1>

        <!-- Add New Reward Button -->
        <div class="flex justify-end mb-6">
            <button id="add-reward-button" class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold shadow-md hover:bg-purple-700 transition duration-300 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Add New Reward
            </button>
        </div>

        <!-- Rewards List Section -->
        <section class="mb-10">
            <h2 class="text-3xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">All Rewards</h2>
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                    Reward Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Points Required
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Available Stock
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="rewards-list" class="bg-white divide-y divide-gray-200">
                            <!-- Example Rewards (will be dynamically loaded in a real app) -->
                            <tr class="hover:bg-gray-50" data-id="1">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Exclusive Discount Voucher</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Get 20% off your next purchase!</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">500</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Unlimited</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="edit-reward-button text-indigo-600 hover:text-indigo-900 mr-4" data-id="1">Edit</button>
                                    <button class="delete-reward-button text-red-600 hover:text-red-900" data-id="1">Delete</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50" data-id="2">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Premium Content Access</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Unlock exclusive articles and videos for a month.</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">800</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">50</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="edit-reward-button text-indigo-600 hover:text-indigo-900 mr-4" data-id="2">Edit</button>
                                    <button class="delete-reward-button text-red-600 hover:text-red-900" data-id="2">Delete</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50" data-id="3">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Personalized Coaching Session</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">A 30-minute 1-on-1 session with an expert.</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1200</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">5</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="edit-reward-button text-indigo-600 hover:text-indigo-900 mr-4" data-id="3">Edit</button>
                                    <button class="delete-reward-button text-red-600 hover:text-red-900" data-id="3">Delete</button>
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

    <!-- The Modal for Add/Edit Reward Form -->
    <div id="rewardFormModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal('rewardFormModal')">&times;</span>
            <h2 id="reward-form-modal-title" class="text-2xl font-bold text-gray-800 mb-4">Add New Reward</h2>
            <form id="reward-form" class="space-y-4">
                <div>
                    <label for="reward-name" class="block text-sm font-medium text-gray-700 mb-1">Reward Name</label>
                    <input type="text" id="reward-name" name="reward-name" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                </div>
                <div>
                    <label for="reward-description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="reward-description" name="reward-description" rows="3" required
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm"></textarea>
                </div>
                <div>
                    <label for="points-required" class="block text-sm font-medium text-gray-700 mb-1">Points Required</label>
                    <input type="number" id="points-required" name="points-required" required min="0"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                </div>
                <div>
                    <label for="available-stock" class="block text-sm font-medium text-gray-700 mb-1">Available Stock</label>
                    <input type="number" id="available-stock" name="available-stock" required min="-1" placeholder="-1 for unlimited"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                    <p class="mt-1 text-xs text-gray-500">Enter -1 for unlimited stock.</p>
                </div>
                <input type="hidden" id="reward-id">
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal('rewardFormModal')" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-300">
                        Cancel
                    </button>
                    <button type="submit"
                            class="bg-purple-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-purple-700 transition duration-300 shadow-md">
                        Save Reward
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
            } else if (modalId === 'rewardFormModal') {
                document.getElementById('reward-form-modal-title').textContent = title;
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
            if (event.target == rewardFormModal) {
                closeModal('rewardFormModal');
            }
        });

        // Reward Management Specific Logic
        const addRewardButton = document.getElementById('add-reward-button');
        const rewardFormModal = document.getElementById('rewardFormModal');
        const rewardForm = document.getElementById('reward-form');
        const rewardsListTableBody = document.getElementById('rewards-list');

        let rewards = [
            { id: 1, name: 'Exclusive Discount Voucher', description: 'Get 20% off your next purchase!', points: 500, stock: 'Unlimited' },
            { id: 2, name: 'Premium Content Access', description: 'Unlock exclusive articles and videos for a month.', points: 800, stock: 50 },
            { id: 3, name: 'Personalized Coaching Session', description: 'A 30-minute 1-on-1 session with an expert.', points: 1200, stock: 5 }
        ];
        let nextRewardId = 4; // To simulate new IDs for added rewards

        // Function to render rewards table
        function renderRewards() {
            rewardsListTableBody.innerHTML = ''; // Clear existing rows
            if (rewards.length === 0) {
                rewardsListTableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 italic">
                            No rewards available. Click "Add New Reward" to create one.
                        </td>
                    </tr>
                `;
                return;
            }

            rewards.forEach(reward => {
                const row = document.createElement('tr');
                row.classList.add('hover:bg-gray-50');
                row.dataset.id = reward.id;
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${reward.name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${reward.description}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${reward.points}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${reward.stock === -1 ? 'Unlimited' : reward.stock}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="edit-reward-button text-indigo-600 hover:text-indigo-900 mr-4" data-id="${reward.id}">Edit</button>
                        <button class="delete-reward-button text-red-600 hover:text-red-900" data-id="${reward.id}">Delete</button>
                    </td>
                `;
                rewardsListTableBody.appendChild(row);
            });

            // Re-attach event listeners after rendering
            attachRewardButtonListeners();
        }

        // Function to attach event listeners to edit/delete buttons
        function attachRewardButtonListeners() {
            document.querySelectorAll('.edit-reward-button').forEach(button => {
                button.onclick = (event) => editReward(event.target.dataset.id);
            });
            document.querySelectorAll('.delete-reward-button').forEach(button => {
                button.onclick = (event) => deleteReward(event.target.dataset.id);
            });
        }

        // Add Reward Button Click
        addRewardButton.addEventListener('click', () => {
            // Reset form for adding new reward
            rewardForm.reset();
            document.getElementById('reward-id').value = ''; // Clear hidden ID
            openModal('rewardFormModal', 'Add New Reward');
        });

        // Handle Reward Form Submission (Add/Edit)
        rewardForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const id = document.getElementById('reward-id').value;
            const name = document.getElementById('reward-name').value;
            const description = document.getElementById('reward-description').value;
            const points = parseInt(document.getElementById('points-required').value);
            let stock = parseInt(document.getElementById('available-stock').value);

            if (stock < -1) {
                stock = -1; // Ensure stock is not less than -1
            }

            if (id) {
                // Edit existing reward
                const index = rewards.findIndex(r => r.id == id);
                if (index !== -1) {
                    rewards[index] = { id: parseInt(id), name, description, points, stock };
                    openModal('messageModal', 'Success!', 'Reward updated successfully.');
                } else {
                    openModal('messageModal', 'Error', 'Reward not found.');
                }
            } else {
                // Add new reward
                const newReward = { id: nextRewardId++, name, description, points, stock };
                rewards.push(newReward);
                openModal('messageModal', 'Success!', 'New reward added successfully.');
            }

            closeModal('rewardFormModal');
            renderRewards(); // Re-render the table
        });

        // Edit Reward Function
        function editReward(id) {
            const reward = rewards.find(r => r.id == id);
            if (reward) {
                document.getElementById('reward-id').value = reward.id;
                document.getElementById('reward-name').value = reward.name;
                document.getElementById('reward-description').value = reward.description;
                document.getElementById('points-required').value = reward.points;
                document.getElementById('available-stock').value = reward.stock === 'Unlimited' ? -1 : reward.stock; // Convert 'Unlimited' back to -1 for form
                openModal('rewardFormModal', 'Edit Reward');
            } else {
                openModal('messageModal', 'Error', 'Reward not found for editing.');
            }
        }

        // Delete Reward Function
        function deleteReward(id) {
            if (confirm('Are you sure you want to delete this reward?')) {
                rewards = rewards.filter(r => r.id != id);
                openModal('messageModal', 'Success!', 'Reward deleted successfully.');
                renderRewards(); // Re-render the table
            }
        }

        // Initial render when page loads
        document.addEventListener('DOMContentLoaded', renderRewards);
    </script>
</body>
</html>

