<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Plugin System - View Logs</title>
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

    <!-- Main container for the View Logs content -->
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-6xl w-full">
        <!-- Navigation Menu -->
        <nav class="flex justify-between items-center mb-10 pb-4 border-b border-gray-200">
            <div class="text-2xl font-extrabold text-purple-700">Admin Panel</div>
            <ul class="flex space-x-6">
                <li><a href="/admin/dashboard" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Dashboard</a></li>
                <li><a href="/admin/rewards" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Manage Rewards</a></li>
                <li><a href="/admin/users" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Manage Users</a></li>
                <li><a href="/admin/logs" class="text-purple-600 font-medium transition duration-300">View Logs</a></li>
                <li><a href="/admin/settings" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Settings</a></li>
                <li><a href="/logout" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Logout</a></li>
            </ul>
        </nav>

        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">System Logs 📋</h1>

        <!-- Log List Section -->
        <section class="mb-10">
            <h2 class="text-3xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">All System Activities</h2>

            <!-- Filter/Search Options -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0 md:space-x-4">
                <div class="w-full md:w-1/3">
                    <label for="filter-log-type" class="block text-sm font-medium text-gray-700 mb-1">Filter by Type</label>
                    <select id="filter-log-type" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        <option value="all">All Types</option>
                        <option value="admin">Admin Actions</option>
                        <option value="user_activity">User Activity</option>
                        <option value="system">System Events</option>
                        <option value="error">Errors</option>
                    </select>
                </div>
                <div class="w-full md:w-1/3">
                    <label for="filter-date" class="block text-sm font-medium text-gray-700 mb-1">Filter by Date</label>
                    <input type="date" id="filter-date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                </div>
                <div class="w-full md:w-1/3">
                    <label for="search-log" class="block text-sm font-medium text-gray-700 mb-1">Search Logs</label>
                    <input type="text" id="search-log" placeholder="e.g., login, reward"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                    Timestamp
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Log Type
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Message
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">
                                    User ID
                                </th>
                            </tr>
                        </thead>
                        <tbody id="logs-list" class="bg-white divide-y divide-gray-200">
                            <!-- Example Logs (will be dynamically loaded in a real app) -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2024-07-08 10:00:00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Admin Action</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Admin (admin1) updated reward "Exclusive Discount Voucher"</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">admin1</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2024-07-08 09:45:30</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">User Activity</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">User (user1) redeemed "Premium Content Access"</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">user1</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2024-07-08 09:30:15</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">System Event</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Daily points bonus applied to all active users</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">N/A</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2024-07-07 18:00:00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Error</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Failed to send redemption confirmation email to user2: SMTP error</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">user2</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2024-07-07 14:00:00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">User Activity</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">User (user2) earned 50 points for survey completion</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">user2</td>
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

    <!-- The Modal for messages -->
    <div id="messageModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal('messageModal')">&times;</span>
            <h2 id="message-modal-title" class="text-2xl font-bold text-gray-800 mb-4"></h2>
            <p id="message-modal-message" class="text-gray-700 mb-6"></p>
            <button class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-purple-700 transition duration-300" onclick="closeModal('messageModal')">Got It!</button>
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
        });

        // Log Filtering and Search Logic
        const filterLogType = document.getElementById('filter-log-type');
        const filterDate = document.getElementById('filter-date');
        const searchLog = document.getElementById('search-log');
        const logsListTableBody = document.getElementById('logs-list');

        // Example log data (in a real app, this would be fetched from a backend)
        const allLogs = [
            { timestamp: '2024-07-08 10:00:00', type: 'Admin Action', message: 'Admin (admin1) updated reward "Exclusive Discount Voucher"', userId: 'admin1' },
            { timestamp: '2024-07-08 09:45:30', type: 'User Activity', message: 'User (user1) redeemed "Premium Content Access"', userId: 'user1' },
            { timestamp: '2024-07-08 09:30:15', type: 'System Event', message: 'Daily points bonus applied to all active users', userId: 'N/A' },
            { timestamp: '2024-07-07 18:00:00', type: 'Error', message: 'Failed to send redemption confirmation email to user2: SMTP error', userId: 'user2' },
            { timestamp: '2024-07-07 14:00:00', type: 'User Activity', message: 'User (user2) earned 50 points for survey completion', userId: 'user2' },
            { timestamp: '2024-07-06 12:00:00', type: 'Admin Action', message: 'Admin (admin1) added new reward: "Virtual Workshop Ticket"', userId: 'admin1' },
            { timestamp: '2024-07-05 08:00:00', type: 'System Event', message: 'Database backup initiated', userId: 'N/A' },
            { timestamp: '2024-07-04 11:30:00', type: 'User Activity', message: 'User (user1) logged in', userId: 'user1' },
        ];

        function renderLogs() {
            logsListTableBody.innerHTML = ''; // Clear existing rows

            const filteredLogs = allLogs.filter(log => {
                const typeMatch = filterLogType.value === 'all' || log.type.toLowerCase().includes(filterLogType.value.toLowerCase());
                const dateMatch = filterDate.value === '' || log.timestamp.startsWith(filterDate.value);
                const searchMatch = searchLog.value === '' ||
                                    log.message.toLowerCase().includes(searchLog.value.toLowerCase()) ||
                                    log.userId.toLowerCase().includes(searchLog.value.toLowerCase());
                return typeMatch && dateMatch && searchMatch;
            });

            if (filteredLogs.length === 0) {
                logsListTableBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 italic">
                            No logs found matching your criteria.
                        </td>
                    </tr>
                `;
                return;
            }

            filteredLogs.forEach(log => {
                const row = document.createElement('tr');
                row.classList.add('hover:bg-gray-50');

                let typeClass = '';
                switch (log.type) {
                    case 'Admin Action': typeClass = 'bg-blue-100 text-blue-800'; break;
                    case 'User Activity': typeClass = 'bg-green-100 text-green-800'; break;
                    case 'System Event': typeClass = 'bg-yellow-100 text-yellow-800'; break;
                    case 'Error': typeClass = 'bg-red-100 text-red-800'; break;
                    default: typeClass = 'bg-gray-100 text-gray-800';
                }

                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${log.timestamp}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${typeClass}">
                            ${log.type}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${log.message}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${log.userId}</td>
                `;
                logsListTableBody.appendChild(row);
            });
        }

        // Add event listeners for filters and search
        filterLogType.addEventListener('change', renderLogs);
        filterDate.addEventListener('change', renderLogs);
        searchLog.addEventListener('input', renderLogs); // Use 'input' for real-time search

        // Initial render when page loads
        document.addEventListener('DOMContentLoaded', renderLogs);
    </script>
</body>
</html>

