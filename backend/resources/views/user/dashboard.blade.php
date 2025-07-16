@extends('user.layouts.layout')

@section('title', 'Reward Plugin System - Dashboard')

@section('content')


<h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Welcome, {{ Auth::guard('user')->user()->user_name }}👋</h1>

<!-- User Information and Points Balance -->
<div class="w-[80%] mx-auto">
    <div class="bg-gradient-to-r from-purple-600 to-indigo-700 text-white p-6 rounded-lg shadow-md mb-8 flex flex-col md:flex-row items-center justify-between">
        <div class="flex items-center mb-4 md:mb-0">
            <img 
                src="{{ Auth::guard('user')->user()->profile_image 
                    ? asset('storage/' . Auth::guard('user')->user()->profile_image) 
                    : 'https://placehold.co/60x60/8B5CF6/FFFFFF?text=U' }}" 
                alt="User Profile" 
                class="w-16 h-16 rounded-full border-2 border-white mr-4 object-cover"
            >
            <div>
                <p class="text-xl font-semibold">{{ Auth::guard('user')->user()->user_name }}</p>
                <p class="text-sm opacity-90">{{ Auth::guard('user')->user()->user_email }}</p>
                <p class="text-sm text-gray-300 mt-1">Company: {{ Auth::guard('user')->user()->company->company_name ?? 'N/A' }}</p>
            </div>
        </div>
        <div class="text-right">
            <span class="text-3xl font-bold">
                Your Points: <span id="user-points">{{ Auth::guard('user')->user()->points ?? 0 }}</span>
            </span>
            <p class="text-sm opacity-90 mt-1">Points available for redemption</p>
        </div>
    </div>

    <!-- Quick Links Section -->
    <section class="mb-10">
        <h2 class="text-3xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- if u free do it -->

            <!-- <a href="{{ route('rewards.redeem') }}" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 text-center border border-gray-200">
                <div class="text-purple-600 mb-3">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.503 4.618a1 1 0 00.95.691h4.862c.969 0 1.371 1.24.588 1.81l-3.937 2.863a1 1 0 00-.364 1.118l1.503 4.618c.3.921-.755 1.688-1.539 1.118l-3.937-2.863a1 1 0 00-1.176 0l-3.937 2.863c-.784.57-1.838-.197-1.539-1.118l1.503-4.618a1 1 0 00-.364-1.118L2.05 10.046c-.783-.57-.381-1.81.588-1.81h4.862a1 1 0 00.95-.691l1.503-4.618z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">View Points</h3>
                <p class="text-gray-600 text-sm mt-1">See your full transaction history</p>
            </a> -->
            <a href="{{ route('rewards.redeem') }}" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 text-center border border-gray-200">
                <div class="text-indigo-600 mb-3">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.592 1L21 12h-3.812c-.669 0-1.309.298-1.764.81l-1.686 1.988c-.352.413-.853.622-1.353.622H12l-1.353-.622c-.5-.195-1-.404-1.352-.622L5.812 12H2l-.592-.592C2.92 8.402 3.89 8 5 8h2.082A1 1 0 008 7.21V5.79c0-.427-.42-.773-.94-.773H5c-1.11 0-2.08.402-2.592 1L2 6.592V12h3.812c.669 0 1.309-.298 1.764-.81l1.686-1.988c.352-.413.853-.622 1.353-.622H12z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Redeem Rewards</h3>
                <p class="text-gray-600 text-sm mt-1">Exchange points for exciting rewards</p>
            </a>
            <a href="{{ route('user.history') }}" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 text-center border border-gray-200">
                <div class="text-green-600 mb-3">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Redemption History</h3>
                <p class="text-gray-600 text-sm mt-1">Review your past reward claims</p>
            </a>
        </div>
    </section>

    <!-- Recent Activity Section -->
    <section>
        <h2 class="text-3xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">Recent Activity</h2>
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <ul class="divide-y divide-gray-200">
                <li class="py-4 flex justify-between items-center">
                    <div>
                        <p class="text-gray-800 font-medium">Earned 50 points for completing a survey</p>
                        <span class="text-sm text-gray-500">2 hours ago</span>
                    </div>
                    <span class="text-green-600 font-bold">+50</span>
                </li>
                <li class="py-4 flex justify-between items-center">
                    <div>
                        <p class="text-gray-800 font-medium">Redeemed "Exclusive Discount Voucher"</p>
                        <span class="text-sm text-gray-500">Yesterday</span>
                    </div>
                    <span class="text-red-600 font-bold">-500</span>
                </li>
                <li class="py-4 flex justify-between items-center">
                    <div>
                        <p class="text-gray-800 font-medium">Earned 100 points for a new referral</p>
                        <span class="text-sm text-gray-500">3 days ago</span>
                    </div>
                    <span class="text-green-600 font-bold">+100</span>
                </li>
                <li class="py-4 flex justify-between items-center">
                    <div>
                        <p class="text-gray-800 font-medium">Redeemed "Premium Content Access"</p>
                        <span class="text-sm text-gray-500">1 week ago</span>
                    </div>
                    <span class="text-red-600 font-bold">-800</span>
                </li>
            </ul>
            <div class="text-center mt-6">
                <a href="#" class="text-purple-600 hover:text-purple-500 font-medium">View All Activity</a>
            </div>
        </div>
    </section>
</div>


@endsection
