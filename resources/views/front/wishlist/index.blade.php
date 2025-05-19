<x-app-layout>
    <section class="py-5 bg-light">
        <div class="container">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
                <h2 class="fw-bold mb-0">Wishlist Saya</h2>
                <a href="{{ route('products.index') }}" class="btn btn-outline-dark d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Lanjut Belanja
                </a>
            </div>

            @if($items->count() > 0)
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach($items as $product)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-transform"
                                 style="cursor: pointer;"
                                 onmouseenter="this.style.transform='scale(1.03)'; this.style.boxShadow='0 0.75rem 1.5rem rgba(0,0,0,0.15)';"
                                 onmouseleave="this.style.transform='scale(1)'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0,0,0,0.1)';">

                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                     class="card-img-top" style="height: 220px; object-fit: cover;">

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-2 text-truncate" title="{{ $product->name }}">{{ $product->name }}</h5>
                                    <p class="text-primary fw-semibold mb-3 fs-5">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                                    <div class="mt-auto d-flex justify-content-between align-items-center">

                                        <!-- Tombol Hapus Minimalis (Icon Only) -->
                                        <form action="{{ route('wishlist.toggle', $product) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle p-2 d-flex justify-content-center align-items-center"
                                                    title="Hapus dari Wishlist" style="width: 38px; height: 38px; transition: all 0.3s ease;">
                                                <i class="bi bi-heart-fill fs-5"></i>
                                            </button>
                                        </form>

                                        <!-- Tombol Detail Ghost Button -->
                                        <a href="{{ route('orders.show', $product) }}"
                                           class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1 fw-semibold"
                                           style="transition: background-color 0.3s, color 0.3s;">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-5">
                    {{ $items->links() }}
                </div>

            @else
                <div class="text-center py-5">
                    <i class="bi bi-heart-fill display-1 text-muted mb-3"></i>
                    <h3 class="fw-bold mb-2">Wishlist Kamu Kosong</h3>
                    <p class="text-muted fs-5 mb-4">Simpan produk favoritmu dan temukan kembali kapan saja.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-4 py-2">
                        Jelajahi Produk
                    </a>
                </div>
            @endif

        </div>
    </section>

    <style>
        .transition-transform {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        button.btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
            box-shadow: 0 0.25rem 0.5rem rgba(220, 53, 69, 0.4);
        }
        a.btn-outline-primary:hover {
            background-color: #0d6efd;
            color: white;
            box-shadow: 0 0.25rem 0.5rem rgba(13, 110, 253, 0.4);
        }
    </style>
</x-app-layout>
