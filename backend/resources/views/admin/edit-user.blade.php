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
                    <label class="form-label">Company</label>
                    <input type="text" class="form-control bg-light" value="{{ $user->company->company_name ?? 'N/A' }}" readonly>
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
