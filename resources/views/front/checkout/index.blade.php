<x-app-layout>
    <div class="container py-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Progress Bar -->
                <div class="mb-5">
                    <div class="d-flex justify-content-between align-items-center px-2 position-relative">
                        <div class="w-100 position-absolute top-50 start-0 translate-middle-y px-2">
                            <div class="progress" style="height: 4px;">
                                <div class="progress-bar bg-primary" style="width: 50%;"></div>
                            </div>
                        </div>
                        <span class="badge bg-primary px-3 py-2 rounded-pill z-1">1. Pengiriman</span>
                        <span class="badge bg-secondary px-3 py-2 rounded-pill z-1">2. Pembayaran</span>
                        <span class="badge bg-secondary px-3 py-2 rounded-pill z-1">3. Review</span>
                    </div>
                </div>

                <!-- Checkout Form -->
                <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST">
                    @csrf

                    <!-- Shipping Information -->
                    <div class="card shadow-sm border-0 mb-4 rounded-4">
                        <div class="card-body p-4">
                            <h4 class="mb-4">Informasi Pengiriman</h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" name="shipping[name]" class="form-control" required>
                                    </div>
                                    @error('shipping.name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Telepon</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="tel" name="shipping[phone]" class="form-control" required>
                                    </div>
                                    @error('shipping.phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="shipping[address]" class="form-control" rows="3" required></textarea>
                                    @error('shipping.address') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kota</label>
                                    <input type="text" name="shipping[city]" class="form-control" required>
                                    @error('shipping.city') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kode Pos</label>
                                    <input type="text" name="shipping[postal_code]" class="form-control" required>
                                    @error('shipping.postal_code') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Catatan <span class="text-muted">(Optional)</span></label>
                                    <textarea name="shipping[notes]" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body p-4">
                            <h4 class="mb-4">Metode Pembayaran</h4>
                            <div class="list-group">
                                <label class="list-group-item d-flex align-items-start gap-3">
                                    <input class="form-check-input mt-1" type="radio" name="payment_method" value="bank_transfer" required>
                                    <div>
                                        <i class="bi bi-bank me-1"></i>
                                        Bank Transfer
                                        <div class="text-muted small">Transfer via bank account</div>
                                    </div>
                                </label>
                                <label class="list-group-item d-flex align-items-start gap-3">
                                    <input class="form-check-input mt-1" type="radio" name="payment_method" value="e_wallet" required>
                                    <div>
                                        <i class="bi bi-wallet2 me-1"></i>
                                        E-Wallet
                                        <div class="text-muted small">Pay with your e-wallet</div>
                                    </div>
                                </label>
                            </div>
                            @error('payment_method') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 position-sticky" style="top: 2rem;">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Ringkasa Pemesanan</h4>
                        @foreach($cartItems as $id => $item)
                            <div class="d-flex gap-3 mb-3">
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="rounded" style="width: 64px; height: 64px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $item['name'] }}</h6>
                                    <p class="text-muted small mb-0">Jumlah: {{ $item['quantity'] }}</p>
                                    <p class="text-muted small mb-0">Ukuran: {{ $item['size'] }} ml</p>
                                    <strong class="text-primary">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        @endforeach

                        <hr>
                        <div class="d-flex justify-content-between mb-2 text-muted">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 text-muted">
                            <span>Pengiriman</span>
                            <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total</span>
                            <span class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <button type="submit" form="checkoutForm" class="btn btn-dark w-100 mt-4">
                            Place Order
                            <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert if error --}}
    @if(session('error'))
        @push('scripts')
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}'
            });
        </script>
        @endpush
    @endif
</x-app-layout>
