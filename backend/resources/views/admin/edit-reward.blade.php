@extends('admin.layouts.layout')

@section('title', 'Edit Reward')

@section('content')

<div class="container d-flex justify-content-center align-items-start">
    <div class="card shadow-sm w-100" style="max-width: 500px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Reward</h4>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success mb-4 text-green-700 bg-green-100 p-4 rounded">
                 {{ session('success') }}
                 </div>
            @endif

            <form id="edit-reward-form" class="space-y-6" method="POST" action="{{ route('admin.reward.update', $reward->reward_id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')  <!-- Ensure the request method is PUT for updating -->

            <div>
                <label for="reward_name" class="block text-sm font-medium text-gray-700 mb-1">Reward Name</label>
                <input type="text" id="reward_name" name="reward_name" value="{{ old('reward_name', $reward->reward_name) }}" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>

            <div>
                <label for="reward_desc" class="block text-sm font-medium text-gray-700 mb-1">Reward Description</label>
                <textarea id="reward_desc" name="reward_desc" required
                          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">{{ old('reward_desc', $reward->reward_desc) }}</textarea>
            </div>

            <div>
                <label for="reward_stock" class="block text-sm font-medium text-gray-700 mb-1">Reward Stock</label>
                <input type="number" id="reward_stock" name="reward_stock" value="{{ old('reward_stock', $reward->reward_stock) }}" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>

            <div>
                <label for="reward_image" class="block text-sm font-medium text-gray-700 mb-1">Reward Image (optional)</label>
                <input type="file" id="reward_image" name="reward_image" accept="image/*"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                @if ($reward->reward_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $reward->reward_image) }}" alt="Current Reward Image" class="w-32 h-32 object-cover rounded-lg shadow-md">
                    </div>
                @endif
            </div>

            <div>
                <label for="point_required" class="block text-sm font-medium text-gray-700 mb-1">Points Required</label>
                <input type="number" id="point_required" name="point_required" value="{{ old('point_required', $reward->point_required) }}" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>

            <div>
                <label for="company_id" class="block text-sm font-medium text-gray-700 mb-1">Select Company</label>
                <select id="company_id" name="company_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                    <option value="" disabled selected>-- Choose a company --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->company_id }}" {{ $company->company_id == $reward->company_id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <br>
            <div class="flex items-center">
                <input id="terms-checkbox" name="terms-checkbox" type="checkbox" required
                       class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                I agree to the <a href="/terms" class="font-medium text-purple-600 hover:text-purple-500">Terms and Conditions</a> and <a href="/privacy-policy" class="font-medium text-purple-600 hover:text-purple-500">Privacy Policy</a>.
            </div>
            <br>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.reward.index') }}" class="btn btn-outline-secondary">← Back</a>
                <button type="submit" class="btn btn-primary">Update Reward</button>
            </div>
            
        </form>
        </div>
    </div>
</div>

@endsection
