<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Plugin System - Register</title>
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

    <!-- Main container for the Register Page content -->
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-md w-full">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Create Your Account</h1>

        <!-- Registration Form -->
        <form id="register-form" class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" id="name" name="name" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" id="email" name="email" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            <div>
                <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            
            <div>
                <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Select Company</label>
                <select id="company" name="company" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                    <option value="" disabled selected>-- Choose a company --</option>
                    <option value="Phka Blush">Phka Blush</option>
                    <option value="Siem Reap Tech">Siem Reap Tech</option>
                    <option value="Angkor Craft">Angkor Craft</option>
                </select>
            </div>


            <div class="flex items-center">
                <input id="terms-checkbox" name="terms-checkbox" type="checkbox" required
                       class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                <label for="terms-checkbox" class="ml-2 block text-sm text-gray-900">
                    I agree to the <a href="/terms" class="font-medium text-purple-600 hover:text-purple-500">Terms and Conditions</a> and <a href="/privacy-policy" class="font-medium text-purple-600 hover:text-purple-500">Privacy Policy</a>.
                </label>
            </div>
            <div>
                <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-lg font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-300">
                    Register
                </button>
            </div>
        </form>

        <!-- Login Link -->
        <div class="mt-8 text-center text-sm text-gray-600">
            Already have an account?
            <a href="/login" class="font-medium text-purple-600 hover:text-purple-500">Login here</a>
        </div>
    </div>

    <!-- The Modal for error/success messages -->
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

        // Registration Form Logic
        const registerForm = document.getElementById('register-form');

        registerForm.addEventListener('submit', (event) => {
            event.preventDefault(); // Prevent default form submission

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const termsAccepted = document.getElementById('terms-checkbox').checked;

            if (password !== confirmPassword) {
                openModal('messageModal', 'Registration Error', 'Passwords do not match.');
                return;
            }

            if (!termsAccepted) {
                openModal('messageModal', 'Registration Error', 'You must agree to the Terms and Conditions and Privacy Policy.');
                return;
            }

            // Basic email validation (more robust validation should be done on the backend)
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                openModal('messageModal', 'Registration Error', 'Please enter a valid email address.');
                return;
            }

            // In a real application, you would send this data to your backend for user registration.
            console.log('Attempting to register user:', { name, email, password });

            // Simulate successful registration
            openModal('messageModal', 'Registration Successful!', 'Your account has been created. Redirecting to login...');
            setTimeout(() => {
                window.location.href = '/login'; // Redirect to login page
            }, 2000);
        });
    </script>
</body>
</html>

