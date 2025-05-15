<x-app-layout>
    <div class="container py-5">
        <h1 class="display-5 fw-bold mb-4">Keranjang Belanja</h1>

        @if($cartItems && count($cartItems) > 0)
            <div class="row g-4">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-0">
                            @foreach($cartItems as $id => $item)
                                <div class="row g-3 p-4 border-bottom">
                                    <div class="col-3">
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="img-fluid rounded">
                                    </div>
                                    <div class="col-9">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="mb-1">
                                                    <a href="{{ route('products.show', $item['slug']) }}" class="link-dark text-decoration-none">
                                                        {{ $item['name'] }}
                                                    </a>
                                                </h5>
                                                <small class="text-muted">{{ $item['category'] }}</small>
                                            </div>
                                            <h5 class="text-primary">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</h5>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div class="input-group input-group-sm" style="width: 130px;">
                                                <button class="btn btn-outline-secondary update-quantity" type="button" data-id="{{ $id }}" data-action="decrease">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <input type="text" class="form-control text-center bg-white" value="{{ $item['quantity'] }}" readonly>
                                                <button class="btn btn-outline-secondary update-quantity" type="button" data-id="{{ $id }}" data-action="increase">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                            <button class="btn btn-sm btn-outline-danger remove-item d-flex align-items-center gap-1" data-id="{{ $id }}">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Summary Card -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h5 class="mb-4">Ringkasan Pesanan</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Ongkir</span>
                                <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-semibold fs-5">
                                <span>Total</span>
                                <span class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>

                            <a href="{{ route('checkout.index') }}" class="btn btn-dark w-100 mt-4">Lanjut ke Checkout</a>
                            <div class="text-center mt-3">
                                <a href="{{ route('products.index') }}" class="text-decoration-none">
                                    <i class="bi bi-arrow-left"></i> Lanjut Belanja
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-cart-x display-1 text-muted mb-4"></i>
                <h4 class="mb-2">Keranjang Kosong</h4>
                <p class="text-muted">Tambahkan produk ke keranjang untuk melanjutkan belanja.</p>
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Lihat Produk</a>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.update-quantity').forEach(button => {
                    button.addEventListener('click', function () {
                        const id = this.dataset.id;
                        const action = this.dataset.action;
                        const input = this.parentElement.querySelector('input');
                        let quantity = parseInt(input.value);

                        quantity = action === 'increase' ? quantity + 1 : Math.max(1, quantity - 1);

                        fetch(`/cart/update/${id}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ quantity })
                        }).then(response => response.json()).then(data => {
                            if (data.status === 'success') location.reload();
                            else throw new Error(data.message);
                        }).catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: error.message || 'Terjadi kesalahan!'
                            });
                        });
                    });
                });

                document.querySelectorAll('.remove-item').forEach(button => {
                    button.addEventListener('click', function () {
                        const id = this.dataset.id;

                        Swal.fire({
                            title: 'Hapus Item?',
                            text: 'Tindakan ini tidak dapat dikembalikan.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then(result => {
                            if (result.isConfirmed) {
                                fetch(`/cart/remove/${id}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                }).then(response => response.json()).then(data => {
                                    if (data.status === 'success') location.reload();
                                    else throw new Error(data.message);
                                }).catch(error => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: error.message || 'Terjadi kesalahan!'
                                    });
                                });
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
