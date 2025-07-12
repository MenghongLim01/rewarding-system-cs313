<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Order & Rewards System</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Light gray background */
        }
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
            background-color: #fff;
            margin: auto;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            width: 500px;
            text-align: center;
            position: relative;
        }
        .close-button {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            font-size: 2rem;
            font-weight: bold;
            cursor: pointer;
            color: #9ca3af; /* Gray color */
        }
        .close-button:hover {
            color: #6b7280; /* Darker gray on hover */
        }
    </style>
</head>
<body class="p-4 sm:p-6 md:p-8 lg:p-10">

    <div class="max-w-4xl mx-auto bg-white p-6 sm:p-8 md:p-10 rounded-2xl shadow-xl">
        <h1 class="text-3xl sm:text-4xl font-bold text-center text-gray-800 mb-8">Customer Order & Rewards</h1>

        <!-- Company Management Section -->
        <div class="mb-8 p-6 bg-blue-50 rounded-xl shadow-inner border border-blue-200">
            <h2 class="text-2xl font-semibold text-blue-800 mb-4">Company Management</h2>
            <div class="mb-4">
                <label for="companySelect" class="block text-gray-700 text-sm font-medium mb-2">Select Existing Company:</label>
                <select id="companySelect" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
                    <!-- Options will be populated by JavaScript -->
                </select>
            </div>
            <div class="mt-6">
                <label for="newCompanyName" class="block text-gray-700 text-sm font-medium mb-2">Add New Company Name:</label>
                <div class="flex gap-4">
                    <input type="text" id="newCompanyName" placeholder="e.g., Company D" class="flex-grow p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
                    <button id="addCompanyBtn" class="bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 ease-in-out shadow-md">
                        Add Company
                    </button>
                </div>
            </div>
            <button id="removeCompanyBtn" class="mt-4 w-full bg-red-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-red-600 transition duration-300 ease-in-out shadow-md">
                Remove Selected Company
            </button>
            <p class="text-sm text-gray-500 mt-3 text-center">Manage your list of companies here.</p>
        </div>

        <!-- Point Calculation Logic (Admin View) -->
        <div class="mb-8 p-6 bg-yellow-100 rounded-xl shadow-lg border border-yellow-300">
            <h2 class="text-2xl font-bold text-yellow-800 mb-5 text-center">Point Calculation Logic <span class="font-normal text-lg">(Admin View)</span></h2>
            <p class="text-yellow-700 text-center mb-6">Adjust the points customers earn per dollar spent for the **<span id="currentCompanyDisplay" class="font-semibold"></span>** company.</p>
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <div class="flex-grow">
                    <label for="pointsPerDollar" class="block text-gray-700 text-sm font-medium mb-2">Points per Dollar:</label>
                    <input type="number" id="pointsPerDollar" class="w-full p-3 border border-yellow-400 rounded-lg focus:ring-yellow-500 focus:border-yellow-500 transition duration-200 ease-in-out bg-yellow-50 text-yellow-900 font-semibold text-lg" value="1" step="0.1" min="0.1">
                </div>
                <button id="savePointsLogicBtn" class="mt-6 sm:mt-0 bg-yellow-600 text-white py-3 px-8 rounded-lg font-bold text-lg hover:bg-yellow-700 transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                    Save Logic
                </button>
            </div>
            <p class="text-sm text-gray-600 mt-4 text-center">Example: Set to '1.5' for 1.5 points per dollar.</p>
        </div>

        <!-- Reward Logic (Admin View) -->
        <div class="mb-8 p-6 bg-orange-50 rounded-xl shadow-inner border border-orange-200">
            <h2 class="text-2xl font-semibold text-orange-800 mb-4">Reward Logic (Admin View)</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="rewardThreshold" class="block text-gray-700 text-sm font-medium mb-2">Reward Threshold (Points):</label>
                    <input type="number" id="rewardThreshold" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 transition duration-200 ease-in-out" value="100" step="10" min="10">
                </div>
                <div>
                    <label for="rewardValue" class="block text-gray-700 text-sm font-medium mb-2">Reward Value ($):</label>
                    <input type="number" id="rewardValue" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 transition duration-200 ease-in-out" value="10" step="1" min="1">
                </div>
            </div>
            <button id="saveRewardLogicBtn" class="mt-6 w-full bg-orange-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-orange-700 transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                Save Reward Logic
            </button>
            <p class="text-sm text-gray-500 mt-3 text-center">Admin can set the points required for a reward and its value (e.g., a discount, free item like water bottle or umbrella).</p>
        </div>

        <!-- Customer Membership Check -->
        <div class="mb-8 p-6 bg-green-50 rounded-xl shadow-inner border border-green-200">
            <h2 class="text-2xl font-semibold text-green-800 mb-4">Customer Check</h2>
            <div class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="flex-grow w-full">
                    <label for="customerId" class="block text-gray-700 text-sm font-medium mb-2">Customer ID / Name / Phone / Email:</label>
                    <input type="text" id="customerId" placeholder="e.g., John Doe, member123, 012345678, john@example.com" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 transition duration-200 ease-in-out">
                </div>
                <button id="checkCustomerBtn" class="w-full sm:w-auto bg-green-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-700 transition duration-300 ease-in-out shadow-md hover:shadow-lg flex-shrink-0">
                    Check Customer
                </button>
            </div>
            <p id="customerStatus" class="mt-4 text-center text-lg font-medium text-gray-700"></p>
        </div>

        <!-- Order Details -->
        <div class="mb-8 p-6 bg-purple-50 rounded-xl shadow-inner border border-purple-200">
            <h2 class="text-2xl font-semibold text-purple-800 mb-4">Order Details</h2>
            <div id="foodItemsContainer">
                <!-- Food items will be added here dynamically -->
                <div class="flex flex-col sm:flex-row gap-4 mb-4 items-center">
                    <div class="flex-grow w-full">
                        <label for="foodName1" class="block text-gray-700 text-sm font-medium mb-2">Food Item:</label>
                        <input type="text" id="foodName1" placeholder="e.g., Food A" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 transition duration-200 ease-in-out food-name">
                    </div>
                    <div class="w-full sm:w-32">
                        <label for="foodPrice1" class="block text-gray-700 text-sm font-medium mb-2">Price ($):</label>
                        <input type="number" id="foodPrice1" placeholder="0.00" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 transition duration-200 ease-in-out food-price" step="0.01" min="0">
                    </div>
                    <button class="remove-item-btn mt-6 sm:mt-0 bg-red-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-red-600 transition duration-300 ease-in-out shadow-md hover:shadow-lg flex-shrink-0">
                        Remove
                    </button>
                </div>
            </div>
            <button id="addFoodItemBtn" class="mt-4 w-full bg-purple-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-purple-700 transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                Add Food Item
            </button>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-xl font-semibold text-gray-800">Total Cost:</span>
                    <span id="totalCost" class="text-2xl font-bold text-purple-700">$0.00</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-xl font-semibold text-gray-800">Points Earned:</span>
                    <span id="pointsEarned" class="text-2xl font-bold text-green-700">0 Points</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mt-8">
            <button id="processOrderBtn" class="flex-1 bg-indigo-600 text-white py-4 px-6 rounded-lg font-bold text-lg hover:bg-indigo-700 transition duration-300 ease-in-out shadow-lg hover:shadow-xl">
                Process Order & Confirm
            </button>
            <button id="clearOrderBtn" class="flex-1 bg-gray-300 text-gray-800 py-4 px-6 rounded-lg font-bold text-lg hover:bg-gray-400 transition duration-300 ease-in-out shadow-lg hover:shadow-xl">
                Clear Order
            </button>
        </div>
    </div>

    <!-- Modals -->
    <div id="messageModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal('messageModal')">&times;</span>
            <h3 id="modalTitle" class="text-2xl font-bold mb-4 text-gray-800"></h3>
            <p id="modalMessage" class="text-lg text-gray-700 mb-6"></p>
            <button onclick="closeModal('messageModal')" class="bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 ease-in-out shadow-md">OK</button>
        </div>
    </div>

    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal('confirmationModal')">&times;</span>
            <h3 class="text-2xl font-bold mb-4 text-gray-800">Confirm Order</h3>
            <p id="confirmMessage" class="text-lg text-gray-700 mb-6"></p>
            <div class="flex justify-center gap-4">
                <button id="confirmYesBtn" class="bg-green-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-700 transition duration-300 ease-in-out shadow-md">Yes, Confirm</button>
                <button id="confirmNoBtn" class="bg-red-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-red-600 transition duration-300 ease-in-out shadow-md">No, Cancel</button>
            </div>
        </div>
    </div>

    <script>
        // Global variables for admin settings (simulated in-memory)
        // This data will not persist if the page is refreshed or closed.
        let companies = {
            "companyA": { name: "Company A", pointsPerDollar: 1.0 },
            "companyB": { name: "Company B", pointsPerDollar: 1.2 },
            "companyC": { name: "Company C", pointsPerDollar: 0.8 },
        };
        let currentCompanyId = "companyA"; // Default selected company
        let currentRewardThreshold = 100;
        let currentRewardValue = 10;
        let customerIsMember = false; // Simulated customer status

        // DOM Elements
        const foodItemsContainer = document.getElementById('foodItemsContainer');
        const addFoodItemBtn = document.getElementById('addFoodItemBtn');
        const totalCostSpan = document.getElementById('totalCost');
        const pointsEarnedSpan = document.getElementById('pointsEarned');
        const checkCustomerBtn = document.getElementById('checkCustomerBtn');
        const customerIdInput = document.getElementById('customerId');
        const customerStatusP = document.getElementById('customerStatus');
        const processOrderBtn = document.getElementById('processOrderBtn');
        const clearOrderBtn = document.getElementById('clearOrderBtn');
        
        const companySelect = document.getElementById('companySelect');
        const newCompanyNameInput = document.getElementById('newCompanyName');
        const addCompanyBtn = document.getElementById('addCompanyBtn');
        const removeCompanyBtn = document.getElementById('removeCompanyBtn');

        const pointsPerDollarInput = document.getElementById('pointsPerDollar');
        const savePointsLogicBtn = document.getElementById('savePointsLogicBtn');
        const currentCompanyDisplay = document.getElementById('currentCompanyDisplay');

        const rewardThresholdInput = document.getElementById('rewardThreshold');
        const rewardValueInput = document.getElementById('rewardValue');
        const saveRewardLogicBtn = document.getElementById('saveRewardLogicBtn');

        // Modal Elements
        const messageModal = document.getElementById('messageModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const confirmationModal = document.getElementById('confirmationModal');
        const confirmMessage = document.getElementById('confirmMessage');
        const confirmYesBtn = document.getElementById('confirmYesBtn');
        const confirmNoBtn = document.getElementById('confirmNoBtn');

        let foodItemCounter = 0; // Initialize to 0, so the first call to addFoodItem makes it 1

        // --- Utility Functions for Modals ---
        function showModal(modalId, title, message) {
            const modal = document.getElementById(modalId);
            if (modalId === 'messageModal') {
                modalTitle.textContent = title;
                modalMessage.textContent = message;
            }
            modal.style.display = 'flex'; // Use flex to center
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // --- Company Management Functions ---

        /**
         * Populates the company selection dropdown from the local 'companies' object.
         */
        function populateCompanySelect() {
            companySelect.innerHTML = ''; // Clear existing options
            for (const id in companies) {
                const option = document.createElement('option');
                option.value = id;
                option.textContent = `${companies[id].name} (${companies[id].pointsPerDollar}$ = 1 Point)`;
                companySelect.appendChild(option);
            }
            // Ensure the currently selected company is visible
            if (currentCompanyId && companies[currentCompanyId]) {
                 companySelect.value = currentCompanyId;
            } else if (Object.keys(companies).length > 0) {
                currentCompanyId = Object.keys(companies)[0];
                companySelect.value = currentCompanyId;
            }
        }

        /**
         * Adds a new company to the local simulated database.
         */
        function addCompany() {
            const newName = newCompanyNameInput.value.trim();
            if (!newName) {
                showModal('messageModal', 'Invalid Company Name', 'Please enter a name for the new company.');
                return;
            }

            // Generate a simple unique ID
            const newId = 'company' + (Object.keys(companies).length + 1);
            
            if (Object.values(companies).some(company => company.name.toLowerCase() === newName.toLowerCase())) {
                showModal('messageModal', 'Duplicate Company', 'A company with this name already exists.');
                return;
            }

            companies[newId] = { name: newName, pointsPerDollar: 1.0 }; // Default 1 point per dollar
            populateCompanySelect();
            companySelect.value = newId; // Select the newly added company
            currentCompanyId = newId;
            newCompanyNameInput.value = ''; // Clear input
            showModal('messageModal', 'Company Added', `"${newName}" has been added with default 1$ = 1 Point logic.`);
            updateAdminDisplays(); // Update current company in admin views
            calculatePoints(); // Recalculate points
        }

        /**
         * Removes the currently selected company from the local simulated database.
         */
        function removeCompany() {
            if (Object.keys(companies).length <= 1) {
                showModal('messageModal', 'Cannot Remove Last Company', 'You must have at least one company in the system.');
                return;
            }

            const selectedId = companySelect.value;
            const companyName = companies[selectedId].name;
            delete companies[selectedId];

            // If the removed company was the current one, select the first available company
            if (currentCompanyId === selectedId) {
                currentCompanyId = Object.keys(companies)[0];
            }
            
            populateCompanySelect();
            showModal('messageModal', 'Company Removed', `"${companyName}" has been removed.`);
            updateAdminDisplays(); // Update current company in admin views
            calculatePoints(); // Recalculate points
        }

        /**
         * Updates the display fields in admin sections based on the currently selected company.
         */
        function updateAdminDisplays() {
            const selectedCompany = companies[currentCompanyId];
            if (selectedCompany) {
                pointsPerDollarInput.value = selectedCompany.pointsPerDollar.toFixed(1);
                currentCompanyDisplay.textContent = selectedCompany.name; // Update company name in Point Calculation box
            } else {
                pointsPerDollarInput.value = '1.0'; // Default if no company selected
                currentCompanyDisplay.textContent = 'N/A';
            }
            // Reward logic is global in this client-side version, so no need to fetch per company
            rewardThresholdInput.value = currentRewardThreshold;
            rewardValueInput.value = currentRewardValue;
        }

        // --- Core Logic Functions ---

        /**
         * Calculates the total cost and points earned based on current food items.
         */
        function calculatePoints() {
            let totalCost = 0;
            document.querySelectorAll('.food-price').forEach(input => {
                const price = parseFloat(input.value);
                if (!isNaN(price) && price > 0) {
                    totalCost += price;
                }
            });

            // Use the pointsPerDollar of the currently selected company
            const pointsPerDollar = companies[currentCompanyId]?.pointsPerDollar || 1; // Default to 1 if not found
            const pointsEarned = totalCost * pointsPerDollar;

            totalCostSpan.textContent = `$${totalCost.toFixed(2)}`;
            pointsEarnedSpan.textContent = `${pointsEarned.toFixed(0)} Points`;
        }

        /**
         * Adds a new food item input row to the order.
         */
        function addFoodItem() {
            foodItemCounter++;
            const newItemHtml = `
                <div class="flex flex-col sm:flex-row gap-4 mb-4 items-center food-item-row" data-id="${foodItemCounter}">
                    <div class="flex-grow w-full">
                        <label for="foodName${foodItemCounter}" class="block text-gray-700 text-sm font-medium mb-2">Food Item:</label>
                        <input type="text" id="foodName${foodItemCounter}" placeholder="e.g., Food ${foodItemCounter}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 transition duration-200 ease-in-out food-name">
                    </div>
                    <div class="w-full sm:w-32">
                        <label for="foodPrice${foodItemCounter}" class="block text-gray-700 text-sm font-medium mb-2">Price ($):</label>
                        <input type="number" id="foodPrice${foodItemCounter}" placeholder="0.00" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 transition duration-200 ease-in-out food-price" step="0.01" min="0">
                    </div>
                    <button class="remove-item-btn mt-6 sm:mt-0 bg-red-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-red-600 transition duration-300 ease-in-out shadow-md hover:shadow-lg flex-shrink-0">
                        Remove
                    </button>
                </div>
            `;
            foodItemsContainer.insertAdjacentHTML('beforeend', newItemHtml);
            // Attach event listener to the new price input
            document.getElementById(`foodPrice${foodItemCounter}`).addEventListener('input', calculatePoints);
            // Attach event listener to the new remove button
            document.querySelector(`.food-item-row[data-id="${foodItemCounter}"] .remove-item-btn`).addEventListener('click', function() {
                this.closest('.food-item-row').remove();
                calculatePoints(); // Recalculate after removing
            });
        }

        /**
         * Simulates checking if a customer exists or is a member.
         * This is purely client-side simulation.
         */
        function checkCustomer() {
            const customerId = customerIdInput.value.trim();
            customerStatusP.className = 'mt-4 text-center text-lg font-medium'; // Reset classes

            if (!customerId) {
                showModal('messageModal', 'Input Required', 'Please enter customer ID, name, phone, or email.');
                customerStatusP.classList.add('text-red-600');
                customerIsMember = false;
                return;
            }

            customerStatusP.textContent = 'Checking customer...';
            customerStatusP.classList.add('text-gray-500');

            setTimeout(() => {
                // Simple dummy logic for demonstration
                if (customerId.toLowerCase().includes('member') || customerId.toLowerCase().includes('john') || customerId.includes('123') || customerId.includes('@')) {
                    customerIsMember = true;
                    customerStatusP.textContent = `Customer "${customerId}" found! Member since 2020.`;
                    customerStatusP.classList.add('text-green-600');
                } else if (customerId.toLowerCase().includes('new')) {
                    customerIsMember = false;
                    customerStatusP.textContent = `Customer "${customerId}" is a new customer.`;
                    customerStatusP.classList.add('text-blue-600');
                } else {
                    customerIsMember = false;
                    customerStatusP.textContent = `Customer "${customerId}" not found in database.`;
                    customerStatusP.classList.add('text-red-600');
                }
            }, 1000);
        }

        /**
         * Handles the order processing and confirmation.
         */
        function processOrder() {
            const totalCost = parseFloat(totalCostSpan.textContent.replace('$', ''));
            const pointsEarned = parseFloat(pointsEarnedSpan.textContent.replace(' Points', ''));
            const customerId = customerIdInput.value.trim();

            if (!customerId) {
                showModal('messageModal', 'Customer Required', 'Please check or enter a customer ID, name, phone, or email before processing the order.');
                return;
            }

            if (totalCost <= 0) {
                showModal('messageModal', 'Empty Order', 'Please add food items with valid prices to the order.');
                return;
            }

            let confirmationText = `Are you sure you want to process this order for "${customerId}"?\n\n`;
            confirmationText += `Total Cost: $${totalCost.toFixed(2)}\n`;
            confirmationText += `Points Earned: ${pointsEarned.toFixed(0)} Points\n`;

            if (customerIsMember && pointsEarned >= currentRewardThreshold) {
                confirmationText += `\nThis customer is eligible for a $${currentRewardValue} reward!`;
            } else if (customerIsMember) {
                confirmationText += `\nCustomer is a member.`;
            } else {
                confirmationText += `\nCustomer is not a member.`;
            }

            confirmMessage.textContent = confirmationText;
            showModal('confirmationModal');
        }

        /**
         * Clears all order details and customer status.
         */
        function clearOrder() {
            foodItemsContainer.innerHTML = ''; // Clear all food items
            foodItemCounter = 0; // Reset counter
            addFoodItem(); // Add one initial empty row
            customerIdInput.value = '';
            customerStatusP.textContent = '';
            customerStatusP.className = 'mt-4 text-center text-lg font-medium'; // Reset classes
            customerIsMember = false;
            calculatePoints(); // Recalculate to show 0
            showModal('messageModal', 'Order Cleared', 'All order details have been cleared.');
        }

        /**
         * Handles change in company selection.
         */
        function onCompanySelectChange() {
            currentCompanyId = companySelect.value;
            updateAdminDisplays();
            calculatePoints();
        }

        /**
         * Saves the point calculation logic for the *currently selected company* locally.
         */
        function savePointsLogic() {
            const newPointsPerDollar = parseFloat(pointsPerDollarInput.value);
            if (isNaN(newPointsPerDollar) || newPointsPerDollar <= 0) {
                showModal('messageModal', 'Invalid Input', 'Please enter a valid positive number for Points per Dollar.');
                return;
            }

            // Update local companies object with the new data
            companies[currentCompanyId].pointsPerDollar = newPointsPerDollar;
            populateCompanySelect(); // Re-populate to update the displayed rate in the dropdown
            showModal('messageModal', 'Settings Saved', `Point calculation logic for "${companies[currentCompanyId].name}" updated to ${newPointsPerDollar}$ = 1 Point.`);
            calculatePoints(); // Recalculate points with the newly saved rate
        }

        /**
         * Saves the reward logic locally.
         */
        function saveRewardLogic() {
            const newRewardThreshold = parseFloat(rewardThresholdInput.value);
            const newRewardValue = parseFloat(rewardValueInput.value);

            if (isNaN(newRewardThreshold) || newRewardThreshold <= 0 || isNaN(newRewardValue) || newRewardValue <= 0) {
                showModal('messageModal', 'Invalid Input', 'Please enter valid positive numbers for Reward Threshold and Reward Value.');
                return;
            }

            currentRewardThreshold = newRewardThreshold;
            currentRewardValue = newRewardValue;
            showModal('messageModal', 'Settings Saved', 'Reward logic updated successfully.');
        }


        // --- Event Listeners ---
        addFoodItemBtn.addEventListener('click', addFoodItem);
        checkCustomerBtn.addEventListener('click', checkCustomer);
        clearOrderBtn.addEventListener('click', clearOrder);
        
        companySelect.addEventListener('change', onCompanySelectChange);
        addCompanyBtn.addEventListener('click', addCompany);
        removeCompanyBtn.addEventListener('click', removeCompany);

        pointsPerDollarInput.addEventListener('input', calculatePoints); // Recalculate on input change
        savePointsLogicBtn.addEventListener('click', savePointsLogic);
        saveRewardLogicBtn.addEventListener('click', saveRewardLogic);


        // Initial setup for the first food item and dynamic listeners
        document.addEventListener('DOMContentLoaded', () => {
            // Populate companies and set initial selected company
            populateCompanySelect();
            
            // Add the first food item row. The event listeners for its price input and remove button
            // are attached within the addFoodItem function itself.
            addFoodItem();

            // Initial display update
            updateAdminDisplays();
            calculatePoints();

            // Handle confirmation modal buttons
            confirmYesBtn.addEventListener('click', () => {
                const totalCost = parseFloat(totalCostSpan.textContent.replace('$', ''));
                const pointsEarned = parseFloat(pointsEarnedSpan.textContent.replace(' Points', ''));
                const customerId = customerIdInput.value.trim();

                let finalMessage = `Order for "${customerId}" processed successfully!\n\n`;
                finalMessage += `Total Cost: $${totalCost.toFixed(2)}\n`;
                finalMessage += `Points Awarded: ${pointsEarned.toFixed(0)} Points`;

                if (customerIsMember && pointsEarned >= currentRewardThreshold) {
                    finalMessage += `\nCustomer is eligible for a $${currentRewardValue} reward! Please apply.`;
                }

                closeModal('confirmationModal');
                showModal('messageModal', 'Order Processed!', finalMessage);
                clearOrder(); // Clear the order after successful processing
            });

            confirmNoBtn.addEventListener('click', () => {
                closeModal('confirmationModal');
                showModal('messageModal', 'Order Cancelled', 'Order processing has been cancelled.');
            });
        });
    </script>
</body>
</html>
