@extends('staff.layouts.layout')

@section('title', 'Transaction History')

@section('content')
<style>
    .transaction-history-box {
        max-width: 960px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    .transaction-title {
        font-size: 2rem;
        font-weight: 800;
        text-align: center;
        color: #1f2937;
        margin-bottom: 1.5rem;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .transaction-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
    }

    .transaction-table thead {
        background-color: #f3f4f6;
        text-align: left;
        color: #4b5563;
    }

    .transaction-table th, .transaction-table td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .transaction-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .points-earned {
        color: #16a34a; /* Green */
        font-weight: bold;
    }

    .points-redeemed {
        color: #dc2626; /* Red */
        font-weight: bold;
    }
</style>

<div class="w-[90%] mx-auto my-8 bg-white shadow rounded-lg p-6">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">User Transaction History 🧾</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">User</th>
                    <th class="px-4 py-2 text-left">Type</th>
                    <th class="px-4 py-2 text-left">Points</th>
                    <th class="px-4 py-2 text-left">Processed By</th>
                    <th class="px-4 py-2 text-left">Date</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @forelse ($transactions as $tx)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $tx['user_name'] }}</td>
                        <td class="px-4 py-2">{{ ucfirst($tx['type']) }}</td>
                        <td class="px-4 py-2 font-semibold {{ $tx['points'] > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $tx['points'] > 0 ? '+' : '' }}{{ $tx['points'] }} pts
                        </td>
                        <td class="px-4 py-2">{{ $tx['processed_by'] ?? '—' }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($tx['date'])->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4 italic">No transactions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
