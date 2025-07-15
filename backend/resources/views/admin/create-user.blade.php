@extends('admin.layouts.layout')

@section('title', 'Add New User')

@section('content')

<div class="container d-flex justify-content-center align-items-start mt-5">
    <div class="card shadow-sm w-100" style="max-width: 500px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add New User</h4>
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

            <!-- <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="user_name" class="form-control" required placeholder="e.g. John Doe">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="user_email" class="form-control" required placeholder="e.g. john@example.com">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Company <span class="text-danger">*</span></label>
                    <select name="company_id" class="form-control" required>
                        <option value="">-- Select Company --</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">← Back</a>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form> -->
            <form id="register-form" class="space-y-6" method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" id="name" name="user_name" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" id="email" name="user_email" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            <div>
                <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            
            <!-- <div>
                <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Select Company</label>
                <select id="company" name="company" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                    <option value="" disabled selected>-- Choose a company --</option>
                    <option value="Phka Blush">Phka Blush</option>
                    <option value="Siem Reap Tech">Siem Reap Tech</option>
                    <option value="Angkor Craft">Angkor Craft</option>
                </select>
            </div> -->
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
                <!-- <label for="terms-checkbox" class="ml-2 block text-sm text-gray-900"> -->
                    I agree to the <a href="/terms" class="font-medium text-purple-600 hover:text-purple-500">Terms and Conditions</a> and <a href="/privacy-policy" class="font-medium text-purple-600 hover:text-purple-500">Privacy Policy</a>.
                </label>
            </div>
            <br>
            <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">← Back</a>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            
        </form>
        </div>
    </div>
</div>
@endsection
