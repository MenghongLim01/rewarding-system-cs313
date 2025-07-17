@extends('admin.layouts.layout')

@section('title', 'Transaction History')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-users.css') }}"> {{-- Use your existing style sheet --}}

<div class="users-container">
    <div class="header">
        <h1>Transaction History 📊</h1>
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Back to Dashboard</a>
    </div>

    <div class="table-wrapper mt-4">
        @if ($pagedResults->isEmpty())
            <div class="text-center text-gray-600 p-4">No transactions found.</div>
        @else
            <table class="user-table">
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>User</th>
                        <th>Points</th>
                        <th>Status</th>
                        <th>Staff</th>
                        <th>Company</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pagedResults as $transaction)
                        <tr>
                            <!-- <td>{{ $transaction['id'] }}</td> -->
                            <td>{{ $transaction['user_name'] }}</td>
                            <td style="color: {{ Str::startsWith($transaction['points'], '+') ? '#16a34a' : '#dc2626' }}; font-weight: 600;">
                                {{ $transaction['points'] }}
                            </td>
                            <td>{{ $transaction['description'] }}</td>
                            <td>{{ $transaction['staff_name'] }}</td>
                            <td>{{ $transaction['company_name'] }}</td>
                            <td class="text-gray-500">{{ \Carbon\Carbon::parse($transaction['date'])->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination Section --}}
            <div class="pagination-controls mt-4 d-flex justify-between items-center">
                <!-- <div class="text-sm text-gray-600">
                    Showing {{ $pagedResults->firstItem() }}–{{ $pagedResults->lastItem() }} of {{ $pagedResults->total() }}
                </div> -->
                <div class="pagination-links">
                    {{ $pagedResults->onEachSide(1)->links('vendor.pagination.simple-default') }}
                </div>
            </div>


        @endif
    </div>
</div>
@endsection


<style>
    

    .point-green {
        color: #16a34a;
        font-weight: 600;
    }

    .point-red {
        color: #dc2626;
        font-weight: 600;
    }

.pagination-links {
    overflow-x: hidden;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none;  /* Internet Explorer 10+ */
}

.pagination-links::-webkit-scrollbar {
    display: none; /* Chrome, Safari, Opera */
}

.pagination-links {
    display: flex;
    gap: 6px;
    justify-content: flex-end;
    align-items: center;
}

.pagination-links .pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination-links .pagination li {
    margin: 0 2px;
}

.pagination-links .pagination a,
.pagination-links .pagination span {
    padding: 6px 12px;
    font-size: 14px;
    color: #4b5563;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    text-decoration: none;
    background-color: white;
    transition: background-color 0.2s;
}

.pagination-links .pagination a:hover {
    background-color: #f3f4f6;
}

.pagination-links .pagination .active span {
    background-color: #6d28d9;
    color: white;
    border-color: #6d28d9;
    font-weight: 600;
}

.pagination-links .pagination .disabled span {
    color: #9ca3af;
    background-color: #f3f4f6;
    cursor: not-allowed;
}
</style>