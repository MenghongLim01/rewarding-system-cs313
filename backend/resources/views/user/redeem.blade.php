@extends('user.layouts.layout')

@section('title', 'Redeem Rewards')

@section('content')
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
                <!-- <p class="text-sm opacity-90">{{ Auth::guard('user')->user()->user_email }}</p> -->
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

<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-12">Redeem Your Rewards 🎁</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        {{-- Static reward cards --}}
       @foreach($rewards as $reward)
<div class="bg-white p-6 rounded-xl shadow-md flex flex-col items-center text-center border hover:shadow-xl transition duration-300">
    <img src="{{ asset('storage/' . $reward->reward_image) }}"
         alt="Reward Image"
         class="w-50 h-30 mb-6 object-cover rounded shadow-md" style="width: 350px; height: 200px; object-fit: cover;"/>

    <div class="mb-4">
        <p class="font-semibold text-gray-800">{{ $reward->reward_name }}</p>
        <p class="text-sm text-gray-600">{{ $reward->reward_desc }}</p>
        <p class="text-sm text-gray-600" style="color:red">Require: {{ $reward->point_required}} points</p>
    </div>

   <button
    onclick="openRedeemModal(
        '{{ $reward->reward_name }}',
        '{{ $reward->reward_desc }}',
        '{{ $reward->point_required }}',
        '{{ asset('storage/' . $reward->reward_image) }}'
    )"
    class="border border-purple-600 text-purple-600 px-4 py-1 rounded-full text-sm font-medium hover:bg-purple-600 hover:text-white transition duration-200">
    Redeem Now
</button>
</div>
@endforeach
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
                <p class="text-sm mt-2"><span class="font-medium text-gray-800">Points Required:</span> <span id="modal-points" class="text-purple-600 font-semibold"></span></p>
            </div>
        </div>

        <div class="mt-6 text-right">
            <button class="bg-purple-600 text-white px-4 py-2 rounded font-semibold hover:bg-purple-700 transition duration-300">
                Redeem Now
            </button>
        </div>
    </div>
</div>


@push('scripts')
<script>
    function openRedeemModal(name, description, points, imageUrl) {
        document.getElementById('modal-name').textContent = name;
        document.getElementById('modal-description').textContent = description;
        document.getElementById('modal-points').textContent = points + ' pts';
        document.getElementById('modal-img').src = imageUrl;
        document.getElementById('redeemModal').classList.remove('hidden');
    }

    function closeRedeemModal() {
        document.getElementById('redeemModal').classList.add('hidden');
    }
</script>
@endpush



@endsection
