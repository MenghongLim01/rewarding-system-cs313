@extends('admin.layouts.layout')

@section('title', 'Edit Company')

@section('content')
<div class="container d-flex justify-content-center align-items-start mt-5">
    <div class="card shadow-sm w-100" style="max-width: 600px;">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Edit Company</h4>
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

            <form method="POST" action="{{ route('admin.companies.update', $company->company_id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Company Name</label>
                    <input type="text" name="company_name" value="{{ $company->company_name }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Company Type</label>
                    <input type="text" name="company_type" value="{{ $company->company_type }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="company_desc" class="form-control" rows="4">{{ $company->company_desc }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary">← Back</a>
                    <button type="submit" class="btn btn-warning">Update Company</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
