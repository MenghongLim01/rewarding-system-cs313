@extends('admin.layouts.layout')

@section('title', 'Reward Details')

@section('content')

<div class="w-[100px] h-[150px] mx-auto mt-8 p-0 bg-transparent rounded-none text-sm">
    <h1 class="text-base font-semibold text-center text-gray-800 mb-3">Reward Details</h1>

    <!-- Reward Image -->
    <div class="flex justify-center mb-2">
        @if ($reward->reward_image)
            <img src="{{ asset('storage/' . $reward->reward_image) }}"
                 alt="{{ $reward->reward_name }}"
                 class="w-20 h-20 object-contain" />
        @else
            <div class="w-20 h-20 bg-gray-100 flex items-center justify-center text-gray-400 text-xs">
                No Image
            </div>
        @endif
    </div>

    <!-- Reward Info -->
    <div class="space-y-[2px] text-[12px] leading-4 text-gray-800">
        <p><strong>Reward:</strong> {{ $reward->reward_name }}</p>
        <p><strong>Desc:</strong> {{ $reward->reward_desc }}</p>
        <p><strong>Stock:</strong> {{ $reward->reward_stock }}</p>
        <p><strong>Points:</strong> {{ $reward->point_required }}</p>
        <p><strong>Company:</strong> {{ optional($reward->company)->company_name ?? 'N/A' }}</p>
    </div>

     <div class="mt-4 text-center">
        <a href="{{ route('admin.reward.index') }}" class="btn btn-primary bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 transition duration-300">Back to Rewards List</a>
    </div>
</div>

@endsection
