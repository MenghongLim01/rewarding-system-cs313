@extends('admin.layouts.layout')

@section('title', 'Rewards Management')

@section('content')

<div class="users-container">
    <div class="header">
        <h1>Rewards Management👥</h1>
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Back to Dashboard</a>
    </div>

    <!-- <button class="btn-add-staff" onclick="window.location.href='{{ route('admin.staff.create') }}'">Add New Staff</button> -->
<button class="btn-add-staff" onclick="window.location.href='{{ route('admin.reward.create') }}'">Add New Reward</button>
<div class="flex justify-end mt-4">
        
    </div>
    <div class="table-wrapper mt-4">
        @if (session('success'))
        <div class="alert alert-success mb-4 text-green-700 bg-green-100 p-4 rounded">
        {{ session('success') }}
        </div>
        @endif
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Reward Name</th>
                    <th>Stock</th>
                    <th>Point Required</th>
                    <th>Company</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
    @foreach($rewards as $rewardItem)
    <tr>
        <td>{{ $rewardItem->reward_id }}</td>
        <td>{{ $rewardItem->reward_name }}</td>
        <td>{{ $rewardItem->reward_stock }}</td>
        <td>{{ $rewardItem->point_required }}</td>
        <td>{{ optional($rewardItem->company)->company_name ?? 'N/A' }}</td> <!-- Safely access company name -->
        <td class="text-right">
                        <!-- View Button -->
                        <a href="{{ route('admin.reward.show', $rewardItem->reward_id) }}" class="btn btn-sm btn-warning">View</a>
                        
                        <!-- Edit Button -->
                        <a href="{{ route('admin.reward.edit', $rewardItem->reward_id) }}" class="btn btn-sm btn-primary">Edit</a>

                        <!-- Delete Button -->
                        <form id="delete-form-{{ $rewardItem->reward_id }}" action="{{ route('admin.reward.destroy', $rewardItem->reward_id) }}" method="POST" class="d-inline">
                            @csrf
                             @method('DELETE')
                            <a href="#" 
                            onclick="if(confirm('Are you sure you want to delete this staff?')) document.getElementById('delete-form-{{ $rewardItem->reward_id }}').submit();"
                            class="btn btn-sm btn-danger">
                            Delete
                        </a>
                </form>
                    </td>
    
    </tr>
@endforeach
</tbody>
        </table>
    </div>
</div>
@endsection
