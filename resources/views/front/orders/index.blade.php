<x-app-layout>
    <div class="container py-5">
        <h1 class="display-5 fw-bold mb-4">My Orders</h1>

        @if($orders->count() > 0)
            <div class="row g-4">
                @foreach($orders as $order)
                    <div class="col-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-white py-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="mb-0">Order #{{ $order->order_number }}</h6>
                                        <small class="text-muted">
                                            Placed on {{ $order->created_at->format('d M Y, H:i') }}
                                        </small>
                                    </div>
                                    <div class="col-auto">
                                        <span class="badge bg-{{ $order->status_color }} rounded-pill">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                @foreach($order->items as $item)
                                    <div class="row align-items-center mb-3">
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
                                            <span class="text-primary">
                                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach

                                <hr>

                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="mb-3 mb-md-0">
                                            <h6 class="mb-1">Shipping Address</h6>
                                            <p class="text-muted small mb-0">
                                                {{ $order->shipping_name }}<br>
                                                {{ $order->shipping_phone }}<br>
                                                {{ $order->shipping_address }}<br>
                                                {{ $order->shipping_city }}, {{ $order->shipping_postal_code }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-md-end">
                                            <div class="mb-2">
                                                <span class="text-muted">Subtotal:</span>
                                                <span class="ms-2">
                                                    Rp {{ number_format($order->total_price - $order->shipping_fee, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <div class="mb-2">
                                                <span class="text-muted">Shipping:</span>
                                                <span class="ms-2">
                                                    Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <div class="mb-0">
                                                <span class="fw-bold">Total:</span>
                                                <span class="ms-2 text-primary fw-bold">
                                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white py-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <span class="badge bg-{{ $order->payment_status_color }} rounded-pill">
                                            Payment: {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('orders.show', $order->order_number) }}"
                                           class="btn btn-outline-primary btn-sm">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-box-seam display-1 text-muted mb-4"></i>
                <h3 class="h4 mb-2">No orders yet</h3>
                <p class="text-muted mb-4">Start shopping to see your orders here!</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
