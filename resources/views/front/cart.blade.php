<x-app-layout>
    <div class="container py-5">
        <h1 class="display-5 fw-bold mb-4">Shopping Cart</h1>

        @if($cartItems && count($cartItems) > 0)
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            @foreach($cartItems as $id => $item)
                                <div class="row p-4 {{ !$loop->last ? 'border-bottom' : '' }}">
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/' . $item['image']) }}"
                                             alt="{{ $item['name'] }}"
                                             class="img-fluid rounded">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h5 class="mb-1">
                                                    <a href="{{ route('products.show', $item['slug']) }}"
                                                       class="text-decoration-none text-dark">
                                                        {{ $item['name'] }}
                                                    </a>
                                                </h5>
                                                <p class="text-muted mb-2">{{ $item['category'] }}</p>
                                            </div>
                                            <h5 class="text-primary mb-0">
                                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                            </h5>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div class="input-group" style="width: 140px;">
                                                <button class="btn btn-outline-secondary update-quantity"
                                                        type="button"
                                                        data-id="{{ $id }}"
                                                        data-action="decrease">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <input type="text" class="form-control text-center"
                                                       value="{{ $item['quantity'] }}" readonly>
                                                <button class="btn btn-outline-secondary update-quantity"
                                                        type="button"
                                                        data-id="{{ $id }}"
                                                        data-action="increase">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>

                                            <button type="button"
                                                    class="btn btn-link text-danger text-decoration-none remove-item"
                                                    data-id="{{ $id }}">
                                                <i class="bi bi-trash me-1"></i>
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Order Summary</h5>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Subtotal</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Shipping</span>
                                <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <strong>Total</strong>
                                <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                            </div>
                            <a href="{{ route('checkout ') }}"
                               class="btn btn-primary w-100 mb-3">
                                Proceed to Checkout
                            </a>
                            <div class="text-center">
                                <a href="{{ route('products.index') }}" class="text-decoration-none">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-cart-x display-1 text-muted mb-4"></i>
                <h3 class="h4 mb-2">Your cart is empty</h3>
                <p class="text-muted mb-4">Start adding some items to your cart!</p>
                <a href="{{ route('products.index') }}"
                   class="btn btn-primary">
                    View Products
                </a>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update Quantity
            document.querySelectorAll('.update-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const action = this.dataset.action;
                    const input = this.parentElement.querySelector('input');
                    let quantity = parseInt(input.value);

                    quantity = action === 'increase' ? quantity + 1 : quantity - 1;

                    fetch(`/cart/update/${id}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ quantity })
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
                            text: error.message || 'Something went wrong!'
                        });
                    });
                });
            });

            // Remove Item
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/cart/remove/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
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
                                    text: error.message || 'Something went wrong!'
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
