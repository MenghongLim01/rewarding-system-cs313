<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Plugin System - Home</title>
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

        /* Basic modal styling (kept for potential future use, though not directly used on home page) */
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

    <!-- Main container for the Home Page content -->
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-4xl w-full">
        <!-- Navigation Menu -->
        <nav class="flex justify-between items-center mb-10 pb-4 border-b border-gray-200">
            <div class="text-2xl font-extrabold text-purple-700">Point Trick</div>
            <ul class="flex space-x-6">
                <li><a href="/" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Home</a></li>
                <li><a href="/login" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Login</a></li>
                <li><a href="/register" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Register</a></li>
                <li><a href="/about" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">About</a></li>
                <li><a href="/help" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Help</a></li>
            </ul>
        </nav>

        <!-- Hero Section -->
        <section class="text-center py-16 bg-gradient-to-br from-purple-500 to-indigo-600 text-white rounded-lg shadow-xl mb-12">
            <h1 class="text-5xl font-extrabold leading-tight mb-6">
                Unlock Exclusive Rewards with Our Plugin System!
            </h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Integrate seamlessly, earn points effortlessly, and redeem amazing rewards.
                Empower your users and grow your platform with our flexible reward solution.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="/register" class="bg-white text-purple-700 px-8 py-4 rounded-full font-bold text-lg shadow-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                    Get Started Now
                </a>
                <a href="/login" class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg hover:bg-purple-700 hover:border-purple-700 transition duration-300 transform hover:scale-105">
                    Already a Member? Log In
                </a>
            </div>
        </section>

        <!-- Key Features Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Key Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg shadow-md text-center border border-gray-200">
                    <div class="text-purple-600 mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Seamless Integration</h3>
                    <p class="text-gray-600">Easily add reward functionality to your existing platform as a plugin.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg shadow-md text-center border border-gray-200">
                    <div class="text-indigo-600 mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.503 4.618a1 1 0 00.95.691h4.862c.969 0 1.371 1.24.588 1.81l-3.937 2.863a1 1 0 00-.364 1.118l1.503 4.618c.3.921-.755 1.688-1.539 1.118l-3.937-2.863a1 1 0 00-1.176 0l-3.937 2.863c-.784.57-1.838-.197-1.539-1.118l1.503-4.618a1 1 0 00-.364-1.118L2.05 10.046c-.783-.57-.381-1.81.588-1.81h4.862a1 1 0 00.95-.691l1.503-4.618z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Points Management</h3>
                    <p class="text-gray-600">Users earn points through activities, redeem them, and admins can adjust balances.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg shadow-md text-center border border-gray-200">
                    <div class="text-green-600 mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.592 1L21 12h-3.812c-.669 0-1.309.298-1.764.81l-1.686 1.988c-.352.413-.853.622-1.353.622H12l-1.353-.622c-.5-.195-1-.404-1.352-.622L5.812 12H2l-.592-.592C2.92 8.402 3.89 8 5 8h2.082A1 1 0 008 7.21V5.79c0-.427-.42-.773-.94-.773H5c-1.11 0-2.08.402-2.592 1L2 6.592V12h3.812c.669 0 1.309-.298 1.764-.81l1.686-1.988c.352-.413.853-.622 1.353-.622H12z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Reward Redemption</h3>
                    <p class="text-gray-600">Users can easily browse and redeem a variety of rewards using their accumulated points.</p>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="text-center py-10 bg-gray-100 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Ready to Transform Your User Engagement?</h2>
            <p class="text-lg text-gray-700 mb-8 max-w-xl mx-auto">
                Join thousands of businesses enhancing their platforms with our intuitive and powerful reward system.
            </p>
            <a href="/register" class="bg-purple-600 text-white px-10 py-4 rounded-full font-bold text-xl shadow-lg hover:bg-purple-700 transition duration-300 transform hover:scale-105">
                Sign Up Today!
            </a>
        </section>
    </div>

    <!-- The Modal (kept for consistency, not used on this page) -->
    <div id="rewardModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">&times;</span>
            <h2 id="modal-title" class="text-2xl font-bold text-gray-800 mb-4"></h2>
            <p id="modal-message" class="text-gray-700 mb-6"></p>
            <button class="bg-purple-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-purple-700 transition duration-300" onclick="closeModal()">Got It!</button>
        </div>
    </div>

    <script>
        // Modal functions (kept for consistency, not used on this page)
        const rewardModal = document.getElementById('rewardModal');
        const modalTitle = document.getElementById('modal-title');
        const modalMessage = document.getElementById('modal-message');

        function openModal(title, message) {
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            rewardModal.style.display = 'flex';
        }

        function closeModal() {
            rewardModal.style.display = 'none';
        }

        window.addEventListener('click', (event) => {
            if (event.target == rewardModal) {
                closeModal();
            }
        });
    </script>
</body>
</html>

