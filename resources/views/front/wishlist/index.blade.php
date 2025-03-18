<x-app-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">My Wishlist</h1>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Continue Shopping
            </a>
        </div>

        @if($items->count() > 0)
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($items as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ $product->image_url }}"
                                 class="card-img-top"
                                 alt="{{ $product->name }}"
                                 style="height: 200px; object-fit: cover;">

                            <div class="card-body">
                                <h5 class="card-title mb-1">{{ $product->name }}</h5>
                                <p class="text-primary mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                                <div class="d-flex gap-2">
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm w-100">
                                            <i class="bi bi-cart-plus me-1"></i> Add to Cart
                                        </button>
                                    </form>
                                    <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-heart-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $items->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-heart display-1 text-muted mb-4"></i>
                <h3 class="h4 mb-2">Your wishlist is empty</h3>
                <p class="text-muted mb-4">Save items you love to your wishlist!</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
