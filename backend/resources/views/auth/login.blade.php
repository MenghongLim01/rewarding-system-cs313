<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Plugin System - Login</title>
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

    <!-- Main container for the Login Page content -->
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-md w-full">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Login to Your Account</h1>

        <!-- Login Form -->
        <form id="login-form" class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email or Username</label>
                <input type="text" id="email" name="email" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            <div class="flex items-center justify-between">
                <div class="text-sm">
                    <a href="/forgot-password" class="font-medium text-purple-600 hover:text-purple-500">Forgot your password?</a>
                </div>
            </div>
            <div>
                <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-lg font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-300">
                    Sign In
                </button>
            </div>
        </form>

        <!-- SSO Integration (Optional) -->
        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or continue with</span>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-3">
                <div>
                    <button type="button"
                            class="w-full flex items-center justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-300">
                        <img src="https://www.svgrepo.com/show/303108/google-icon-logo.svg" class="h-5 w-5 mr-2" alt="Google icon">
                        Sign in with Google
                    </button>
                </div>
                <!-- Add more SSO options as needed -->
            </div>
        </div>

        <!-- Registration Link -->
        <div class="mt-8 text-center text-sm text-gray-600">
            Don't have an account?
            <a href="/register" class="font-medium text-purple-600 hover:text-purple-500">Register here</a>
        </div>
    </div>

    <!-- The Modal for error/success messages -->
    <div id="rewardModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">&times;</span>
            <h2 id="modal-title" class="text-2xl font-bold text-gray-800 mb-4"></h2>
            <p id="modal-message" class="text-gray-700 mb-6"></p>
            <button class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-purple-700 transition duration-300" onclick="closeModal()">Got It!</button>
        </div>
    </div>

    <script>
        // Get elements
        const loginForm = document.getElementById('login-form');
        const rewardModal = document.getElementById('rewardModal');
        const modalTitle = document.getElementById('modal-title');
        const modalMessage = document.getElementById('modal-message');

        // Function to open the modal
        function openModal(title, message) {
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            rewardModal.style.display = 'flex'; // Use flex to center content
        }

        // Function to close the modal
        function closeModal() {
            rewardModal.style.display = 'none';
        }

        // Handle form submission
        loginForm.addEventListener('submit', (event) => {
            event.preventDefault(); // Prevent default form submission

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Basic validation (replace with actual authentication logic)
            if (email === '' || password === '') {
                openModal('Login Error', 'Please enter both email/username and password.');
            } else {
                // In a real application, you would send this data to your backend for authentication.
                // For demonstration, we'll simulate a successful login.
                console.log('Attempting to log in with:', { email, password });
                openModal('Login Successful!', 'You have been logged in. Redirecting to dashboard...');
                // Simulate redirection after a short delay
                setTimeout(() => {
                    window.location.href = '/dashboard'; // Redirect to dashboard
                }, 1500);
            }
        });

        // Close modal when clicking outside of it
        window.addEventListener('click', (event) => {
            if (event.target == rewardModal) {
                closeModal();
            }
        });
    </script>
</body>
</html>

