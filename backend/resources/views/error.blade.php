<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Plugin System - Error</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for the Inter font and general body styling */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5; /* Light gray background */
            display: flex;
            justify-content: center;
            align-items: center; /* Center content vertically */
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

        /* Basic modal styling (kept for consistency, though not directly used on this page) */
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

    <!-- Main container for the Error Page content -->
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-md w-full text-center">
        <!-- Navigation Menu (simplified for error page) -->
        <nav class="flex justify-center items-center mb-10 pb-4 border-b border-gray-200">
            <div class="text-2xl font-extrabold text-purple-700">Reward System</div>
        </nav>

        <h1 class="text-6xl font-extrabold text-gray-800 mb-4">404</h1>
        <h2 class="text-3xl font-bold text-gray-700 mb-6">Page Not Found</h2>
        <p class="text-lg text-gray-700 mb-8">
            Oops! The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
        </p>
        <p class="text-md text-gray-600 mb-10">
            If you believe this is an error, please contact support.
        </p>

        <div class="flex justify-center space-x-4">
            <a href="/" class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold shadow-md hover:bg-purple-700 transition duration-300">
                Go to Home
            </a>
            <button onclick="window.history.back()" class="border-2 border-purple-600 text-purple-600 px-6 py-3 rounded-md font-semibold hover:bg-purple-50 hover:text-purple-700 transition duration-300">
                Go Back
            </button>
        </div>
    </div>

    <!-- The Modal for messages (kept for consistency) -->
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

        // You could dynamically change the error code/message based on actual server response
        // For example, if it's a 500 error:
        // document.getElementById('error-code').textContent = '500';
        // document.getElementById('error-heading').textContent = 'Internal Server Error';
        // document.getElementById('error-message').textContent = 'Something went wrong on our end. Please try again later.';
    </script>
</body>
</html>

