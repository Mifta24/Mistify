<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Order Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Track Order</h1>
                        <p class="text-muted mb-0">#{{ $order->order_number }}</p>
                    </div>
                    <a href="{{ route('orders.show', $order->order_number) }}"
                       class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Back to Order Details
                    </a>
                </div>

                <!-- Progress Bar -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <div class="progress mb-4" style="height: 4px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                 style="width: {{ $order->getTrackingProgress() }}%"
                                 aria-valuenow="{{ $order->getTrackingProgress() }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                            </div>
                        </div>

                        <div class="progress-tracker">
                            <div class="timeline">
                                <!-- Order Placed -->
                                <div class="timeline-item {{ $order->created_at ? 'completed' : '' }}">
                                    <div class="timeline-badge">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Order Placed</h6>
                                            <span class="badge bg-primary-subtle text-primary rounded-pill">
                                                Step 1
                                            </span>
                                        </div>
                                        <p class="text-muted small mb-0 mt-2">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Processing -->
                                <div class="timeline-item {{ $order->processed_at ? 'completed' : '' }}">
                                    <div class="timeline-badge">
                                        <i class="bi bi-gear"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Processing</h6>
                                            <span class="badge bg-primary-subtle text-primary rounded-pill">
                                                Step 2
                                            </span>
                                        </div>
                                        <p class="text-muted small mb-0 mt-2">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $order->processed_at?->format('d M Y, H:i') ?? 'Pending' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Shipped -->
                                <div class="timeline-item {{ $order->shipped_at ? 'completed' : '' }}">
                                    <div class="timeline-badge">
                                        <i class="bi bi-truck"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Shipped</h6>
                                            <span class="badge bg-primary-subtle text-primary rounded-pill">
                                                Step 3
                                            </span>
                                        </div>
                                        <p class="text-muted small mb-0 mt-2">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $order->shipped_at?->format('d M Y, H:i') ?? 'Pending' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Delivered -->
                                <div class="timeline-item {{ $order->delivered_at ? 'completed' : '' }}">
                                    <div class="timeline-badge">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Delivered</h6>
                                            <span class="badge bg-primary-subtle text-primary rounded-pill">
                                                Step 4
                                            </span>
                                        </div>
                                        <p class="text-muted small mb-0 mt-2">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $order->delivered_at?->format('d M Y, H:i') ?? 'Pending' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Details -->
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center mb-4">
                            <i class="bi bi-geo-alt text-primary me-2"></i>
                            Shipping Details
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="avatar avatar-sm bg-primary-subtle rounded">
                                            <i class="bi bi-person text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="fw-medium mb-0">{{ $order->shipping_name }}</p>
                                        <p class="text-muted small mb-0">{{ $order->shipping_phone }}</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="avatar avatar-sm bg-primary-subtle rounded">
                                            <i class="bi bi-house text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-1">{{ $order->shipping_address }}</p>
                                        <p class="mb-0">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                                    </div>
                                </div>
                            </div>
                            @if($order->notes)
                                <div class="col-md-6 mt-4 mt-md-0">
                                    <div class="bg-light p-3 rounded">
                                        <h6 class="d-flex align-items-center">
                                            <i class="bi bi-sticky text-primary me-2"></i>
                                            Notes
                                        </h6>
                                        <p class="text-muted small mb-0">{{ $order->notes }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .timeline {
            position: relative;
            padding: 20px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 0;
            height: 100%;
            width: 2px;
            background: #e9ecef;
        }

        .timeline-item {
            position: relative;
            padding-left: 60px;
            padding-bottom: 30px;
            transition: all 0.3s ease;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-badge {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #e9ecef;
            position: absolute;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .timeline-item.completed .timeline-badge {
            background: var(--bs-primary);
            border-color: var(--bs-primary);
            color: #fff;
            transform: scale(1.1);
        }

        .timeline-content {
            background: #f8f9fa;
            padding: 1.25rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .timeline-item.completed .timeline-content {
            background: #fff;
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
        }

        .avatar {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .progress {
            border-radius: 2px;
            overflow: visible;
        }

        .progress-bar {
            position: relative;
            transition: width 1s ease;
        }

        .badge.bg-primary-subtle {
            background-color: var(--bs-primary-bg-subtle);
            font-weight: 500;
        }
    </style>
    @endpush
</x-app-layout>
