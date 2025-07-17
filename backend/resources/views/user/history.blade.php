@extends('user.layouts.layout')

@section('title', 'Reward Plugin System - History')

@section('content')






<div class="w-[80%] mx-auto">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Transaction History 🧾</h1>

    @if ($history->isEmpty())
        <div class="text-center text-gray-500 italic">No transactions found yet.</div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow border rounded-lg">
                <thead class="bg-purple-100 text-purple-800">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase text-sm font-semibold">Date</th>
                        <th class="text-left py-3 px-4 uppercase text-sm font-semibold">Description</th>
                        <th class="text-left py-3 px-4 uppercase text-sm font-semibold">Type</th>
                        <th class="text-left py-3 px-4 uppercase text-sm font-semibold">Points</th>
                        <th class="text-left py-3 px-4 uppercase text-sm font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($history as $entry)
                        <tr>
                            <td class="py-3 px-4 text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($entry['timestamp'])->diffForHumans() }}
                            </td>
                            <td class="py-3 px-4 text-sm font-medium">
                                {{ $entry['type'] === 'earn' ? 'Earned Points from Purchase' : $entry['title'] }}
                            </td>
                            <td class="py-3 px-4 text-sm">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold">
                                    
                                    {{ ucfirst($entry['type']) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-sm font-bold {{ $entry['points'] > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $entry['points'] > 0 ? '+' : '' }}{{ $entry['points'] }} pts
                            </td>
                            <td class="py-3 px-4 text-sm">
                                @if(isset($entry['status']))
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        {{
                                            $entry['status'] === 'approved' ? 'bg-green-200 text-green-800' :
                                            ($entry['status'] === 'pending' ? 'bg-yellow-200 text-yellow-800' :
                                            ($entry['status'] === 'earned' ? 'bg-blue-100 text-blue-800' :
                                            ($entry['status'] === 'rejected' ? 'bg-red-100 text-red-700' :
                                            'bg-gray-200 text-gray-800')))
                                        }}">
                                        {{ ucfirst($entry['status']) }}
                                    </span>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="text-center mt-6">
        <a href="/dashboard" class="text-purple-600 hover:text-purple-500 font-medium">Back to Dashboard</a>
    </div>
</div>
@endsection
