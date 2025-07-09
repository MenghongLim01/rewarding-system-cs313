<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Plugin System - Terms and Conditions</title>
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

    <!-- Main container for the Terms and Conditions content -->
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-4xl w-full">
        <!-- Navigation Menu -->
        <nav class="flex justify-between items-center mb-10 pb-4 border-b border-gray-200">
            <div class="text-2xl font-extrabold text-purple-700">Reward System</div>
            <ul class="flex space-x-6">
                <li><a href="/" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Home</a></li>
                <li><a href="/login" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Login</a></li>
                <li><a href="/register" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Register</a></li>
                <li><a href="/terms" class="text-purple-600 font-medium transition duration-300">Terms</a></li>
                <li><a href="/privacy-policy" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Privacy</a></li>
            </ul>
        </nav>

        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Terms and Conditions</h1>

        <!-- Terms and Conditions Content -->
        <section class="prose max-w-none text-gray-700 leading-relaxed">
            <p>Welcome to the Reward Plugin System! These Terms and Conditions ("Terms") govern your use of the Reward Plugin System (the "Service") provided by [Your Company Name/Entity Name] ("we," "us," or "our"). By accessing or using the Service, you agree to be bound by these Terms.</p>

            <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">1. Acceptance of Terms</h2>
            <p>By creating an account or using any part of the Service, you acknowledge that you have read, understood, and agree to be bound by these Terms, as well as our Privacy Policy. If you do not agree with any part of these Terms, you must not use the Service.</p>

            <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">2. Changes to Terms</h2>
            <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion. By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.</p>

            <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">3. User Accounts</h2>
            <ul class="list-disc list-inside ml-4">
                <li>You must be at least [Minimum Age, e.g., 13 or 18] years old to use the Service.</li>
                <li>You are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer or device, and you agree to accept responsibility for all activities that occur under your account or password.</li>
                <li>You agree to provide accurate, current, and complete information during the registration process and to update such information to keep it accurate, current, and complete.</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">4. Earning and Redeeming Points</h2>
            <ul class="list-disc list-inside ml-4">
                <li>Points are earned through activities defined by the platform integrating our plugin (e.g., purchases, surveys, referrals). The value and earning methods of points are subject to change at the discretion of the integrating platform.</li>
                <li>Points have no cash value and cannot be exchanged for cash.</li>
                <li>Rewards are subject to availability and may be changed or discontinued at any time without notice.</li>
                <li>Once points are redeemed for a reward, the redemption is final and cannot be reversed.</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">5. Prohibited Conduct</h2>
            <p>You agree not to engage in any of the following prohibited activities:</p>
            <ul class="list-disc list-inside ml-4">
                <li>Using the Service for any illegal purpose or in violation of any local, state, national, or international law.</li>
                <li>Attempting to gain unauthorized access to any portion of the Service or any other accounts, computer systems, or networks connected to the Service.</li>
                <li>Interfering with or disrupting the integrity or performance of the Service or data contained therein.</li>
                <li>Engaging in any activity that could damage, disable, overburden, or impair the Service.</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">6. Intellectual Property</h2>
            <p>The Service and its original content, features, and functionality are and will remain the exclusive property of [Your Company Name/Entity Name] and its licensors. The Service is protected by copyright, trademark, and other laws of both the [Your Country] and foreign countries. Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of [Your Company Name/Entity Name].</p>

            <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">7. Termination</h2>
            <p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms. Upon termination, your right to use the Service will immediately cease.</p>

            <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">8. Disclaimer of Warranties</h2>
            <p>Your use of the Service is at your sole risk. The Service is provided on an "AS IS" and "AS AVAILABLE" basis. The Service is provided without warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, non-infringement or course of performance.</p>

            <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">9. Limitation of Liability</h2>
            <p>In no event shall [Your Company Name/Entity Name], nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from (i) your access to or use of or inability to access or use the Service; (ii) any conduct or content of any third party on the Service; (iii) any content obtained from the Service; and (iv) unauthorized access, use or alteration of your transmissions or content, whether based on warranty, contract, tort (including negligence) or any other legal theory, whether or not we have been informed of the possibility of such damage, and even if a remedy set forth herein is found to have failed of its essential purpose.</p>

            <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">10. Governing Law</h2>
            <p>These Terms shall be governed and construed in accordance with the laws of [Your Country], without regard to its conflict of law provisions.</p>

            <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">11. Contact Us</h2>
            <p>If you have any questions about these Terms, please contact us at [Your Contact Email Address].</p>

            <p class="mt-8 text-sm text-gray-500">Last updated: July 8, 2025</p>
        </section>

        <div class="text-center mt-10">
            <a href="/register" class="text-purple-600 hover:text-purple-500 font-medium">Back to Registration</a>
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
    </script>
</body>
</html>

