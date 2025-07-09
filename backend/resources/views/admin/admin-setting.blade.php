<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Plugin System - Admin Settings</title>
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

    <!-- Main container for the Admin Settings content -->
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-4xl w-full">
        <!-- Navigation Menu -->
        <nav class="flex justify-between items-center mb-10 pb-4 border-b border-gray-200">
            <div class="text-2xl font-extrabold text-purple-700">Admin Panel</div>
            <ul class="flex space-x-6">
                <li><a href="/admin/dashboard" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Dashboard</a></li>
                <li><a href="/admin/rewards" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Manage Rewards</a></li>
                <li><a href="/admin/users" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Manage Users</a></li>
                <li><a href="/admin/logs" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">View Logs</a></li>
                <li><a href="/admin/settings" class="text-purple-600 font-medium transition duration-300">Settings</a></li>
                <li><a href="/logout" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Logout</a></li>
            </ul>
        </nav>

        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Admin Settings ⚙️</h1>

        <!-- System Settings Form -->
        <section class="mb-10">
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">System Configuration</h2>
                <form id="admin-settings-form" class="space-y-6">
                    <div>
                        <label for="default-points-per-activity" class="block text-sm font-medium text-gray-700 mb-1">Default Points per Activity</label>
                        <input type="number" id="default-points-per-activity" name="default-points-per-activity" value="10" min="0"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        <p class="mt-1 text-xs text-gray-500">Points awarded for general activities if not specified.</p>
                    </div>
                    <div>
                        <label for="min-redemption-threshold" class="block text-sm font-medium text-gray-700 mb-1">Minimum Redemption Threshold</label>
                        <input type="number" id="min-redemption-threshold" name="min-redemption-threshold" value="100" min="0"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        <p class="mt-1 text-xs text-gray-500">Minimum points required to redeem any reward.</p>
                    </div>
                    <div>
                        <label for="reward-expiration-days" class="block text-sm font-medium text-gray-700 mb-1">Reward Expiration (Days)</label>
                        <input type="number" id="reward-expiration-days" name="reward-expiration-days" value="365" min="0"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        <p class="mt-1 text-xs text-gray-500">Number of days before a claimed reward expires (0 for never).</p>
                    </div>
                    <div>
                        <label for="email-notifications-enabled" class="flex items-center text-sm font-medium text-gray-700">
                            <input type="checkbox" id="email-notifications-enabled" name="email-notifications-enabled" checked
                                   class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded mr-2">
                            Enable Email Notifications
                        </label>
                        <p class="mt-1 text-xs text-gray-500">Send email notifications for point changes and redemptions.</p>
                    </div>
                    <div>
                        <label for="admin-email-for-alerts" class="block text-sm font-medium text-gray-700 mb-1">Admin Alert Email</label>
                        <input type="email" id="admin-email-for-alerts" name="admin-email-for-alerts" value="admin@yourrewardsystem.com"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        <p class="mt-1 text-xs text-gray-500">Email address for critical system alerts (e.g., low reward stock).</p>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit"
                                class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold shadow-md hover:bg-purple-700 transition duration-300">
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <div class="text-center mt-6">
            <a href="/admin/dashboard" class="text-purple-600 hover:text-purple-500 font-medium">Back to Admin Dashboard</a>
        </div>
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

        // Admin Settings Logic
        const adminSettingsForm = document.getElementById('admin-settings-form');

        // Simulate fetching settings data (in a real app, this would be from a backend)
        let systemSettings = {
            defaultPointsPerActivity: 10,
            minRedemptionThreshold: 100,
            rewardExpirationDays: 365,
            emailNotificationsEnabled: true,
            adminEmailForAlerts: "admin@yourrewardsystem.com"
        };

        document.addEventListener('DOMContentLoaded', () => {
            // Populate form fields with current settings
            document.getElementById('default-points-per-activity').value = systemSettings.defaultPointsPerActivity;
            document.getElementById('min-redemption-threshold').value = systemSettings.minRedemptionThreshold;
            document.getElementById('reward-expiration-days').value = systemSettings.rewardExpirationDays;
            document.getElementById('email-notifications-enabled').checked = systemSettings.emailNotificationsEnabled;
            document.getElementById('admin-email-for-alerts').value = systemSettings.adminEmailForAlerts;
        });

        adminSettingsForm.addEventListener('submit', (event) => {
            event.preventDefault(); // Prevent default form submission

            // Get updated values from the form
            const updatedSettings = {
                defaultPointsPerActivity: parseInt(document.getElementById('default-points-per-activity').value),
                minRedemptionThreshold: parseInt(document.getElementById('min-redemption-threshold').value),
                rewardExpirationDays: parseInt(document.getElementById('reward-expiration-days').value),
                emailNotificationsEnabled: document.getElementById('email-notifications-enabled').checked,
                adminEmailForAlerts: document.getElementById('admin-email-for-alerts').value
            };

            // Basic validation
            if (updatedSettings.defaultPointsPerActivity < 0 || updatedSettings.minRedemptionThreshold < 0 || updatedSettings.rewardExpirationDays < 0) {
                openModal('messageModal', 'Validation Error', 'Numeric settings cannot be negative.');
                return;
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(updatedSettings.adminEmailForAlerts)) {
                openModal('messageModal', 'Validation Error', 'Please enter a valid email address for admin alerts.');
                return;
            }

            // In a real application, you would send these updated settings to your backend.
            // Simulate saving settings
            systemSettings = updatedSettings;
            console.log('Admin settings updated:', systemSettings);

            openModal('messageModal', 'Settings Saved!', 'System settings have been successfully updated.');
        });
    </script>
</body>
</html>

