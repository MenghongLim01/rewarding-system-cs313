@extends('admin.layouts.layout')

@section('title', 'Manage Rewards')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/reward.css') }}">
@endsection

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-6xl w-full">
        <!-- Add New Reward Button (Top-Right) -->
        <!-- <div class="add-reward-container">
            <button id="add-reward-button" class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold shadow-md hover:bg-purple-700 transition duration-300 flex items-center" onclick="openRewardFormModal()">
                Add Reward
            </button>
        </div> -->

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
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">
                                    Company Name
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Phara Com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">500</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Unlimited</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="edit-reward-button text-indigo-600 hover:text-indigo-900 mr-4" data-id="1">Edit</button>
                                    <button class="delete-reward-button text-red-600 hover:text-red-900" data-id="1">Delete</button>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-6">
                    <a href="/admin/dashboard" class="text-purple-600 hover:text-purple-500 font-medium">Back to Admin Dashboard</a>
                </div>
            </div>

            <div class="add-reward-container">
                <button id="add-reward-button" class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold shadow-md hover:bg-purple-700 transition duration-300 flex items-center" onclick="openRewardFormModal()">
                    Add Reward
                </button>
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
        // Function to open the reward form modal
        function openRewardFormModal() {
            document.getElementById('rewardFormModal').style.display = 'flex';
        }

        // General Modal functions
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
    </script>
@endsection
