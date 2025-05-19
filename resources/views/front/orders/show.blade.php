<x-app-layout>
    <div class="container py-5">
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <div>
                <h2 class="fw-bold mb-1">Order #{{ $order->order_number }}</h2>
                <p class="text-muted mb-0">Detail informasi pesanan Anda</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
                <a href="{{ route('orders.track', $order->order_number) }}" class="btn btn-outline-dark d-flex align-items-center">
                    <i class="bi bi-truck me-2"></i> Lacak Pesanan
                </a>
                <button class="btn btn-primary d-flex align-items-center" onclick="window.print()">
                    <i class="bi bi-printer me-2"></i> Cetak
                </button>
            </div>
        </div>

        <!-- Order Info -->
        <div class="card shadow-sm rounded-4 mb-4">
            <div class="card-body">
                <div class="row g-3 text-center text-md-start">
                    <div class="col-md-3">
                        <div class="text-muted small">Tanggal Pesan</div>
                        <div class="fw-semibold">{{ $order->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-muted small">Status</div>
                        <span class="badge bg-{{ $order->status_color }} text-capitalize px-3 py-2">{{ $order->status }}</span>
                    </div>
                    <div class="col-md-3">
                        <div class="text-muted small">Status Pembayaran</div>
                        <span class="badge bg-{{ $order->payment_status_color }} text-capitalize px-3 py-2">{{ $order->payment_status }}</span>
                    </div>
                    <div class="col-md-3">
                        <div class="text-muted small">Metode Pembayaran</div>
                        <div class="fw-semibold text-uppercase">{{ $order->payment_method }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Order Items -->
            <div class="col-lg-8">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">
                        <h5 class="mb-4 border-bottom pb-2">Item Pesanan</h5>
                        @foreach ($order->items as $item)
                            <div class="d-flex mb-4 gap-3 align-items-start">
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                                    class="rounded" style="width: 70px; height: 70px; object-fit: cover;">

                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $item->product->name }}</h6>
                                    <div class="text-muted small">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>

                                    @if ($order->status === 'delivered')
                                        @php
                                            $review = $item->product->reviews()
                                                ->where('user_id', auth()->id())
                                                ->where('order_id', $order->id)
                                                ->first();
                                        @endphp

                                        @if ($review)
                                            <div class="mt-2 d-flex align-items-center gap-2">
                                                <div class="text-warning">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                                    @endfor
                                                </div>
                                                <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                                            </div>
                                            @if ($review->comment)
                                                <p class="text-muted small mb-0 mt-1">{{ $review->comment }}</p>
                                            @endif
                                        @else
                                            <a href="{{ route('reviews.create', [$order, $item->product]) }}"
                                               class="btn btn-sm btn-outline-primary mt-2 d-inline-flex align-items-center gap-1">
                                                <i class="bi bi-star"></i> Tulis Ulasan
                                            </a>
                                        @endif
                                    @endif
                                </div>

                                <div class="fw-semibold text-end" style="min-width: 120px;">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Summary & Shipping -->
            <div class="col-lg-4">
                <div class="card shadow-sm rounded-4 mb-4">
                    <div class="card-body">
                        <h5 class="mb-3 border-bottom pb-2">Ringkasan</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Ongkir</span>
                            <span>Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total</span>
                            <span class="text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm rounded-4">
                    <div class="card-body">
                        <h5 class="mb-3 border-bottom pb-2">Pengiriman</h5>
                        <p class="mb-1 fw-semibold">{{ $order->shipping_name }}</p>
                        <p class="mb-1">{{ $order->shipping_phone }}</p>
                        <p class="mb-1">{{ $order->shipping_address }}</p>
                        <p class="mb-0">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>

                        @if ($order->notes)
                            <hr>
                            <p class="text-muted small"><strong>Catatan:</strong><br>{{ $order->notes }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Cancel / Payment Buttons -->
        @if ($order->status === 'pending' && $order->payment_status === 'unpaid')
            <div class="mt-5 d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('payment.index', $order->order_number) }}" class="btn btn-dark px-4">
                    <i class="bi bi-credit-card me-2"></i> Lanjutkan Pembayaran
                </a>
                <button class="btn btn-outline-danger px-4" id="cancelOrderBtn">
                    <i class="bi bi-x-circle me-2"></i> Batalkan Pesanan
                </button>
            </div>
        @elseif (in_array($order->status, ['pending', 'processing']))
            <div class="text-center mt-5">
                <button class="btn btn-outline-danger btn-lg px-5" id="cancelOrderBtn">
                    <i class="bi bi-x-circle me-2"></i> Batalkan Pesanan
                </button>
            </div>
        @endif

        <form id="cancelOrderForm" action="{{ route('orders.cancel', $order->order_number) }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    @push('styles')
    <style>
        @media print {
            .btn, nav, footer {
                display: none !important;
            }
            .card {
                box-shadow: none !important;
                border: none !important;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cancelOrderBtn = document.getElementById('cancelOrderBtn');
            if (cancelOrderBtn) {
                cancelOrderBtn.addEventListener('click', function () {
                    Swal.fire({
                        title: 'Batalkan Pesanan?',
                        html: `
                            <div class="text-start mb-4">
                                <p class="mb-2">Apakah Anda yakin ingin membatalkan pesanan ini?</p>
                                <p class="text-muted small">Order #{{ $order->order_number }}</p>
                                <hr>
                                <div class="alert alert-warning d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-triangle"></i>
                                    Tindakan ini tidak dapat dibatalkan.
                                </div>
                            </div>`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, batalkan',
                        cancelButtonText: 'Tidak',
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
    @endpush
</x-app-layout>
