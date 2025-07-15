@extends('user.layouts.layout')

@section('title', 'Redeem Rewards')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-12">Redeem Your Rewards 🎁</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        {{-- Static reward cards --}}
        @for($i = 0; $i < 6; $i++)
        <div class="bg-white p-6 rounded-xl shadow-md flex flex-col items-center text-center border hover:shadow-xl transition duration-300">
            <!-- Static image placeholder (yellow box) -->
            <img src="https://via.placeholder.com/96x96.png?text=Img" alt="Reward Image"
                 class="w-24 h-24 mb-6 object-cover rounded shadow-md">

            <!-- Reward Info -->
            <div class="mb-4">
                <p class="font-semibold text-gray-800">Reward Name {{ $i + 1 }}</p>
                <p class="text-sm text-gray-600">Brief description of the reward goes here.</p>
                <p class="text-sm text-gray-600">Redeem for 500 pts</p>
            </div>

            <!-- Redeem Button -->
            <button
                onclick="openRedeemModal('Reward Name {{ $i + 1 }}', 'Brief description of the reward goes here.', 500)"
                class="border border-purple-600 text-purple-600 px-4 py-1 rounded-full text-sm font-medium hover:bg-purple-600 hover:text-white transition duration-200">
                Redeem Now
            </button>

        </div>
        @endfor
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
    function openRedeemModal(name, description, points) {
        document.getElementById('modal-name').textContent = name;
        document.getElementById('modal-description').textContent = description;
        document.getElementById('modal-points').textContent = points + ' pts';
        document.getElementById('modal-img').src = 'https://via.placeholder.com/96x96.png?text=Img';
        document.getElementById('redeemModal').classList.remove('hidden');
    }

    function closeRedeemModal() {
        document.getElementById('redeemModal').classList.add('hidden');
    }
</script>
@endpush



@endsection
