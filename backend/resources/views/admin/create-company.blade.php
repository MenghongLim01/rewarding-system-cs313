@extends('admin.layouts.layout')

@section('title', 'Add Company')

@section('content')
<div class="container d-flex justify-content-center align-items-start mt-5">
    <div class="card shadow-sm w-100" style="max-width: 600px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add New Company</h4>
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

            <form method="POST" action="{{ route('admin.companies.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Company Name <span class="text-danger">*</span></label>
                    <input type="text" name="company_name" class="form-control" required placeholder="e.g. Phka Blush Co." required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Company Type <span class="text-danger">*</span></label>
                    <input type="text" name="company_type" class="form-control" required placeholder="e.g. Cosmetics" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="company_desc" class="form-control" rows="4" placeholder="Short description about the company..."required></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary">← Back</a>
                    <button type="submit" class="btn btn-primary">Add Company</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
