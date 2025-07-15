@extends('user.layouts.layout')

@section('title', 'Reward Plugin System - Notifications')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-5xl w-full">
    

    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Trasaction History 🧾</h1>

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
                <!-- JS will render here -->
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

<!-- Message Modal -->
<div id="messageModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('messageModal')">&times;</span>
        <h2 id="message-modal-title" class="text-2xl font-bold text-gray-800 mb-4"></h2>
        <p id="message-modal-message" class="text-gray-700 mb-6"></p>
        <button class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-purple-700 transition duration-300" onclick="closeModal('messageModal')">Got It!</button>
    </div>
</div>
@endsection

@push('scripts')
<script>
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

    let notifications = [
        { id: 1, title: '🎉 Reward Claimed: Exclusive Discount Voucher!', timestamp: '2 hours ago', isRead: false },
        { id: 2, title: '💰 Points Earned: You received +50 points for survey completion.', timestamp: 'Yesterday', isRead: false },
        { id: 3, title: '📢 System Announcement: New rewards added to the catalog!', timestamp: '3 days ago', isRead: true },
        { id: 4, title: '🎁 New Reward Available: Virtual Workshop Ticket!', timestamp: '1 week ago', isRead: false },
    ];

    function renderNotifications() {
        notificationList.innerHTML = '';

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
            renderNotifications();
        }
    }

    markAllReadButton.addEventListener('click', () => {
        const unreadNotificationsExist = notifications.some(n => !n.isRead);
        if (unreadNotificationsExist) {
            notifications.forEach(n => n.isRead = true);
            openModal('messageModal', 'Notifications Updated', 'All notifications marked as read.');
            renderNotifications();
        } else {
            openModal('messageModal', 'No New Notifications', 'All your notifications are already marked as read.');
        }
    });

    document.addEventListener('DOMContentLoaded', renderNotifications);
</script>
@endpush
