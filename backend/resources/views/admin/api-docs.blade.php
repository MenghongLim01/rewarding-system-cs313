<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Plugin System - API Documentation</title>
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

        /* Code block styling */
        pre {
            background-color: #2d2d2d;
            color: #f8f8f2;
            padding: 1rem;
            border-radius: 0.5rem;
            overflow-x: auto;
            font-family: 'Fira Code', 'Cascadia Code', monospace;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        code {
            font-family: 'Fira Code', 'Cascadia Code', monospace;
            background-color: #e2e8f0; /* Tailwind gray-200 */
            padding: 0.2em 0.4em;
            border-radius: 0.25rem;
            color: #333;
        }
    </style>
</head>
<body class="antialiased">

    <!-- Main container for the API Documentation content -->
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-6xl w-full">
        <!-- Navigation Menu -->
        <nav class="flex justify-between items-center mb-10 pb-4 border-b border-gray-200">
            <div class="text-2xl font-extrabold text-purple-700">Reward System</div>
            <ul class="flex space-x-6">
                <li><a href="/" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Home</a></li>
                <li><a href="/login" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Login</a></li>
                <li><a href="/register" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Register</a></li>
                <li><a href="/docs" class="text-purple-600 font-medium transition duration-300">API Docs</a></li>
                <li><a href="/admin/dashboard" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Admin Panel</a></li>
            </ul>
        </nav>

        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">API Documentation 🔗</h1>

        <!-- Introduction to API -->
        <section class="mb-10">
            <p class="text-lg text-gray-700 mb-6">
                Welcome to the Reward Plugin System API documentation. This API allows you to programmatically
                integrate reward functionalities into your applications. You can manage users, points, and rewards
                seamlessly.
            </p>
            <p class="text-lg text-gray-700">
                All API requests should be made to the base URL: <code>https://api.yourrewardsystem.com/v1</code> (placeholder URL).
                Authentication is required for most endpoints using an API key or OAuth token.
            </p>
        </section>

        <!-- API Endpoints Section -->
        <section class="mb-10">
            <h2 class="text-3xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">API Endpoints</h2>

            <!-- Get User Points -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">GET /users/{userId}/points</h3>
                <p class="text-gray-600 mb-4">Retrieve the current points balance for a specific user.</p>
                <p class="font-medium text-gray-700 mb-2">Parameters:</p>
                <ul class="list-disc list-inside text-gray-600 mb-4 ml-4">
                    <li><code>userId</code> (path): The unique identifier of the user.</li>
                </ul>
                <p class="font-medium text-gray-700 mb-2">Example Request:</p>
                <pre><code>GET /users/user123/points
Authorization: Bearer YOUR_API_KEY</code></pre>
                <p class="font-medium text-gray-700 mb-2 mt-4">Example Response (200 OK):</p>
                <pre><code>{
    "userId": "user123",
    "pointsBalance": 1500
}</code></pre>
            </div>

            <!-- Add Points to User -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">POST /users/{userId}/points/add</h3>
                <p class="text-gray-600 mb-4">Add points to a specific user's balance.</p>
                <p class="font-medium text-gray-700 mb-2">Parameters:</p>
                <ul class="list-disc list-inside text-gray-600 mb-4 ml-4">
                    <li><code>userId</code> (path): The unique identifier of the user.</li>
                </ul>
                <p class="font-medium text-gray-700 mb-2">Request Body (application/json):</p>
                <pre><code>{
    "amount": 100,
    "reason": "Completed survey"
}</code></pre>
                <p class="font-medium text-gray-700 mb-2 mt-4">Example Request:</p>
                <pre><code>POST /users/user123/points/add
Content-Type: application/json
Authorization: Bearer YOUR_API_KEY

{
    "amount": 100,
    "reason": "Completed survey"
}</code></pre>
                <p class="font-medium text-gray-700 mb-2 mt-4">Example Response (200 OK):</p>
                <pre><code>{
    "userId": "user123",
    "newPointsBalance": 1600,
    "message": "Points added successfully."
}</code></pre>
            </div>

            <!-- Redeem Reward -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">POST /rewards/redeem</h3>
                <p class="text-gray-600 mb-4">Allow a user to redeem a reward using their points.</p>
                <p class="font-medium text-gray-700 mb-2">Request Body (application/json):</p>
                <pre><code>{
    "userId": "user123",
    "rewardId": "reward_discount_voucher"
}</code></pre>
                <p class="font-medium text-gray-700 mb-2 mt-4">Example Request:</p>
                <pre><code>POST /rewards/redeem
Content-Type: application/json
Authorization: Bearer YOUR_API_KEY

{
    "userId": "user123",
    "rewardId": "reward_discount_voucher"
}</code></pre>
                <p class="font-medium text-gray-700 mb-2 mt-4">Example Response (200 OK - Success):</p>
                <pre><code>{
    "status": "success",
    "message": "Reward redeemed successfully!",
    "rewardName": "Exclusive Discount Voucher",
    "pointsSpent": 500,
    "newPointsBalance": 1100
}</code></pre>
                <p class="font-medium text-gray-700 mb-2 mt-4">Example Response (400 Bad Request - Insufficient Points):</p>
                <pre><code>{
    "status": "error",
    "message": "Insufficient points to redeem this reward."
}</code></pre>
            </div>

            <!-- List All Rewards -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">GET /rewards</h3>
                <p class="text-gray-600 mb-4">Retrieve a list of all available rewards.</p>
                <p class="font-medium text-gray-700 mb-2">Example Request:</p>
                <pre><code>GET /rewards
Authorization: Bearer YOUR_API_KEY</code></pre>
                <p class="font-medium text-gray-700 mb-2 mt-4">Example Response (200 OK):</p>
                <pre><code>[
    {
        "id": "reward_discount_voucher",
        "name": "Exclusive Discount Voucher",
        "description": "Get 20% off your next purchase!",
        "pointsRequired": 500,
        "availableStock": "Unlimited"
    },
    {
        "id": "reward_premium_access",
        "name": "Premium Content Access",
        "description": "Unlock exclusive articles and videos for a month.",
        "pointsRequired": 800,
        "availableStock": 50
    }
]</code></pre>
            </div>

            <!-- Add more API endpoints as needed following this structure -->

        </section>

        <div class="text-center mt-6">
            <a href="/" class="text-purple-600 hover:text-purple-500 font-medium">Back to Home</a>
        </div>
    </div>

    <!-- The Modal for messages (kept for consistency, not directly used by this page's JS) -->
    <div id="messageModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal('messageModal')">&times;</span>
            <h2 id="message-modal-title" class="text-2xl font-bold text-gray-800 mb-4"></h2>
            <p id="message-modal-message" class="text-gray-700 mb-6"></p>
            <button class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-purple-700 transition duration-300" onclick="closeModal('messageModal')">Got It!</button>
        </div>
    </div>

    <script>
        // General Modal functions (kept for consistency)
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
    </script>
</body>
</html>

