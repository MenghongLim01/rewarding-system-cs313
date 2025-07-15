@extends('admin.layouts.layout')

@section('title', 'Transaction History')

@section('content')
<style>
    .transaction-container {
        padding: 32px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .transaction-title {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 24px;
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
        background-color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .styled-table thead {
        background-color: #f9f9f9;
    }

    .styled-table th {
        text-align: left;
        padding: 16px;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        color: #6b21a8; /* Purple headers */
        border-bottom: 1px solid #e5e7eb;
    }

    .styled-table td {
        padding: 16px;
        font-size: 14px;
        color: #374151;
        border-bottom: 1px solid #f1f5f9;
    }

    .styled-table tr:hover {
        background-color: #f3f4f6;
    }

    .point-green {
        color: #16a34a;
        font-weight: 600;
    }

    .point-red {
        color: #dc2626;
        font-weight: 600;
    }

    .point-date {
        color: #6b7280;
        font-size: 13px;
    }
</style>

<div class="transaction-container">
    <h2 class="transaction-title">📊 Transaction History</h2>

    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Points</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td class="point-green">+100</td>
                <td>Referral Bonus</td>
                <td class="point-date">2025-07-15 10:15</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jane Smith</td>
                <td class="point-red">-50</td>
                <td>Points Redeemed</td>
                <td class="point-date">2025-07-14 14:45</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Alex Kim</td>
                <td class="point-green">+30</td>
                <td>Purchase Reward</td>
                <td class="point-date">2025-07-13 09:00</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
