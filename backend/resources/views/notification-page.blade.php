<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Plugin System - Notifications</title>
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

    <!-- Main container for the Notifications content -->
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-5xl w-full">
        <!-- Navigation Menu -->
        <nav class="flex justify-between items-center mb-10 pb-4 border-b border-gray-200">
            <div class="text-2xl font-extrabold text-purple-700">Reward System</div>
            <ul class="flex space-x-6">
                <li><a href="/dashboard" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Dashboard</a></li>
                <li><a href="/points" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">View Points</a></li>
                <li><a href="/redeem" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Redeem Rewards</a></li>
                <li><a href="/notifications" class="text-purple-600 font-medium transition duration-300">Notifications</a></li>
                <li><a href="/profile" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Profile</a></li>
                <li><a href="/logout" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Logout</a></li>
            </ul>
        </nav>

        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Your Notifications 🔔</h1>

        <!-- Notification List Section -->
        <section class="mb-10">
            <h2 class="text-3xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">Recent Updates</h2>

            <div class="flex justify-end mb-4">
                <button id="mark-all-read-button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md font-semibold hover:bg-gray-300 transition duration-300">
                    Mark All as Read
                </button>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <ul id="notification-list" class="divide-y divide-gray-200">
                    <!-- Example Notifications (will be dynamically loaded in a real app) -->
                    <li class="py-4 flex justify-between items-center notification-item" data-id="1" data-read="false">
                        <div>
                            <p class="text-gray-800 font-medium">🎉 Reward Claimed: Exclusive Discount Voucher!</p>
                            <span class="text-sm text-gray-500">2 hours ago</span>
                        </div>
                        <button class="mark-read-button text-purple-600 hover:text-purple-800 font-medium text-sm">Mark as Read</button>
                    </li>
                    <li class="py-4 flex justify-between items-center notification-item" data-id="2" data-read="false">
                        <div>
                            <p class="text-gray-800 font-medium">💰 Points Earned: You received +50 points for survey completion.</p>
                            <span class="text-sm text-gray-500">Yesterday</span>
                        </div>
                        <button class="mark-read-button text-purple-600 hover:text-purple-800 font-medium text-sm">Mark as Read</button>
                    </li>
                    <li class="py-4 flex justify-between items-center notification-item bg-gray-50 text-gray-500" data-id="3" data-read="true">
                        <div>
                            <p class="font-medium">📢 System Announcement: New rewards added to the catalog!</p>
                            <span class="text-sm">3 days ago</span>
                        </div>
                        <span class="text-xs text-gray-400">Read</span>
                    </li>
                    <li class="py-4 flex justify-between items-center notification-item" data-id="4" data-read="false">
                        <div>
                            <p class="text-gray-800 font-medium">🎁 New Reward Available: Virtual Workshop Ticket!</p>
                            <span class="text-sm text-gray-500">1 week ago</span>
                        </div>
                        <button class="mark-read-button text-purple-600 hover:text-purple-800 font-medium text-sm">Mark as Read</button>
                    </li>
                </ul>
                <div id="no-notifications-message" class="text-center mt-6 text-gray-500 italic hidden">
                    You have no new notifications.
                </div>
            </div>
        </section>

        <div class="text-center mt-6">
            <a href="/dashboard" class="text-purple-600 hover:text-purple-500 font-medium">Back to Dashboard</a>
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

        // Notification System Logic
        const notificationList = document.getElementById('notification-list');
        const markAllReadButton = document.getElementById('mark-all-read-button');
        const noNotificationsMessage = document.getElementById('no-notifications-message');

        // Simulate notification data (in a real app, this would be fetched from a backend)
        let notifications = [
            { id: 1, title: '🎉 Reward Claimed: Exclusive Discount Voucher!', timestamp: '2 hours ago', isRead: false },
            { id: 2, title: '💰 Points Earned: You received +50 points for survey completion.', timestamp: 'Yesterday', isRead: false },
            { id: 3, title: '📢 System Announcement: New rewards added to the catalog!', timestamp: '3 days ago', isRead: true },
            { id: 4, title: '🎁 New Reward Available: Virtual Workshop Ticket!', timestamp: '1 week ago', isRead: false },
        ];

        function renderNotifications() {
            notificationList.innerHTML = ''; // Clear existing notifications

            if (notifications.length === 0) {
                noNotificationsMessage.classList.remove('hidden');
                markAllReadButton.disabled = true;
                markAllReadButton.classList.add('opacity-50', 'cursor-not-allowed');
                return;
            } else {
                noNotificationsMessage.classList.add('hidden');
                markAllReadButton.disabled = false;
                markAllReadButton.classList.remove('opacity-50', 'cursor-not-allowed');
            }

            notifications.forEach(notification => {
                const listItem = document.createElement('li');
                listItem.classList.add('py-4', 'flex', 'justify-between', 'items-center', 'notification-item');
                if (notification.isRead) {
                    listItem.classList.add('bg-gray-50', 'text-gray-500');
                } else {
                    listItem.classList.add('text-gray-800');
                }
                listItem.dataset.id = notification.id;
                listItem.dataset.read = notification.isRead;

                listItem.innerHTML = `
                    <div>
                        <p class="font-medium">${notification.title}</p>
                        <span class="text-sm ${notification.isRead ? '' : 'text-gray-500'}">${notification.timestamp}</span>
                    </div>
                    ${notification.isRead ?
                        '<span class="text-xs text-gray-400">Read</span>' :
                        '<button class="mark-read-button text-purple-600 hover:text-purple-800 font-medium text-sm">Mark as Read</button>'
                    }
                `;
                notificationList.appendChild(listItem);
            });

            attachNotificationListeners();
        }

        function attachNotificationListeners() {
            document.querySelectorAll('.mark-read-button').forEach(button => {
                button.addEventListener('click', (event) => {
                    const notificationId = parseInt(event.target.closest('.notification-item').dataset.id);
                    markNotificationAsRead(notificationId);
                });
            });
        }

        function markNotificationAsRead(id) {
            const notificationIndex = notifications.findIndex(n => n.id === id);
            if (notificationIndex !== -1 && !notifications[notificationIndex].isRead) {
                notifications[notificationIndex].isRead = true;
                openModal('messageModal', 'Notification Updated', 'Notification marked as read.');
                renderNotifications(); // Re-render to update UI
                // In a real app, send update to backend
            }
        }

        markAllReadButton.addEventListener('click', () => {
            const unreadNotificationsExist = notifications.some(n => !n.isRead);
            if (unreadNotificationsExist) {
                notifications.forEach(n => n.isRead = true);
                openModal('messageModal', 'Notifications Updated', 'All notifications marked as read.');
                renderNotifications(); // Re-render to update UI
                // In a real app, send update to backend
            } else {
                openModal('messageModal', 'No New Notifications', 'All your notifications are already marked as read.');
            }
        });

        // Initial render on page load
        document.addEventListener('DOMContentLoaded', renderNotifications);
    </script>
</body>
</html>

