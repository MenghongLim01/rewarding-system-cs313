@extends('admin.layouts.layout')

@section('title', 'Add New Reward')

@section('content')

<div class="container d-flex justify-content-center align-items-start">
    <div class="card shadow-sm w-100" style="max-width: 500px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add New Reward</h4>
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

            <form id="create-reward-form" class="space-y-6" method="POST" action="{{ route('admin.reward.store') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="reward_name" class="block text-sm font-medium text-gray-700 mb-1">Reward Name</label>
                <input type="text" id="reward_name" name="reward_name" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>

            <div>
                <label for="reward_desc" class="block text-sm font-medium text-gray-700 mb-1">Reward Description</label>
                <textarea id="reward_desc" name="reward_desc" required
                          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm"></textarea>
            </div>

            <div>
                <label for="reward_stock" class="block text-sm font-medium text-gray-700 mb-1">Reward Stock</label>
                <input type="number" id="reward_stock" name="reward_stock" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>

            <div>
                <label for="reward_image" class="block text-sm font-medium text-gray-700 mb-1">Reward Image (optional)</label>
                <input type="file" id="reward_image" name="reward_image" accept="image/*"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>

            <div>
                <label for="point_required" class="block text-sm font-medium text-gray-700 mb-1">Points Required</label>
                <input type="number" id="point_required" name="point_required" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>

            <div>
                <label for="company_id" class="block text-sm font-medium text-gray-700 mb-1">Select Company</label>
                <select id="company_id" name="company_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                    <option value="" disabled selected>-- Choose a company --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->company_id }}">{{ $company->company_name }}</option>
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
                <button type="submit" class="btn btn-primary">Add Reward</button>
            </div>
            
        </form>
        </div>
    </div>
</div>

@endsection
