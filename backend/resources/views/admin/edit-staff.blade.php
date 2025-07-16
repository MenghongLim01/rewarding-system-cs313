@extends('admin.layouts.layout')

@section('title', 'Edit Staff')

@section('content')
<div class="container d-flex justify-content-center align-items-start mt-5">
    <div class="card shadow-sm w-100" style="max-width: 600px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Staff</h4>
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

            <form method="POST" action="{{ route('admin.staff.update', ['staff_id' => $staff->staff_id]) }}">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Staff Name</label>
                    <input type="text" name="staff_name" value="{{ old('staff_name', $staff->staff_name) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="staff_email" value="{{ old('staff_email', $staff->staff_email) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <div>
                        <label for="company_id" class="block text-sm font-medium text-gray-700 mb-1">Select Company</label>
                        <select id="company_id" name="company_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        <option value="" disabled selected>-- Choose a company --</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->company_id }}" {{ $company->company_id == $staff->company_id ? 'selected' : '' }}>
                                {{ $company->company_name }}
                            </option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-secondary">← Back</a>
                    <button type="submit" class="btn btn-primary">Update Staff</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
