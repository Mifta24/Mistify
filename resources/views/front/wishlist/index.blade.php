<x-app-layout>
    <section class="py-5 bg-light">
        <div class="container">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="fw-bold mb-0">Wishlist Saya</h2>
                <a href="{{ route('products.index') }}" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left me-2"></i> Lanjut Belanja
                </a>
            </div>

            @if($items->count() > 0)
                <!-- Produk dalam Wishlist -->
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach($items as $product)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-4 hover-shadow">
                                <img src="{{ $product->image_url }}" class="card-img-top rounded-top-4"
                                     alt="{{ $product->name }}" style="height: 220px; object-fit: cover;">

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-1">{{ $product->name }}</h5>
                                    <p class="text-primary fw-semibold mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                                    <div class="mt-auto d-flex justify-content-between align-items-center">
                                        <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus dari Wishlist">
                                                <i class="bi bi-heart-fill"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('orders.show', $product) }}" class="btn btn-outline-dark btn-sm">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $items->links() }}
                </div>
            @else
                <!-- Wishlist Kosong -->
                <div class="text-center py-5">
                    <i class="bi bi-heart display-1 text-muted mb-3"></i>
                    <h3 class="fw-bold">Wishlist Kamu Kosong</h3>
                    <p class="text-muted mb-4">Simpan produk favoritmu dan temukan kembali kapan saja.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary px-4 py-2">
                        Jelajahi Produk
                    </a>
                </div>
            @endif
        </div>
    </section>

    <style>
        .hover-shadow:hover {
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1) !important;
            transition: all 0.3s ease-in-out;
        }
    </style>
</x-app-layout>
