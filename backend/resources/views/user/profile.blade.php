@extends('user.layouts.layout')

@section('title', 'Reward Plugin System - User Profile')

@section('content')
<h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Your Profile 👤</h1>

<!-- Profile Information Section -->

<div class="w-[80%] mx-auto">
    <section class="mb-10">
        <div class="bg-gradient-to-r from-purple-600 to-indigo-700 text-white p-6 rounded-lg shadow-md mb-8 flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center mb-4 md:mb-0">
                <img src="https://placehold.co/80x80/8B5CF6/FFFFFF?text=JD" alt="User Profile" class="rounded-full border-2 border-white mr-4">
                <div>
                    <p class="text-2xl font-semibold" id="profile-name-display">John Doe</p>
                    <p class="text-sm opacity-90" id="profile-email-display">john.doe@example.com</p>
                </div>
            </div>
            <div class="text-right">
                <span class="text-3xl font-bold">Points: <span id="profile-points-display">1500</span></span>
                <p class="text-sm opacity-90 mt-1">Current points balance</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">Personal Details</h2>
            <form id="profile-form" class="space-y-6">
                <div>
                    <label for="new-password" class="block text-sm font-medium text-gray-700 mb-1">Upload Profile image</label>
                    <input type="file" id="profile-image" name="profile-image"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="name" name="name" value="John Doe" 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email" value="john.doe@example.com" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                </div>

                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Company</label>
                    <input type="text" id="company" name="company" value="Phka Blush" disabled
                        class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm sm:text-sm text-gray-700">
                </div>

                <div>
                    <label for="current-password" class="block text-sm font-medium text-gray-700 mb-1">Current Password (for changes)</label>
                    <input type="password" id="current-password" name="current-password"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm" placeholder="Leave blank if not changing">
                </div>
                <div>
                    <label for="new-password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" id="new-password" name="new-password"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm" placeholder="Leave blank if not changing">
                </div>
                <div>
                    <label for="confirm-new-password" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" id="confirm-new-password" name="confirm-new-password"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm" placeholder="Leave blank if not changing">
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                            class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold shadow-md hover:bg-purple-700 transition duration-300">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </section>

    <div class="text-center mt-6">
        <a href="/dashboard" class="text-purple-600 hover:text-purple-500 font-medium">Back to Dashboard</a>
    </div>

    <!-- Modal -->
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

        const profileForm = document.getElementById('profile-form');
        const profileNameDisplay = document.getElementById('profile-name-display');
        const profileEmailDisplay = document.getElementById('profile-email-display');
        const profilePointsDisplay = document.getElementById('profile-points-display');

        let userData = {
            name: "John Doe",
            email: "john.doe@example.com",
            points_balance: 1500
        };

        document.addEventListener('DOMContentLoaded', () => {
            profileNameDisplay.textContent = userData.name;
            profileEmailDisplay.textContent = userData.email;
            profilePointsDisplay.textContent = userData.points_balance;

            document.getElementById('name').value = userData.name;
            document.getElementById('email').value = userData.email;
        });

        profileForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const newName = document.getElementById('name').value;
            const newEmail = document.getElementById('email').value;
            const currentPassword = document.getElementById('current-password').value;
            const newPassword = document.getElementById('new-password').value;
            const confirmNewPassword = document.getElementById('confirm-new-password').value;

            if (newPassword || confirmNewPassword) {
                if (!currentPassword) {
                    openModal('messageModal', 'Update Error', 'Please enter your current password to change your password.');
                    return;
                }
                if (newPassword !== confirmNewPassword) {
                    openModal('messageModal', 'Update Error', 'New passwords do not match.');
                    return;
                }
            }

            userData.name = newName;
            userData.email = newEmail;

            profileNameDisplay.textContent = userData.name;
            profileEmailDisplay.textContent = userData.email;

            openModal('messageModal', 'Profile Updated!', 'Your profile information has been successfully updated.');

            document.getElementById('current-password').value = '';
            document.getElementById('new-password').value = '';
            document.getElementById('confirm-new-password').value = '';
        });
    </script>
</div>

@endpush
