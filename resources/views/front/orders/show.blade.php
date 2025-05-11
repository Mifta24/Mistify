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
                <!-- Add this inside the Order Status card, after the status badges -->
                <div class="col-auto">
                    <a href="{{ route('orders.track', $order->order_number) }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-truck me-1"></i> Track Order
                    </a>
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
                                @foreach ($order->items as $item)
                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto">
                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                alt="{{ $item->product->name }}" class="rounded"
                                                style="width: 64px; height: 64px; object-fit: cover;">
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-1">{{ $item->product->name }}</h6>
                                            <p class="text-muted small mb-0">
                                                {{ $item->quantity }} x Rp
                                                {{ number_format($item->price, 0, ',', '.') }}
                                            </p>

                                            {{-- Show review button or existing review --}}
                                            @if ($order->status === 'delivered')
                                                @php
                                                    $review = $item->product
                                                        ->reviews()
                                                        ->where('user_id', auth()->id())
                                                        ->where('order_id', $order->id)
                                                        ->first();
                                                @endphp

                                                @if ($review)
                                                    <div class="mt-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="text-warning me-2">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $review->rating)
                                                                        <i class="bi bi-star-fill"></i>
                                                                    @else
                                                                        <i class="bi bi-star"></i>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                            <small
                                                                class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                                                        </div>
                                                        @if ($review->comment)
                                                            <p class="small text-muted mt-1 mb-0">
                                                                {{ $review->comment }}</p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="mt-2">
                                                        <a href="{{ route('reviews.create', [$order, $item->product]) }}"
                                                            class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-star me-1"></i> Write a Review
                                                        </a>
                                                    </div>
                                                @endif
                                            @endif
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

                                @if ($order->notes)
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

                @if ($order->status === 'pending' && $order->payment_status === 'unpaid')
                    <div class="text-center mt-4">
                        <a href="{{ route('payment.index', $order->order_number) }}"
                            class="btn btn-primary btn-lg px-5 me-3">
                            <i class="bi bi-credit-card me-2"></i>Continue to Payment
                        </a>

                        <button type="button" class="btn btn-outline-danger btn-lg px-5" id="cancelOrderBtn">
                            <i class="bi bi-x-circle me-2"></i>Cancel Order
                        </button>
                    </div>

                    <form id="cancelOrderForm" action="{{ route('orders.cancel', $order->order_number) }}"
                        method="POST" class="d-none">
                        @csrf
                    </form>
                @elseif ($order->status === 'pending' || $order->status === 'processing')
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-outline-danger btn-lg px-5" id="cancelOrderBtn">
                            <i class="bi bi-x-circle me-2"></i>Cancel Order
                        </button>
                    </div>

                    <form id="cancelOrderForm" action="{{ route('orders.cancel', $order->order_number) }}"
                        method="POST" class="d-none">
                        @csrf
                    </form>
                @endif
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            @media print {

                .btn,
                nav,
                footer {
                    display: none !important;
                }

                .card {
                    border: none !important;
                    box-shadow: none !important;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cancelOrderBtn = document.getElementById('cancelOrderBtn');
                if (cancelOrderBtn) {
                    cancelOrderBtn.addEventListener('click', function() {
                        Swal.fire({
                            title: 'Cancel Your Order?',
                            html: `
                        <div class="text-start mb-4">
                            <p class="mb-2">Are you sure you want to cancel your order?</p>
                            <p class="text-muted small">Order #{{ $order->order_number }}</p>
                            <hr>
                            <div class="alert alert-warning mt-3">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                This action cannot be undone.
                            </div>
                        </div>
                    `,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes, cancel order',
                            cancelButtonText: 'No, keep order',
                            reverseButtons: true,
                            focusCancel: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('cancelOrderForm').submit();
                            }
                        });
                    });
                }
            });
        </script>
    </x-app-layout>
