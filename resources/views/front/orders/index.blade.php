<x-app-layout>
    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="fw-bold display-6 mb-4">Pesanan Saya</h1>

            @if($orders->count() > 0)
                <div class="row g-4">
                    @foreach($orders as $order)
                        <div class="col-12">
                            <div class="card shadow-sm border-0 rounded-4 hover-shadow">
                                <div class="card-header bg-white py-3 border-bottom">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Order #{{ $order->order_number }}</h6>
                                            <small class="text-muted">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</small>
                                        </div>
                                        <span class="badge bg-{{ $order->status_color }} rounded-pill text-capitalize">
                                            {{ $order->status }}
                                        </span>
                                    </div>
                                </div>

                                <div class="card-body px-4 py-3">
                                    <!-- Items -->
                                    @foreach($order->items as $item)
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                                                 class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $item->product->name }}</h6>
                                                <small class="text-muted">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                                            </div>
                                            <div class="text-end text-primary fw-semibold">
                                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    @endforeach

                                    <hr>

                                    <!-- Shipping + Summary -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <h6 class="mb-2">Alamat Pengiriman</h6>
                                            <small class="text-muted">
                                                {{ $order->shipping_name }}<br>
                                                {{ $order->shipping_phone }}<br>
                                                {{ $order->shipping_address }}<br>
                                                {{ $order->shipping_city }}, {{ $order->shipping_postal_code }}
                                            </small>
                                        </div>

                                        <div class="col-md-6 text-md-end">
                                            <div class="mb-2">
                                                <span class="text-muted">Subtotal:</span>
                                                <strong class="ms-2">Rp {{ number_format($order->total_price - $order->shipping_fee, 0, ',', '.') }}</strong>
                                            </div>
                                            <div class="mb-2">
                                                <span class="text-muted">Ongkir:</span>
                                                <strong class="ms-2">Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</strong>
                                            </div>
                                            <div>
                                                <span class="fw-bold">Total:</span>
                                                <span class="text-primary fw-bold ms-2">
                                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-white py-3 border-top">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-{{ $order->payment_status_color }} rounded-pill text-capitalize">
                                            Pembayaran: {{ $order->payment_status }}
                                        </span>
                                        <a href="{{ route('orders.show', $order->order_number) }}" class="btn btn-outline-dark btn-sm">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            @else
                <!-- No Orders -->
                <div class="text-center py-5">
                    <i class="bi bi-box-seam display-1 text-muted mb-4"></i>
                    <h3 class="h4 mb-2">Belum ada pesanan</h3>
                    <p class="text-muted mb-4">Pesan produk favoritmu sekarang!</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary px-4 py-2">
                        Lihat Produk
                    </a>
                </div>
            @endif
        </div>
    </section>

    <style>
        .hover-shadow:hover {
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.075) !important;
            transition: all 0.3s ease;
        }
    </style>
</x-app-layout>
