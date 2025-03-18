<x-app-layout>
    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}"
                        class="text-decoration-none">Products</a></li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <!-- Product Images -->
            <div class="col-lg-6">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="card border-0 shadow-sm">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                            alt="{{ $product->name }}" style="height: 500px; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="mb-4">
                    <h1 class="h2 fw-bold mb-1">{{ $product->name }}</h1>
                    <p class="text-muted mb-2">{{ $product->category->name }}</p>
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star-fill {{ $i <= 4 ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                        </div>
                        <span class="text-muted small">(24 Reviews)</span>
                    </div>
                    <h2 class="text-primary h3 mb-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </h2>
                </div>

                <div class="mb-4">
                    <h5 class="fw-bold mb-3">Description</h5>
                    <p class="text-muted">{{ $product->description }}</p>
                </div>

                <div class="mb-4">
                    <h5 class="fw-bold mb-3">Quantity</h5>
                    <div class="d-flex align-items-center gap-3">
                        <div class="input-group" style="width: 140px;">
                            <button class="btn btn-outline-secondary" type="button" wire:click="decrementQuantity">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="text" class="form-control text-center" wire:model="quantity" readonly>
                            <button class="btn btn-outline-secondary" type="button" wire:click="incrementQuantity">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <span class="text-muted small">
                            {{ $product->stock }} pieces available
                        </span>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-lg" id="addToCartBtn">
                        <i class="bi bi-cart-plus me-2"></i>
                        Add to Cart
                    </button>
                    @auth
                    <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-heart{{ auth()->user()->hasInWishlist($product) ? '-fill' : '' }}"></i>
                        </button>
                    </form>
                @endauth
                    {{-- <button class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-heart me-2"></i>
                        Add to Wishlist
                    </button> --}}
                </div>

                <!-- Product Details Accordion -->
                <div class="accordion mt-5" id="productAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseDetails">
                                Product Details
                            </button>
                        </h2>
                        <div id="collapseDetails" class="accordion-collapse collapse show"
                            data-bs-parent="#productAccordion">
                            <div class="accordion-body">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <span class="fw-bold">Category:</span>
                                        {{ $product->category->name }}
                                    </li>
                                    <li class="mb-2">
                                        <span class="fw-bold">Fragrance Family:</span>
                                        Oriental Woody
                                    </li>
                                    <li class="mb-2">
                                        <span class="fw-bold">Size:</span>
                                        100ml
                                    </li>
                                    <li>
                                        <span class="fw-bold">SKU:</span>
                                        {{ $product->id }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="mt-5 pt-5 border-top">
            <h3 class="mb-4">You May Also Like</h3>
            <div class="row g-4">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col-6 col-md-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('storage/' . $relatedProduct->image) }}" class="card-img-top"
                                alt="{{ $relatedProduct->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title h6 mb-1">
                                    <a href="{{ route('products.show', $relatedProduct) }}"
                                        class="text-decoration-none text-dark">
                                        {{ $relatedProduct->name }}
                                    </a>
                                </h5>
                                <p class="text-muted small mb-2">{{ $relatedProduct->category->name }}</p>
                                <span class="fw-bold text-primary">
                                    Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>





    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const addToCartBtn = document.getElementById('addToCartBtn');
                const quantityInput = document.querySelector('input[wire\\:model="quantity"]');

                addToCartBtn.addEventListener('click', function() {
                    const quantity = quantityInput ? quantityInput.value : 1;

                    fetch('{{ route('cart.store', $product->id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                quantity: quantity
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // Show success message
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                // Update cart count in navbar
                                const cartCount = document.querySelector('#cartCount');
                                if (cartCount) {
                                    cartCount.textContent = data.cartCount;
                                }
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
        </script>
    @endpush

</x-app-layout>
