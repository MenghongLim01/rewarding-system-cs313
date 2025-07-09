<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Plugin System - Admin Dashboard</title>
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
    </style>
</head>
<body class="antialiased">

    <!-- Main container for the Admin Dashboard content -->
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-6xl w-full">
        <!-- Navigation Menu -->
        <nav class="flex justify-between items-center mb-10 pb-4 border-b border-gray-200">
            <div class="text-2xl font-extrabold text-purple-700">Admin Panel</div>
            <ul class="flex space-x-6">
                <li><a href="/admin/dashboard" class="text-purple-600 font-medium transition duration-300">Dashboard</a></li>
                <li><a href="/admin/rewards" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Manage Rewards</a></li>
                <li><a href="/admin/users" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Manage Users</a></li>
                <li><a href="/admin/logs" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">View Logs</a></li>
                <li><a href="/admin/settings" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Settings</a></li>
                <li><a href="/logout" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Logout</a></li>
            </ul>
        </nav>

        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Admin Dashboard 📊</h1>

        <!-- System Stats Section -->
        <section class="mb-10">
            <h2 class="text-3xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">System Statistics</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-100 p-6 rounded-lg shadow-md text-center border border-blue-200">
                    <p class="text-5xl font-bold text-blue-700 mb-2" id="total-users">1,250</p>
                    <p class="text-gray-600 text-lg">Total Users</p>
                </div>
                <div class="bg-green-100 p-6 rounded-lg shadow-md text-center border border-green-200">
                    <p class="text-5xl font-bold text-green-700 mb-2" id="total-redemptions">875</p>
                    <p class="text-gray-600 text-lg">Total Redemptions</p>
                </div>
                <div class="bg-yellow-100 p-6 rounded-lg shadow-md text-center border border-yellow-200">
                    <p class="text-5xl font-bold text-yellow-700 mb-2" id="points-issued">150,000</p>
                    <p class="text-gray-600 text-lg">Points Issued</p>
                </div>
            </div>
        </section>

        <!-- Quick Links Section -->
        <section class="mb-10">
            <h2 class="text-3xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="/admin/rewards" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 text-center border border-gray-200">
                    <div class="text-purple-600 mb-3">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.503 4.618a1 1 0 00.95.691h4.862c.969 0 1.371 1.24.588 1.81l-3.937 2.863a1 1 0 00-.364 1.118l1.503 4.618c.3.921-.755 1.688-1.539 1.118l-3.937-2.863a1 1 0 00-1.176 0l-3.937 2.863c-.784.57-1.838-.197-1.539-1.118l1.503-4.618a1 1 0 00-.364-1.118L2.05 10.046c-.783-.57-.381-1.81.588-1.81h4.862a1 1 0 00.95-.691l1.503-4.618z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Manage Rewards</h3>
                    <p class="text-gray-600 text-sm mt-1">Add, edit, or remove rewards</p>
                </a>
                <a href="/admin/users" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 text-center border border-gray-200">
                    <div class="text-indigo-600 mb-3">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2v-2a3 3 0 015.356-1.857M9 20v-2m3 2v-2m3 2v-2m-9-1h10M4 10h16a1 1 0 001-1V6a1 1 0 00-1-1H4a1 1 0 00-1 1v3a1 1 0 001 1z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Manage Users</h3>
                    <p class="text-gray-600 text-sm mt-1">View and adjust user accounts</p>
                </a>
                <a href="/admin/logs" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 text-center border border-gray-200">
                    <div class="text-green-600 mb-3">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">View Logs</h3>
                    <p class="text-gray-600 text-sm mt-1">Track system activities and errors</p>
                </a>
            </div>
        </section>

        <!-- Recent Activity Tracking Section -->
        <section>
            <h2 class="text-3xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">Recent Admin & User Activity</h2>
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <ul class="divide-y divide-gray-200">
                    <li class="py-4 flex justify-between items-center">
                        <div>
                            <p class="text-gray-800 font-medium">Admin (Jane Doe) updated "Exclusive Discount Voucher" reward</p>
                            <span class="text-sm text-gray-500">2024-07-07 14:30</span>
                        </div>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Admin Action</span>
                    </li>
                    <li class="py-4 flex justify-between items-center">
                        <div>
                            <p class="text-gray-800 font-medium">User (John Smith) redeemed "Premium Content Access"</p>
                            <span class="text-sm text-gray-500">2024-07-07 10:15</span>
                        </div>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">User Redemption</span>
                    </li>
                    <li class="py-4 flex justify-between items-center">
                        <div>
                            <p class="text-gray-800 font-medium">Admin (Jane Doe) added new reward: "Virtual Workshop Ticket"</p>
                            <span class="text-sm text-gray-500">2024-07-06 18:00</span>
                        </div>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Admin Action</span>
                    </li>
                    <li class="py-4 flex justify-between items-center">
                        <div>
                            <p class="text-gray-800 font-medium">User (Alice Johnson) earned 50 points for survey completion</p>
                            <span class="text-sm text-gray-500">2024-07-06 09:00</span>
                        </div>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">User Earned</span>
                    </li>
                </ul>
                <div class="text-center mt-6">
                    <a href="/admin/logs" class="text-purple-600 hover:text-purple-500 font-medium">View All Logs</a>
                </div>
            </div>
        </section>
    </div>

    <!-- The Modal for messages -->
    <div id="rewardModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">&times;</span>
            <h2 id="modal-title" class="text-2xl font-bold text-gray-800 mb-4"></h2>
            <p id="modal-message" class="text-gray-700 mb-6"></p>
            <button class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-purple-700 transition duration-300" onclick="closeModal()">Got It!</button>
        </div>
    </div>

    <script>
        // Modal functions (kept for consistency)
        const rewardModal = document.getElementById('rewardModal');
        const modalTitle = document.getElementById('modal-title');
        const modalMessage = document.getElementById('modal-message');

        function openModal(title, message) {
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            rewardModal.style.display = 'flex';
        }

        function closeModal() {
            rewardModal.style.display = 'none';
        }

        window.addEventListener('click', (event) => {
            if (event.target == rewardModal) {
                closeModal();
            }
        });

        // In a real application, these stats would be fetched dynamically
        // document.getElementById('total-users').textContent = '1,250';
        // document.getElementById('total-redemptions').textContent = '875';
        // document.getElementById('points-issued').textContent = '150,000';
    </script>
</body>
</html>

