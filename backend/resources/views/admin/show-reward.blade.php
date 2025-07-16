@extends('admin.layouts.layout')

@section('title', 'Reward Details')

@section('content')

<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 col-xl-4" style="padding: 2rem, 6rem, 2rem, 6rem; width: 60%">
            <div class="card shadow-lg  border-0 rounded-3 overflow-hidden" >
                <!-- Card Header -->
                <div class="card-header bg-gradient-primary text-white text-center py-3 border-0">
                    <h1 class="h4 mb-0 fw-semibold">Reward Details</h1>
                </div>
                
                <!-- Card Body -->
                <div class="card-body p-4">
                    <!-- Reward Image -->
                    <div class="text-center mb-4">
                        @if ($reward->reward_image)
                            <div class="position-relative d-inline-block">
                                <img src="{{ asset('storage/' . $reward->reward_image) }}"
                                     alt="{{ $reward->reward_name }}"
                                     class="rounded-3 shadow-sm"
                                     style="width: 120px; height: 120px; object-fit: cover;" />
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-10 rounded-3"></div>
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light text-muted rounded-3 shadow-sm mx-auto"
                                 style="width: 120px; height: 120px;">
                                <i class="fas fa-image fa-2x"></i>
                                <div class="ms-2">
                                    <small class="d-block">No Image</small>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Reward Info -->
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3 shadow-sm">
                                <div class="mb-2">
                                    <span class="badge bg-secondary rounded-pill small">Reward Name</span>
                                    <p class="mb-0 mt-1 fw-medium text-dark">{{ $reward->reward_name }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3 shadow-sm">
                                <div class="mb-2">
                                    <span class="badge bg-info rounded-pill small">Description</span>
                                    <p class="mb-0 mt-1 text-muted">{{ $reward->reward_desc }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="bg-light rounded-3 p-3 shadow-sm h-100">
                                <div class="text-center">
                                    <span class="badge bg-success rounded-pill small">Stock</span>
                                    <p class="mb-0 mt-1 fw-bold text-success fs-5">{{ $reward->reward_stock }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="bg-light rounded-3 p-3 shadow-sm h-100">
                                <div class="text-center">
                                    <span class="badge bg-warning rounded-pill small">Points</span>
                                    <p class="mb-0 mt-1 fw-bold text-warning fs-5">{{ $reward->point_required }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3 shadow-sm">
                                <div class="mb-2">
                                    <span class="badge bg-primary rounded-pill small">Company</span>
                                    <p class="mb-0 mt-1 fw-medium text-primary">{{ optional($reward->company)->company_name ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Card Footer -->
                <div class="card-footer bg-transparent border-0 text-center py-3">
                    <a href="{{ route('admin.reward.index') }}" 
                       class="btn btn-primary btn-lg shadow-sm rounded-pill px-4 py-2 fw-medium">
                        <i class="fas fa-arrow-left me-2"></i>Back to Rewards List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom CSS for enhanced styling */
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    transform: translateY(-1px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.badge {
    font-size: 0.7rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.rounded-3 {
    border-radius: 0.75rem;
}

.rounded-pill {
    border-radius: 50rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem;
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
}

/* Animation for smooth transitions */
.bg-light {
    transition: all 0.3s ease;
}

.bg-light:hover {
    background-color: #f8f9fa !important;
    transform: translateY(-1px);
}

/* Custom color variations */
.text-primary {
    color: #667eea !important;
}

.bg-primary {
    background-color: #667eea !important;
}

.border-primary {
    border-color: #667eea !important;
}
</style>

@endsection