<x-app-layout>
    {{-- Hero Section --}}
    <div class="bg-light">
        <div class="container py-5">
            <div class="text-center">
                <h1 class="display-4 fw-bold mb-3">Koleksi Kami</h1>
                <p class="lead text-muted mb-0 fst-italic">
                   Temukan koleksi wewangian mewah eksklusif kami
                </p>
            </div>
        </div>
    </div>

    {{-- Filters Section --}}
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex gap-3 flex-wrap">
                    <div class="search-container" style="width: 250px;">
                        <form method="GET" action="{{ route('products.index') }}" id="searchForm">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search products..."
                                    name="search" id="searchInput" value="{{ request()->get('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <select class="form-select" id="categoryFilter" style="width: 200px;">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request()->get('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <select class="form-select" id="sortFilter" style="width: 200px;">
                    <option value="">Sort By</option>
                    <option value="price_asc" {{ request()->get('sort') == 'price_asc' ? 'selected' : '' }}>
                        Price: Low to High
                    </option>
                    <option value="price_desc" {{ request()->get('sort') == 'price_desc' ? 'selected' : '' }}>
                        Price: High to Low
                    </option>
                    <option value="newest" {{ request()->get('sort') == 'newest' ? 'selected' : '' }}>
                        Newest First
                    </option>
                    </select>
                    @if (request()->has('category') || request()->has('sort') || request()->has('search'))
                        <button type="button" id="resetFilters" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i> Reset Filters
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Products Grid --}}
    <div class="container py-4">
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden transition-all hover:shadow-xl hover:bg-light">
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
                            <button class="btn btn-outline-dark btn-lg w-100 add-to-cart-btn"
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
                        currentButton.innerHTML =
                            '<span class="spinner-border spinner-border-sm me-1"></span> Adding...';

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
                                        setTimeout(() => cartCount.classList.remove('bounce'),
                                            1000);
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
                                currentButton.innerHTML =
                                    '<i class="bi bi-cart-plus me-1"></i> Add to Cart';
                            });
                    });
                });

                // Improved filter functionality
                const searchInput = document.getElementById('searchInput');
                const searchForm = document.getElementById('searchForm');
                const categoryFilter = document.getElementById('categoryFilter');
                const sortFilter = document.getElementById('sortFilter');
                const resetFiltersBtn = document.getElementById('resetFilters');
                const productsGrid = document.querySelector('.row.g-4');
                let isLoading = false;

                function applyFilters() {
                    if (isLoading) return;
                    isLoading = true;

                    // Show loading state
                    productsGrid.setAttribute('data-loading', 'true');

                    // Build URL with filters
                    const params = new URLSearchParams();

                    if (searchInput.value) {
                        params.set('search', searchInput.value);
                    }

                    if (categoryFilter.value) {
                        params.set('category', categoryFilter.value);
                    }

                    if (sortFilter.value) {
                        params.set('sort', sortFilter.value);
                    }

                    // Navigate to filtered URL
                    window.location.href = `${window.location.pathname}?${params.toString()}`;
                }

                // Add event listeners
                categoryFilter?.addEventListener('change', applyFilters);
                sortFilter?.addEventListener('change', applyFilters);

                // Handle search form submission
                searchForm?.addEventListener('submit', function(e) {
                    e.preventDefault();
                    applyFilters();
                });

                // Reset filters button
                resetFiltersBtn?.addEventListener('click', function() {
                    productsGrid.setAttribute('data-loading', 'true');
                    window.location.href = window.location.pathname;
                });

                // Add active class to filters if they have values
                if (searchInput && searchInput.value) {
                    searchInput.classList.add('filter-active');
                }
                if (categoryFilter && categoryFilter.value) {
                    categoryFilter.classList.add('filter-active');
                }
                if (sortFilter && sortFilter.value) {
                    sortFilter.classList.add('filter-active');
                }
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

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.2);
                }
            }

            .add-to-cart-btn:disabled {
                opacity: 0.7;
                cursor: not-allowed;
            }

            .row.g-4 {
                transition: opacity 0.3s ease;
            }

            .filter-active {
                background-color: rgba(var(--bs-primary-rgb), 0.1);
                border-color: var(--bs-primary);
            }

            .form-select {
                transition: all 0.3s ease;
            }

            .form-select:focus {
                border-color: var(--bs-primary);
                box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
            }

            [data-loading] {
                pointer-events: none;
                opacity: 0.5;
                position: relative;
            }

            [data-loading]::after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 40px;
                height: 40px;
                margin-top: -20px;
                margin-left: -20px;
                border: 4px solid rgba(var(--bs-primary-rgb), 0.3);
                border-top-color: var(--bs-primary);
                border-radius: 50%;
                animation: spinner 0.8s linear infinite;
            }

            @keyframes spinner {
                to {
                    transform: rotate(360deg);
                }
            }
        </style>
    @endpush

</x-app-layout>
