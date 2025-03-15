<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Order Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 mb-0">Order Details #{{ $order->order_number }}</h1>
                    <div>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Back to Orders
                        </a>
                        <button class="btn btn-primary btn-sm ms-2" onclick="window.print()">
                            <i class="bi bi-printer me-1"></i> Print Order
                        </button>
                    </div>
                </div>

                <!-- Order Status -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center text-md-start mb-3 mb-md-0">
                                <span class="text-muted small d-block">Order Date</span>
                                <strong>{{ $order->created_at->format('d M Y, H:i') }}</strong>
                            </div>
                            <div class="col-md-3 text-center text-md-start mb-3 mb-md-0">
                                <span class="text-muted small d-block">Status</span>
                                <span class="badge bg-{{ $order->status_color }} rounded-pill">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <div class="col-md-3 text-center text-md-start mb-3 mb-md-0">
                                <span class="text-muted small d-block">Payment Status</span>
                                <span class="badge bg-{{ $order->payment_status_color }} rounded-pill">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </div>
                            <div class="col-md-3 text-center text-md-start">
                                <span class="text-muted small d-block">Payment Method</span>
                                <strong>{{ strtoupper($order->payment_method) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Order Items -->
                    <div class="col-lg-8">
                        <div class="card shadow-sm border-0">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">Order Items</h5>
                                @foreach($order->items as $item)
                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto">
                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                 alt="{{ $item->product->name }}"
                                                 class="rounded"
                                                 style="width: 64px; height: 64px; object-fit: cover;">
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-1">{{ $item->product->name }}</h6>
                                            <p class="text-muted small mb-0">
                                                {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="col-auto">
                                            <span class="fw-bold">
                                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">Order Summary</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subtotal</span>
                                    <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Shipping</span>
                                    <span>Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <strong>Total</strong>
                                    <strong class="text-primary">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </strong>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">Shipping Information</h5>
                                <p class="mb-1"><strong>{{ $order->shipping_name }}</strong></p>
                                <p class="mb-1">{{ $order->shipping_phone }}</p>
                                <p class="mb-1">{{ $order->shipping_address }}</p>
                                <p class="mb-0">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>

                                @if($order->notes)
                                    <hr>
                                    <div class="text-muted small">
                                        <strong>Notes:</strong><br>
                                        {{ $order->notes }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($order->status === 'pending' || $order->status === 'processing')
                    <div class="text-center mt-4">
                        <form action="{{ route('orders.cancel', $order) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to cancel this order?')">
                                Cancel Order
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        @media print {
            .btn, nav, footer {
                display: none !important;
            }
            .card {
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>
    @endpush
</x-app-layout>
