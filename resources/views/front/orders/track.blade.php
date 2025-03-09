<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Order Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 mb-0">Track Order #{{ $order->order_number }}</h1>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Back to Order Details
                    </a>
                </div>

                <!-- Order Status Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <div class="timeline">
                            <!-- Ordered -->
                            <div class="timeline-item {{ in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']) ? 'active' : '' }}">
                                <div class="timeline-icon bg-primary">
                                    <i class="bi bi-box-seam text-white"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Order Placed</h6>
                                    <p class="text-muted mb-0 small">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Processing -->
                            <div class="timeline-item {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'active' : '' }}">
                                <div class="timeline-icon {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'bg-primary' : 'bg-secondary' }}">
                                    <i class="bi bi-gear text-white"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Processing</h6>
                                    <p class="text-muted mb-0 small">
                                        {{ $order->processed_at?->format('d M Y, H:i') ?? 'Pending' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Shipped -->
                            <div class="timeline-item {{ in_array($order->status, ['shipped', 'delivered']) ? 'active' : '' }}">
                                <div class="timeline-icon {{ in_array($order->status, ['shipped', 'delivered']) ? 'bg-primary' : 'bg-secondary' }}">
                                    <i class="bi bi-truck text-white"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Shipped</h6>
                                    <p class="text-muted mb-0 small">
                                        {{ $order->shipped_at?->format('d M Y, H:i') ?? 'Pending' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Delivered -->
                            <div class="timeline-item {{ $order->status === 'delivered' ? 'active' : '' }}">
                                <div class="timeline-icon {{ $order->status === 'delivered' ? 'bg-success' : 'bg-secondary' }}">
                                    <i class="bi bi-check-lg text-white"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Delivered</h6>
                                    <p class="text-muted mb-0 small">
                                        {{ $order->delivered_at?->format('d M Y, H:i') ?? 'Pending' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Details Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Shipping Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted mb-2">Recipient</h6>
                                <p class="mb-0">{{ $order->shipping_name }}</p>
                                <p class="mb-0">{{ $order->shipping_phone }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted mb-2">Delivery Address</h6>
                                <p class="mb-0">{{ $order->shipping_address }}</p>
                                <p class="mb-0">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                            </div>
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
            top: 0;
            left: 24px;
            height: 100%;
            width: 2px;
            background-color: #e9ecef;
        }

        .timeline-item {
            position: relative;
            padding-left: 70px;
            padding-bottom: 30px;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-icon {
            position: absolute;
            left: 10px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .timeline-icon i {
            font-size: 1rem;
        }

        .timeline-content {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 0.5rem;
        }

        .timeline-item.active .timeline-content {
            background-color: #fff;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
    @endpush
</x-app-layout>
