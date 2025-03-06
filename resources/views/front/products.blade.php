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
                        @foreach($categories as $category)
                            <option  value="{{ $category->id }}">{{ $category->name }}</option>
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
            @foreach($products as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150' }}"
                             class="card-img-top"
                             {{-- alt="{{ $product->name }}" --}}
                             style="height: 280px; object-fit: cover;">
                        <button class="btn btn-light rounded-circle position-absolute top-0 end-0 m-2 shadow-sm">
                            <i class="bi bi-heart text-danger"></i>
                        </button>
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
                        <button class="btn btn-primary w-100" wire:click="addToCart({{ $product->id }})">
                            <i class="bi bi-cart-plus me-1"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Pagination --}}
    <div class="container py-4">
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
