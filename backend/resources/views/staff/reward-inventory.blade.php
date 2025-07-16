@extends('staff.layouts.layout')

@section('title', 'Reward Inventory')

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

<div class="transaction-history-box">
    <h1 class="transaction-title">Reward Inventory</h1>
 @if ($errors->any())
        <div class="mb-6 p-4 bg-red-200 text-red-700 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
     @if (session('success'))
        <div class="mb-6 p-4 bg-green-200 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="mb-6 p-4 bg-red-200 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
    <div class="table-wrapper">
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Points Required</th>
                    <th>Available Stocks</th>
                </tr>
            </thead>
            <tbody>
             @foreach ($rewards as $reward)
                <tr class="border-b">
                    <td class="p-4">
                        <img src="{{ asset('storage/' . $reward->reward_image) }}" class="w-14 h-14 object-cover rounded" />
                    </td>
                    <td class="p-4">{{ $reward->reward_name }}</td>
                    <td class="p-4">{{ $reward->reward_desc }}</td>
                    <td class="p-4">{{ $reward->point_required }}</td>
                    <td class="p-4">{{ $reward->reward_stock }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
