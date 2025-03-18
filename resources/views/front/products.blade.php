<x-app-layout>
    {{-- Hero Section --}}
    <div class="bg-light">
        <div class="container py-5">
            <div class="text-center">
                <h1 class="display-4 fw-bold mb-3">Our Collections</h1>
                <p class="lead text-muted mb-0">
                    Discover our exclusive collection of luxury fragrances
                </p>
            </div>
        </div>
    </div>

    {{-- Filters Section --}}
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex gap-3">
                    <select class="form-select" style="width: 200px;">
                        <option>All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <select class="form-select" style="width: 200px;">
                        <option>Sort By</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Newest First</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div class="btn-group">
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Products Grid --}}
    <div class="container py-4">
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="position-relative">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150' }}"
                                class="card-img-top" alt="{{ $product->name }}"
                                style="height: 280px; object-fit: cover;">
                            @auth
                                <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-light rounded-circle position-absolute top-0 end-0 m-2 shadow-sm">
                                        <i
                                            class="bi bi-heart{{ auth()->user()->hasInWishlist($product) ? '-fill' : '' }} text-danger"></i>
                                    </button>
                                </form>
                            @endauth
                        </div>
                        <div class="card-body">
                            <h5 class="card-title h6 mb-1">
                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="text-decoration-none text-dark">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            <p class="text-muted small mb-2">{{ $product->category->name }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 pt-0">
                            <button class="btn btn-primary w-100 add-to-cart-btn"
                                data-product-id="{{ $product->id }}">
                                <i class="bi bi-cart-plus me-1"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </div>
    @push('styles')
        <style>
            .page-item.active .page-link {
                background-color: var(--bs-primary);
                border-color: var(--bs-primary);
            }

            .page-link {
                color: var(--bs-primary);
            }

            .page-link:hover {
                color: var(--bs-primary);
            }
        </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.dataset.productId;
                    const currentButton = this;

                    // Disable button while processing
                    currentButton.disabled = true;
                    currentButton.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Adding...';

                    fetch(`{{ route('cart.store', '') }}/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            quantity: 1
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Added to Cart!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500,
                                toast: true,
                                position: 'top-end'
                            });

                            // Update cart count
                            const cartCount = document.querySelector('#cartCount');
                            if (cartCount) {
                                cartCount.textContent = data.cartCount;
                                cartCount.classList.add('bounce');
                                setTimeout(() => cartCount.classList.remove('bounce'), 1000);
                            }
                        } else {
                            throw new Error(data.message || 'Something went wrong');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: error.message,
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                    })
                    .finally(() => {
                        // Re-enable button
                        currentButton.disabled = false;
                        currentButton.innerHTML = '<i class="bi bi-cart-plus me-1"></i> Add to Cart';
                    });
                });
            });
        });
    </script>
    @endpush

    @push('styles')
    <style>
        /* ...existing pagination styles... */

        .bounce {
            animation: bounce 0.5s;
        }

        @keyframes bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        .add-to-cart-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
    </style>
    @endpush
</x-app-layout>
