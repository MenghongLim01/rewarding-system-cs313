@extends('admin.layouts.layout')

@section('title', 'Add New Staff')

@section('content')

<div class="container d-flex justify-content-center align-items-start mt-5">
    <div class="card shadow-sm w-100" style="max-width: 500px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add New Staff</h4>
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

            <form id="register-form" class="space-y-6" method="POST" action="{{ route('admin.staff.store') }}">
            @csrf
            <div>
                <label for="staff_name" class="block text-sm font-medium text-gray-700 mb-1">Staff Name</label>
                <input type="text" id="staff_name" name="staff_name" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>

            <div>
                <label for="staff_email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" id="staff_email" name="staff_email" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                 <input type="password" id="password_confirmation" name="password_confirmation" required
                 class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            
            <div class="w-full">
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
                <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-secondary">← Back</a>
                <button type="submit" class="btn btn-primary">Add Staff</button>
            </div>
            
        </form>
        </div>
    </div>
</div>
@endsection
