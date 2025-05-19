{{-- filepath: c:\laragon\www\Mistify\resources\views\front\cart.blade.php --}}
<x-app-layout>
    <div class="container py-5">
        <h1 class="display-5 fw-bold mb-4">Keranjang Belanja</h1>

        @if ($cartItems && count($cartItems) > 0)
            <div class="row g-4">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-0">
                            @foreach ($cartItems as $id => $item)
                                <div class="row g-3 p-4 border-bottom">
                                    <div class="col-3">
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                            class="img-fluid rounded">
                                    </div>
                                    <div class="col-9">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="mb-1">
                                                    <a href="{{ route('products.show', $item['slug']) }}"
                                                        class="link-dark text-decoration-none">
                                                        {{ $item['name'] }}
                                                    </a>
                                                </h5>
                                                <div class="d-flex gap-2 align-items-center mb-2">
                                                    <small class="text-muted">{{ $item['category'] }}</small>

                                                    @if (isset($item['size']))
                                                        <span
                                                            class="badge bg-light text-dark border">{{ $item['size'] }}ml</span>
                                                    @endif

                                                    @if (isset($item['brand']))
                                                        <small class="text-muted">{{ $item['brand'] }}</small>
                                                    @endif
                                                </div>

                                                <!-- Individual price -->
                                                <div class="text-muted small">
                                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                    <span class="text-secondary">x {{ $item['quantity'] }}</span>
                                                </div>
                                            </div>

                                            <!-- Total price for this item -->
                                            <h5 class="text-primary">Rp
                                                {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                            </h5>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div class="input-group input-group-sm" style="width: 130px;">
                                                <button class="btn btn-outline-secondary update-quantity" type="button"
                                                    data-id="{{ $id }}" data-action="decrease">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <input type="text" class="form-control text-center bg-white"
                                                    value="{{ $item['quantity'] }}" readonly>
                                                <button class="btn btn-outline-secondary update-quantity" type="button"
                                                    data-id="{{ $id }}" data-action="increase">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>


                                            <div class="d-flex gap-2">
                                                @if (isset($item['sizes']) && !empty($item['sizes']))
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                            type="button" id="sizeDropdown-{{ $id }}"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            {{ $item['size'] }}ml
                                                        </button>
                                                        <ul class="dropdown-menu"
                                                            aria-labelledby="sizeDropdown-{{ $id }}">
                                                            @foreach ($item['sizes'] as $sizeItem)
                                                                @php
                                                                    // Handle when sizes is an array of objects with size, price, stock properties
                                                                    if (is_array($sizeItem) || is_object($sizeItem)) {
                                                                        $sizeItem = (array) $sizeItem;
                                                                        $sizeValue = $sizeItem['size'] ?? null;
                                                                        $sizePrice =
                                                                            $sizeItem['price'] ?? $item['price'];
                                                                        $sizeStock = $sizeItem['stock'] ?? 0;
                                                                    }
                                                                    // If it's a simple key-value array
                                                                    else {
                                                                        $sizeValue = $sizeItem;
                                                                        $sizePrice = $item['price'];
                                                                        $sizeStock = 10; // Default to 10 if stock not specified
                                                                    }

                                                                    // Skip if size is null/empty
                                                                    if (empty($sizeValue)) {
                                                                        continue;
                                                                    }
                                                                @endphp

                                                                @if ($sizeStock > 0)
                                                                    <li>
                                                                        <button
                                                                            class="dropdown-item change-size {{ $item['size'] == $sizeValue ? 'active' : '' }}"
                                                                            data-id="{{ $id }}"
                                                                            data-size="{{ $sizeValue }}"
                                                                            data-price="{{ $sizePrice }}">
                                                                            {{ $sizeValue }}ml - Rp
                                                                            {{ number_format($sizePrice, 0, ',', '.') }}
                                                                        </button>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                                <button
                                                    class="btn btn-sm btn-outline-danger remove-item d-flex align-items-center gap-1"
                                                    data-id="{{ $id }}">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </div>
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
                                <span>Subtotal ({{ array_sum(array_column($cartItems, 'quantity')) }} item)</span>
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

                            <a href="{{ route('checkout.index') }}" class="btn btn-dark w-100 mt-4">Lanjut ke
                                Checkout</a>
                            <div class="text-center mt-3">
                                <a href="{{ route('products.index') }}" class="text-decoration-none">
                                    <i class="bi bi-arrow-left"></i> Lanjut Belanja
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Promo code -->
                    <div class="card border-0 shadow-sm rounded-4 mt-3">
                        <div class="card-body">
                            <h5 class="mb-3">Ada Kode Promo?</h5>
                            <form id="couponForm" class="d-flex gap-2">
                                <input type="text" class="form-control" name="coupon" id="coupon"
                                    placeholder="Masukkan kode promo">
                                <button type="submit" class="btn btn-outline-dark">Gunakan</button>
                            </form>
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
            document.addEventListener('DOMContentLoaded', function() {
                // Update quantity logic
                document.querySelectorAll('.update-quantity').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.dataset.id;
                        const action = this.dataset.action;
                        const input = this.parentElement.querySelector('input');
                        let quantity = parseInt(input.value);

                        quantity = action === 'increase' ? quantity + 1 : Math.max(1, quantity - 1);

                        updateCart(id, {
                            quantity
                        });
                    });
                });

                // Remove item logic
                document.querySelectorAll('.remove-item').forEach(button => {
                    button.addEventListener('click', function() {
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
                                        text: error.message ||
                                            'Terjadi kesalahan!'
                                    });
                                });
                            }
                        });
                    });
                });

                // Change size logic
                document.querySelectorAll('.change-size').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.dataset.id;
                        const size = this.dataset.size;

                        updateCart(id, {
                            size
                        });
                    });
                });

                // Coupon form submission
                const couponForm = document.getElementById('couponForm');
                if (couponForm) {
                    couponForm.addEventListener('submit', function(event) {
                        event.preventDefault();
                        const couponCode = document.getElementById('coupon').value;

                        if (!couponCode.trim()) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Input Required',
                                text: 'Please enter a promo code',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            return;
                        }

                        fetch('/cart/apply-coupon', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    code: couponCode
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Promo applied!',
                                        text: data.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            });
                    });
                }

                // Common update cart function
                function updateCart(id, data) {
                    fetch(`/cart/update/${id}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                location.reload();
                            } else {
                                throw new Error(data.message);
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: error.message || 'Terjadi kesalahan!',
                                toast: true,
                                position: 'top-end',
                                timer: 3000
                            });
                        });
                }
            });
        </script>
    @endpush
</x-app-layout>
