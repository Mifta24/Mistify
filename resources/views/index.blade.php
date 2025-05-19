<x-app-layout>

    <div class="hero-section container-fluid ">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="display-4 fw-bold">We care about Fragrances</h1>
            <p class="lead text-light mb-4 fst-italic">
                "Parfum adalah seni menciptakan kesan unik dan tahan lama pada indra penciuman"
            </p>
            <a href="#" class="btn btn-custom">Lihat Lebih Banyak</a>
        </div>
    </div>

    <div class="brand-section container-2 py-5 bg-light rounded-4 ">
        <!-- Title and Subtitle Section -->
        <div class="text-center mb-5">
            <h3 class="fw-bold text-black" style="font-size: 1.5rem;">FRANADA PARFUM INDONESIA</h3>
            <p class="text-dark" style="max-width: 800px; margin: 0 auto;">
                Franada Parfum sebagai pelopor berkembangnya fashion pada khususnya wewangian atau parfum sudah berdiri
                sejak tahun 2015, menilai bahwa parfum kini semakin banyak diminati dan diterima dikalangan remaja,
                dewasa dan eksekutif. Maka dari itu melalui Franada Parfum kami berikan solusi hebat dan hemat untuk
                berbelanja parfum.
            </p>
        </div>


        <div
            class="row d-flex flex-column flex-lg-row align-items-center justify-content-center text-center text-lg-start">
            <!-- Left Text Section -->
            <div class="col-lg-4 px-5 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold text-dark elegant-font">Franada Parfum</h1>
                <p class="lead text-secondary fs-4 fst-italic">Luxury Defined. One Drop at a Time.</p>
            </div>

            <!-- Center Image Section -->
            <div class="col-lg-4 d-flex justify-content-center mb-4 mb-lg-0">
                <div class="w-full md:w-1/2 flex justify-center">
                    <div class="relative w-80 h-80 md:w-96 md:h-96">
                        <img src="{{ asset('images/esse.jpg') }}" alt="Profile Image"
                            class="absolute inset-0 w-full h-full object-cover shadow-2xl border-8 border-gray-300"
                            style="clip-path: url(#blob); " />

                        <svg width="0" height="0">
                            <defs>
                                <clipPath id="blob" clipPathUnits="objectBoundingBox">
                                    <path
                                        d="M0.42,-0.625C0.543,-0.549,0.653,-0.451,0.727,-0.328C0.802,-0.205,0.84,-0.058,0.824,0.091C0.808,0.24,0.739,0.389,0.625,0.487C0.511,0.586,0.352,0.635,0.202,0.657C0.052,0.68,-0.09,0.676,-0.232,0.638C-0.374,0.601,-0.515,0.53,-0.589,0.411C-0.664,0.293,-0.673,0.126,-0.688,-0.063C-0.704,-0.252,-0.726,-0.462,-0.627,-0.543C-0.528,-0.624,-0.309,-0.577,-0.14,-0.603C0.028,-0.629,0.215,-0.725,0.42,-0.625Z"
                                        transform="scale(1.1) translate(0.05, 0.05)"></path>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Right Text Section -->
            <div class="col-lg-4 px-5">
                <h2 class="fw-semibold display-8 mb-3">Mengapa Berbelanja dengan Franada Parfum?</h2>
                <p class="text-muted fs-5">Franada Parfum hadir untuk kamu yang cari parfum berkualitas tanpa harus
                    keluar biaya mahal. Kami pilih aroma terbaik, pastikan ketahanan wanginya, dan selalu utamakan
                    kepuasan pelanggan. Dengan koleksi lengkap dan pelayanan cepat, belanja parfum jadi lebih mudah dan
                    menyenangkan di Franada Parfum.</p>
                <a href="#" class="btn btn-outline-dark btn-lg rounded-pill px-5 py-2 mt-3 shadow-sm">Baca Lebih
                    Banyak</a>
            </div>
        </div>
    </div>

    <div class="services-section container-3  mx-1">
        <!-- Title Section -->
        <h1 class="text-center mb-5 large-text fw-bold text-dark">Pelayanan kami</h1>

        <!-- Services Cards Container -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <!-- Service Card 1: Pengiriman Cepat -->
            <div class="col">
                <div class="service-card text-center p-4 bg-white rounded-4 shadow-lg transition-all hover:shadow-xl hover:bg-light"
                    style="height: 350px;">
                    <i class="bi bi-truck" style="font-size: 2.5rem; color: #00cf00;"></i>
                    <h2 class="h5 fw-semibold text-dark">Pengiriman Cepat</h2>
                    <p class="text-muted fs-6" style="flex-grow: 1;">Kami memprioritaskan kenyamanan pelanggan dengan
                        memproses pesanan segera setelah konfirmasi. Parfum dikirim menggunakan jasa terpercaya agar
                        sampai tepat waktu dan dalam kondisi terbaik.</p>
                </div>
            </div>

            <!-- Service Card 2: Gifting -->
            <div class="col">
                <div class="service-card text-center p-4 bg-white rounded-4 shadow-lg transition-all hover:shadow-xl hover:bg-light"
                    style="height: 350px;">
                    <i class="bi bi-gift" style="font-size: 2.5rem; color: #ff0000;"></i>
                    <h2 class="h5 fw-semibold text-dark">Gifting</h2>
                    <p class="text-muted fs-6" style="flex-grow: 1;">Franada Parfum menyediakan layanan hadiah dengan
                        kemasan elegan. Parfum pilihanmu siap dikirim sebagai hadiah spesial untuk orang tersayang.</p>
                </div>
            </div>

            <!-- Service Card 3: Member Eksklusif -->
            <div class="col">
                <div class="service-card text-center p-4 bg-white rounded-4 shadow-lg transition-all hover:shadow-xl hover:bg-light"
                    style="height: 350px;">
                    <i class="bi bi-stars" style="font-size: 2.5rem; color: #ffee00;"></i>
                    <h2 class="h5 fw-semibold text-dark">Member Eksklusif</h2>
                    <p class="text-muted fs-6" style="flex-grow: 1;">Bergabung sebagai member dan nikmati diskon khusus,
                        akses lebih awal ke produk terbaru, serta penawaran eksklusif lainnya hanya untuk pelanggan
                        setia.</p>
                </div>
            </div>

            <!-- Service Card 4: Custom Parfum -->
            <div class="col">
                <div class="service-card text-center p-4 bg-white rounded-4 shadow-lg transition-all hover:shadow-xl hover:bg-light"
                    style="height: 350px;">
                    <i class="bi bi-palette" style="font-size: 2.5rem; color: #0026ff;"></i>
                    <h2 class="h5 fw-semibold text-dark">Custom Parfum</h2>
                    <p class="text-muted fs-6" style="flex-grow: 1;">Tunjukkan keunikanmu dengan parfum custom! Pilih
                        aroma favorit dan biarkan kami meracik parfum yang mencerminkan kepribadianmu secara eksklusif.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="products-section container-4 mx-3">
        <!-- Judul dan Tombol di atas -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div class="w-100 text-center">
                <h1 class="big-text">Produk best seller</h1>
                <p class="mb-0">"Inilah parfum andalan yang sering jadi love at first scent. Populer, berkarakter, dan
                    bikin kamu lebih memorable."</p>
            </div>
            <div class="ms-auto mt-3 mt-md-0">
                <a href="{{ route('products.index') }}"
                    class="btn btn-outline-dark btn-lg rounded-pill px-4 py-1 mt-2 shadow-sm text-decoration-none">
                    <i class="bi bi-arrow-right-circle"></i>
                    <span>Lihat semua</span>
                </a>
            </div>
        </div>

        <!-- Daftar Produk Best Seller -->
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-4">
    @if (isset($products) && count($products) > 0)
        @foreach ($products as $product)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative bg-white transition-all" style="transition: all 0.3s ease-in-out;">
                    <!-- Best Seller Badge -->
                    <div class="position-absolute top-0 end-0 m-3">
                                <div class="badge bg-danger fs-6 p-2 rounded-pill">Best Seller</div>
                            </div>

                    <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="img-fluid object-fit-cover w-100"
                             style="height: 400px; object-fit: cover; transition: transform 0.3s ease-in-out;"
                             onmouseover="this.style.transform='scale(1.02)';"
                             onmouseout="this.style.transform='scale(1)';">

                        <div class="card-body text-center">
                            <h5 class="card-title text-dark fw-semibold">{{ $product->name }}</h5>
                            <p class="card-text text-primary fw-bold fs-5">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            <div class="text-muted small">
                                <i class="bi bi-bag-check me-1"></i> Terjual {{ $product->total_sold ?? 0 }}+
                            </div>

                            <div class="d-flex justify-content-center gap-3 mt-3">
                                <button class="btn btn-sm btn-outline-primary rounded-circle shadow-sm quick-view-btn"
                                        data-product-id="{{ $product->id }}" title="Quick View">
                                    <i class="bi bi-eye"></i>
                                </button>

                                @auth
                                    <button class="btn btn-sm btn-outline-success rounded-circle shadow-sm add-to-cart-btn"
                                            data-product-id="{{ $product->id }}" title="Tambah ke Keranjang">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>

                                    <button class="btn btn-sm btn-outline-danger rounded-circle shadow-sm add-to-wishlist-btn"
                                            data-product-id="{{ $product->id }}" title="Favoritkan">
                                        <i class="bi bi-heart"></i>
                                    </button>
                                @endauth
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="alert alert-warning text-center rounded-4 shadow-sm" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>Produk belum tersedia untuk saat ini.
            </div>
        </div>
    @endif
</div>

    </div>



    <div class="testimonial-section">
        <h1 class="large-text text-center mb-5">Apa kata pelanggan kami?</h1>
        <div class="testimonial-carousel">
            @if (isset($testimonials) && count($testimonials) > 0)
                <div class="swiper testimonial-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="testimonial">
                                    <div class="quote">"{{ $testimonial->comment }}"</div>
                                    <div class="author">-
                                        {{ isset($testimonial->user) ? $testimonial->user->name : $testimonial->author }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            @else
                <div class="no-testimonials">
                    <p>No testimonials available at the moment.</p>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
