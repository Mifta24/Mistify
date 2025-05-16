{{-- filepath: resources/views/front/products/show.blade.php --}}
<x-app-layout>
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Product Images -->
            <div class="col-md-5">
                <div class="position-relative mb-4">
                    <!-- Status badges -->
                    <div class="position-absolute start-0 top-0 m-3 d-flex flex-column gap-1">
                        @if ($product->is_new)
                            <span class="badge bg-primary px-3 py-2 rounded-pill">New</span>
                        @endif
                        @if ($product->is_bestseller)
                            <span class="badge bg-danger px-3 py-2 rounded-pill">Best Seller</span>
                        @endif
                    </div>

                    @auth
                        <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="btn btn-light rounded-circle position-absolute top-0 end-0 m-3 shadow-sm">
                                <i
                                    class="bi bi-heart{{ auth()->user()->hasInWishlist($product) ? '-fill' : '' }} text-danger"></i>
                            </button>
                        </form>
                    @endauth

                    <!-- Main Image -->
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-3 shadow-sm"
                        alt="{{ $product->name }}">
                </div>

                <!-- Scent Notes Diagram -->
                @if (isset($product->scent_notes) && !empty($product->scent_notes))
                    <div class="scent-diagram mt-4 p-3 bg-light rounded-3">
                        <h6 class="fw-bold mb-3">Scent Profile</h6>

                        <div class="row g-2">
                            <!-- Top Notes -->
                            @if (isset($product->scent_notes['top']) && !empty($product->scent_notes['top']))
                                <div class="col-4">
                                    <div class="scent-level text-center p-2">
                                        <div class="scent-icon mb-2">
                                            <i class="bi bi-arrow-up-circle text-primary"></i>
                                        </div>
                                        <h6 class="mb-1 small fw-bold">Top Notes</h6>
                                        <div class="small">
                                            @foreach ($product->scent_notes['top'] as $index => $note)
                                                {{ is_array($note) ? $note['note'] : $note }}{{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Middle Notes -->
                            @if (isset($product->scent_notes['middle']) && !empty($product->scent_notes['middle']))
                                <div class="col-4">
                                    <div class="scent-level text-center p-2">
                                        <div class="scent-icon mb-2">
                                            <i class="bi bi-heart-fill text-danger"></i>
                                        </div>
                                        <h6 class="mb-1 small fw-bold">Heart Notes</h6>
                                        <div class="small">
                                            @foreach ($product->scent_notes['middle'] as $index => $note)
                                                {{ is_array($note) ? $note['note'] : $note }}{{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Base Notes -->
                            @if (isset($product->scent_notes['base']) && !empty($product->scent_notes['base']))
                                <div class="col-4">
                                    <div class="scent-level text-center p-2">
                                        <div class="scent-icon mb-2">
                                            <i class="bi bi-layers-fill text-success"></i>
                                        </div>
                                        <h6 class="mb-1 small fw-bold">Base Notes</h6>
                                        <div class="small">
                                            @foreach ($product->scent_notes['base'] as $index => $note)
                                                {{ is_array($note) ? $note['note'] : $note }}{{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="col-md-7">
                <div class="ps-lg-4">
                    <!-- Brand & Name -->
                    <div class="mb-3">
                        <div class="text-muted mb-1">{{ $product->brand }}</div>
                        <h1 class="h2 fw-bold mb-0">{{ $product->name }}</h1>
                    </div>

                    <!-- Rating -->
                    <div class="d-flex align-items-center mb-3">
                        <div class="rating">
                            @php $avgRating = $product->reviews->avg('rating') ?? 0 @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $avgRating)
                                    <i class="bi bi-star-fill text-warning"></i>
                                @elseif($i - 0.5 <= $avgRating)
                                    <i class="bi bi-star-half text-warning"></i>
                                @else
                                    <i class="bi bi-star text-warning"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="ms-2 small text-muted">
                            {{ $product->reviews->count() }} {{ Str::plural('review', $product->reviews->count()) }}
                        </span>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <h2 class="h3 fw-bold" id="selected-price">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </h2>
                    </div>

                    <!-- Quick Specs -->
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        @if ($product->gender)
                            <div class="spec-item">
                                <span class="fw-medium">Gender:</span>
                                <span>{{ $product->gender }}</span>
                            </div>
                        @endif

                        @if ($product->concentration)
                            <div class="spec-item">
                                <span class="fw-medium">Type:</span>
                                <span>{{ $product->concentration }}</span>
                            </div>
                        @endif

                        @if ($product->fragrance_family)
                            <div class="spec-item">
                                <span class="fw-medium">Family:</span>
                                <span>{{ $product->fragrance_family }}</span>
                            </div>
                        @endif
                    </div>

                    <hr class="my-4">

                    <!-- Add to Cart Form -->
                    <form id="addToCartForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">


                        <!-- Size Selection -->
                        @if (isset($product->sizes) && !empty($product->sizes))
                            <div class="mb-4">
                                <label class="form-label fw-medium">Size</label>
                                <div class="size-options d-flex flex-wrap gap-2">
                                    @foreach ($product->sizes as $sizeItem)
                                        @php
                                            // Handle when sizes is an array of objects with size, price, stock properties
                                            if (is_array($sizeItem) || is_object($sizeItem)) {
                                                $sizeItem = (array) $sizeItem;
                                                $actualSize = $sizeItem['size'] ?? null;
                                                $sizePrice = $sizeItem['price'] ?? $product->price;
                                                $sizeStock = $sizeItem['stock'] ?? 0;
                                            }
                                            // If it's a simple key-value array
                                            else {
                                                $actualSize = $sizeItem;
                                                $sizePrice = $product->price;
                                                $sizeStock = $product->stock;
                                            }

                                            // Skip if size is null/empty
                                            if (empty($actualSize)) {
                                                continue;
                                            }
                                        @endphp
                                        <div class="form-check form-option">
                                            <input class="form-check-input" type="radio" name="size"
                                                id="size-{{ $actualSize }}" value="{{ $actualSize }}"
                                                data-price="{{ $sizePrice }}"
                                                {{ $product->default_size == $actualSize ? 'checked' : '' }}
                                                {{ $sizeStock <= 0 ? 'disabled' : '' }}>
                                            <label
                                                class="form-check-label size-label {{ $sizeStock <= 0 ? 'text-muted' : '' }}"
                                                for="size-{{ $actualSize }}">
                                                {{ $actualSize }}ml
                                                <div class="small">
                                                    Rp {{ number_format($sizePrice, 0, ',', '.') }}
                                                    @if ($sizeStock <= 0)
                                                        <span class="text-danger">(Out of stock)</span>
                                                    @endif
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="selected_size" id="selected-size"
                                    value="{{ $product->default_size }}">
                            </div>
                        @endif

                        <!-- Quantity -->
                        <div class="mb-4">
                            <label class="form-label fw-medium">Quantity</label>
                            <div class="input-group quantity-selector" style="width: 140px;">
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                    id="decrease-qty">-</button>
                                <input type="number" class="form-control text-center" name="quantity" id="quantity"
                                    value="1" min="1" max="{{ $product->stock }}">
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                    id="increase-qty">+</button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 mb-4">
                            <button type="button" id="add-to-cart-btn" class="btn btn-primary flex-grow-1 py-2"
                                data-product-id="{{ $product->id }}">
                                <i class="bi bi-cart-plus me-1"></i> Add to Cart
                            </button>
                        </div>
                    </form>

                    <!-- Description -->
                    <div class="mt-4">
                        <h5 class="fw-bold mb-3">Description</h5>
                        <div class="product-description">
                            {!! $product->description !!}
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div class="mt-4 pt-3 border-top">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-truck fs-4 me-2 text-primary"></i>
                                    <div>
                                        <div class="fw-medium">Free Shipping</div>
                                        <div class="small text-muted">For orders over Rp 300.000</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-shield-check fs-4 me-2 text-primary"></i>
                                    <div>
                                        <div class="fw-medium">100% Authentic</div>
                                        <div class="small text-muted">Guaranteed genuine products</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="reviews-section mt-5 pt-4 border-top">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Reviews</h3>
                @auth
                    @if (!$product->reviews->contains('user_id', auth()->id()))
                        {{-- <a href="{{ route('reviews.create', $product->id) }}" class="btn btn-outline-primary"> --}}
                        Write a Review
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}?redirect_to={{ url()->current() }}" class="btn btn-outline-primary">
                        Login to Review
                    </a>
                @endauth
            </div>

            @if ($product->reviews->count() > 0)
                <div class="row">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div class="bg-light p-4 rounded-3 text-center">
                            <div class="display-4 fw-bold mb-1">{{ number_format($avgRating, 1) }}</div>
                            <div class="stars mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $avgRating)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @elseif($i - 0.5 <= $avgRating)
                                        <i class="bi bi-star-half text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="mb-0 text-muted">Based on {{ $product->reviews->count() }} reviews</p>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="reviews-list">
                            @foreach ($product->reviews->take(3) as $review)
                                <div class="review-item mb-4 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="fw-medium">{{ $review->user->name ?? 'Anonymous' }}</div>
                                        <div class="small text-muted">{{ $review->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @else
                                                <i class="bi bi-star text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div>{{ $review->body }}</div>
                                </div>
                            @endforeach

                            @if ($product->reviews->count() > 3)
                                <div class="text-center mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-secondary">
                                        See all {{ $product->reviews->count() }} reviews
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5 bg-light rounded-3">
                    <i class="bi bi-chat-square-text fs-1 text-muted mb-2"></i>
                    <h5>No Reviews Yet</h5>
                    <p class="text-muted mb-3">Be the first to review this product</p>
                    @auth
                        {{-- <a href="{{ route('reviews.create', $product->id) }}" class="btn btn-primary"> --}}
                        Write a Review
                        </a>
                    @else
                        <a href="{{ route('login') }}?redirect_to={{ url()->current() }}" class="btn btn-primary">
                            Login to Review
                        </a>
                    @endauth
                </div>
            @endif
        </div>

        <!-- Similar Products -->
        <div class="similar-products mt-5 pt-4 border-top">
            <h3 class="fw-bold mb-4">You May Also Like</h3>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($similarProducts ?? [] as $similar)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm product-card">
                            <a href="{{ route('products.show', $similar->slug) }}" class="text-decoration-none">
                                <img src="{{ asset('storage/' . $similar->image) }}" class="card-img-top"
                                    alt="{{ $similar->name }}" style="height: 200px; object-fit: cover;">

                                <div class="card-body text-center">
                                    <h5 class="card-title mb-1 text-dark">{{ $similar->name }}</h5>
                                    <div class="text-muted mb-2">{{ $similar->brand }}</div>
                                    <div class="fw-bold">Rp {{ number_format($similar->price, 0, ',', '.') }}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .size-label {
                border: 1px solid #dee2e6;
                border-radius: 0.5rem;
                padding: 0.5rem 1rem;
                cursor: pointer;
                transition: all 0.2s;
                text-align: center;
            }

            .form-check-input:checked+.size-label {
                border-color: var(--bs-primary);
                background-color: rgba(var(--bs-primary-rgb), 0.1);
            }

            .quantity-selector .form-control {
                border-left: 0;
                border-right: 0;
            }

            .spec-item {
                padding: 0.25rem 0.75rem;
                background-color: #f8f9fa;
                border-radius: 0.5rem;
                font-size: 0.9rem;
            }

            .spec-item span:first-child {
                margin-right: 0.25rem;
            }

            .product-card {
                transition: transform 0.2s ease;
            }

            .product-card:hover {
                transform: translateY(-5px);
            }

            .form-option {
                margin: 0;
            }

            .form-option .form-check-input {
                display: none;
            }

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
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Size selection
                const sizeInputs = document.querySelectorAll('input[name="size"]');
                const selectedSizeInput = document.getElementById('selected-size');
                const selectedPriceDisplay = document.getElementById('selected-price');

                sizeInputs.forEach(input => {
                    input.addEventListener('change', function() {
                        selectedSizeInput.value = this.value;

                        const price = Number(this.dataset.price);
                        selectedPriceDisplay.textContent = 'Rp ' + price.toLocaleString('id-ID');
                    });
                });

                // Quantity selector
                const quantityInput = document.getElementById('quantity');
                const decreaseBtn = document.getElementById('decrease-qty');
                const increaseBtn = document.getElementById('increase-qty');

                decreaseBtn.addEventListener('click', function() {
                    const currentValue = parseInt(quantityInput.value);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                    }
                });

                increaseBtn.addEventListener('click', function() {
                    const currentValue = parseInt(quantityInput.value);
                    const maxStock = parseInt(quantityInput.getAttribute('max') || 999);
                    if (currentValue < maxStock) {
                        quantityInput.value = currentValue + 1;
                    } else {
                        // Show notification if max stock reached
                        Swal.fire({
                            icon: 'warning',
                            title: 'Maximum stock reached',
                            text: 'You have reached the maximum available stock for this product.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                });

                // Add direct input validation
                quantityInput.addEventListener('change', function() {
                    let value = parseInt(this.value);
                    const maxStock = parseInt(this.getAttribute('max') || 999);

                    // Ensure value is a number and within bounds
                    if (isNaN(value) || value < 1) {
                        value = 1;
                    } else if (value > maxStock) {
                        value = maxStock;

                        // Show notification if max stock reached through direct input
                        Swal.fire({
                            icon: 'warning',
                            title: 'Maximum stock reached',
                            text: 'You have reached the maximum available stock for this product.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }

                    this.value = value;
                });

                // Add to cart functionality (consistent with products.blade.php)
                const addToCartBtn = document.getElementById('add-to-cart-btn');

                addToCartBtn.addEventListener('click', function() {
                    const productId = this.dataset.productId;
                    const quantity = document.getElementById('quantity').value;
                    const size = document.getElementById('selected-size').value;

                    // Extract the price from selected size input's data-price attribute
                    const selectedSizeInput = document.querySelector(`input[name="size"][value="${size}"]`);
                    const price = selectedSizeInput ? selectedSizeInput.dataset.price :
                        document.getElementById('selected-price').textContent.replace('Rp ', '').replace(/\./g,
                            '');

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
                                quantity: quantity,
                                size: size,
                                price: price
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
        </script>
    @endpush
</x-app-layout>
