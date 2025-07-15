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

<div class="transaction-history-box">
    <h1 class="transaction-title">User Transaction History 🧾</h1>

    <div class="table-wrapper">
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Type</th>
                    <th>Points</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sok Dara</td>
                    <td>Earn</td>
                    <td class="points-earned">+100</td>
                    <td>Referral bonus</td>
                    <td>2025-07-15</td>
                </tr>
                <tr>
                    <td>Chanthy Roeun</td>
                    <td>Redeem</td>
                    <td class="points-redeemed">-500</td>
                    <td>Discount Voucher</td>
                    <td>2025-07-14</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
