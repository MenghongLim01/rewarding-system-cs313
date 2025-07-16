@extends('user.layouts.layout')

@section('title', 'Redeem Rewards')

@section('content')
@php
    $user = auth()->guard('user')->user();
@endphp

<div class="w-[80%] mx-auto">
    <!-- Flash Messages -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 border border-red-300 p-4 rounded mb-6">
            <ul class="list-disc pl-5 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success mb-4 text-green-700 bg-green-100 p-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-700 text-white p-6 rounded-lg shadow-md mb-8 flex flex-col md:flex-row items-center justify-between">
        <div class="flex items-center mb-4 md:mb-0">
            <img 
                src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://placehold.co/60x60/8B5CF6/FFFFFF?text=U' }}" 
                alt="User Profile" 
                class="w-16 h-16 rounded-full border-2 border-white mr-4 object-cover">
            <div>
                <p class="text-xl font-semibold">{{ $user->user_name }}</p>
                <p class="text-sm text-gray-300 mt-1">Company: {{ $user->company->company_name ?? 'N/A' }}</p>
            </div>
        </div>
        <div class="text-right">
            <span class="text-3xl font-bold">Your Points: <span id="user-points">{{ $user->points ?? 0 }}</span></span>
            <p class="text-sm opacity-90 mt-1">Points available for redemption</p>
        </div>
    </div>

    <!-- Rewards -->
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-12">Redeem Your Rewards 🎁</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($rewards as $reward)
                @if($reward->reward_stock > 0)
                    <div class="bg-white p-6 rounded-xl shadow-md flex flex-col items-center text-center border hover:shadow-xl transition duration-300">
                        <img src="{{ asset('storage/' . $reward->reward_image) }}"
                            alt="Reward Image"
                            class="w-[350px] h-[200px] mb-6 object-cover rounded shadow-md" />

                        <div class="mb-4">
                            <p class="font-semibold text-gray-800">{{ $reward->reward_name }}</p>
                            <p class="text-sm text-gray-600">{{ $reward->reward_desc }}</p>
                            <p class="text-sm text-gray-600">Available Stocks: {{ $reward->reward_stock }}</p>
                            <p class="text-sm text-red-600">Require: {{ $reward->point_required }} points</p>
                        </div>

                        <button
                            onclick="openRedeemModal(
                                '{{ $reward->reward_name }}',
                                '{{ $reward->reward_desc }}',
                                '{{ $reward->point_required }}',
                                '{{ asset('storage/' . $reward->reward_image) }}',
                                '{{ $reward->reward_id }}'
                            )"
                            class="border border-purple-600 text-purple-600 px-4 py-1 rounded-full text-sm font-medium hover:bg-purple-600 hover:text-white transition duration-200">
                            Redeem Now
                        </button>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<!-- Redeem Modal -->
<div id="redeemModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md relative">
        <button onclick="closeRedeemModal()" class="absolute top-2 right-3 text-gray-500 hover:text-gray-800 text-xl">&times;</button>

        <h2 class="text-2xl font-bold text-purple-700 mb-4">Confirm Reward Redemption</h2>

        <div class="flex gap-4 items-start">
            <img id="modal-img" src="" alt="Reward Image" class="w-20 h-20 rounded shadow">
            <div>
                <p id="modal-name" class="font-semibold text-gray-800 text-lg"></p>
                <p id="modal-description" class="text-sm text-gray-600 mt-1"></p>
                <p class="text-sm text-gray-600">Available Stock: {{ $reward->reward_stock }}</p>
                <p class="text-sm mt-2"><span class="font-medium text-gray-800">Points Required:</span> <span id="modal-points" class="text-purple-600 font-semibold"></span></p>
            </div>
        </div>

        <input type="hidden" id="modal-reward-id">

        <div class="mt-6 text-right">
            <button id="confirmRedeemBtn" class="bg-purple-600 text-white px-4 py-2 rounded font-semibold hover:bg-purple-700 transition duration-300">
                Redeem Now
            </button>
        </div>
    </div>
</div>

<!-- Notification Box -->
<div id="notificationBox" class="fixed top-6 right-6 z-50 hidden p-4 rounded-lg shadow-lg text-white text-sm font-medium"></div>

@push('scripts')
<script>
    function openRedeemModal(name, description, points, imageUrl, rewardId) {
        document.getElementById('modal-name').textContent = name;
        document.getElementById('modal-description').textContent = description;
        document.getElementById('modal-points').textContent = points + ' pts';
        document.getElementById('modal-img').src = imageUrl;
        document.getElementById('modal-reward-id').value = rewardId;
        document.getElementById('redeemModal').classList.remove('hidden');
    }

    function closeRedeemModal() {
        document.getElementById('redeemModal').classList.add('hidden');
    }

    function showNotification(message, type = 'success') {
        const box = document.getElementById('notificationBox');
        box.textContent = message;
        box.className = 'fixed top-6 right-6 z-50 p-4 rounded-lg shadow-lg text-white text-sm font-medium';

        if (type === 'success') {
            box.classList.add('bg-green-500');
        } else {
            box.classList.add('bg-red-500');
        }

        box.classList.remove('hidden');

        setTimeout(() => {
            box.classList.add('hidden');
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('confirmRedeemBtn').addEventListener('click', function () {
            const rewardId = document.getElementById('modal-reward-id').value;

            if (!rewardId) {
                showNotification('Reward ID is missing. Please try again.', 'error');
                return;
            }

            fetch("{{ route('user.rewards.redeem') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ reward_id: rewardId })
            })
            .then(async response => {
                let data;
                try {
                    data = await response.json();
                } catch (e) {
                    showNotification('Server error or invalid response.', 'error');
                    return;
                }

                if (response.ok && data.status === 'success') {
                    showNotification(data.message, 'success');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showNotification(data.message || 'Redemption failed.', 'error');
                }
            })
            .catch(error => {
                console.error(error);
                showNotification('Network error. Please try again.', 'error');
            });
        });
    });
</script>
@endpush

@endsection
