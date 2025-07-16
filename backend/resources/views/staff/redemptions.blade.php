@extends('staff.layouts.layout')

@section('title', 'Reward Plugin System - Redemption Requests')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-xl shadow-lg max-w-5xl w-full">

    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Review Redemptions ✅</h1>

    <section class="mb-10">
        <h2 class="text-2xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">Pending Approvals</h2>

        @if($redemptions->isEmpty())
            <div class="text-center text-gray-500 italic">No pending redemptions at the moment.</div>
        @else
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">User</th>
                            <th class="px-4 py-3 text-left">Reward</th>
                            <th class="px-4 py-3 text-center">Points</th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-sm text-gray-700">
                        @foreach($redemptions as $index => $redemption)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $redemption->user->user_name }}</td>
                                <td class="px-4 py-3">{{ $redemption->reward->reward_name }}</td>
                                <td class="px-4 py-3 text-center">{{ $redemption->point_spent }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($redemption->created_at)->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        <form action="{{ route('staff.redemptions.approve', $redemption->red_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-semibold">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('staff.redemptions.reject', $redemption->red_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-semibold">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

    <div class="text-center mt-6">
        <a href="/staff/dashboard" class="text-purple-600 hover:text-purple-500 font-medium">Back to Staff Dashboard</a>
    </div>
</div>
@endsection
