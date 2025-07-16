@extends('admin.layouts.layout')

@section('title', 'Edit Company')

@section('content')
<div class="container d-flex justify-content-center align-items-start mt-5">
    <div class="card shadow-sm w-100" style="max-width: 600px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit User</h4>
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

            <form method="POST" action="{{ route('admin.users.update', ['user_id' => $user->user_id]) }}">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="user_name" value="{{ old('user_name', $user->user_name) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="user_email" value="{{ old('user_email', $user->user_email) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <div class="w-full">
                <label for="company_id" class="block text-sm font-medium text-gray-700 mb-1">Select Company</label>
                    <select id="company_id" name="company_id" required
                     class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                     <option value="" disabled selected>-- Choose a company --</option>
                     @foreach ($companies as $company)
                            <option value="{{ $company->company_id }}" {{ $company->company_id == $user->company_id ? 'selected' : '' }}>
                                {{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>
            </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">← Back</a>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
