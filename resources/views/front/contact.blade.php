<x-app-layout>
    {{-- Hero Section with Parallax Effect --}}
    <div class="hero-section container-1 bg-gradient-to-r from-primary-color to-accent-color text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center">
                <h1 class="large-text font-bold mb-4 elegant">Hubungi Kami</h1>
                <p class="tagline max-w-3xl mx-auto text-lg">Kami siap membantu menjawab pertanyaan dan memberikan saran terbaik untuk kebutuhan parfum Anda</p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                <path fill="#ffffff" fill-opacity="1" d="M0,128L48,133.3C96,139,192,149,288,170.7C384,192,480,224,576,218.7C672,213,768,171,864,170.7C960,171,1056,213,1152,213.3C1248,213,1344,171,1392,149.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container mx-auto px-4 py-12">
        {{-- Contact Form Section --}}
        <div class="container py-5">
        <div class="row justify-content-center g-4">
            <!-- Form Kirim Pesan -->
            <div class="col-md-6 col-lg-6 p-4 bg-white rounded-4 shadow-sm">
            <h2 class="big-text elegant text-primary-color mb-2 text-center">Kirim Pesan</h2>
            <div class="mb-4 mx-auto" style="width: 60px; height: 4px; background-color: #d7bfff;"></div>
            <p class="text-muted mb-4 text-center">
                Apakah Anda memiliki pertanyaan tentang produk kami, membutuhkan rekomendasi parfum, atau ingin memberikan masukan? Isi formulir di bawah ini, dan tim kami akan menghubungi Anda sesegera mungkin.
            </p>
            <form>
                <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="email@example.com">
                </div>
                </div>
                <div class="mb-3">
                <label class="form-label">Subjek</label>
                <input type="text" class="form-control" placeholder="Subjek pesan Anda">
                </div>
                <div class="mb-3">
                <label class="form-label">Pesan</label>
                <textarea class="form-control" rows="4" placeholder="Tulis pesan Anda di sini..."></textarea>
                </div>
                <div class="text-center">
                <button type="submit" class="btn btn-style">
                    <i class="bi bi-send me-2"></i>Kirim Pesan
                </button>
                </div>
            </form>
            </div>

            <!-- Informasi Kontak -->
            <div class="col-md-6 col-lg-5 bg-primary-color text-dark p-4 rounded-4 shadow-sm">
            <h2 class="big-text elegant mb-3">Informasi Kontak</h2>
            <hr class="border-light mb-4">

            <div class="mb-3 d-flex align-items-start">
                <i class="bi bi-geo-alt-fill me-3 fs-5"></i>
                <div>
                <strong>Alamat:</strong><br>
                Pondok Makmur Blok CS 4, Jl. Raya Kutabumi Blok CD2 No.15, Kuta Baru, Kec. Ps. Kemis, Kabupaten Tangerang, Banten 15560
                </div>
            </div>

            <div class="mb-3 d-flex align-items-start">
                <i class="bi bi-telephone-fill me-3 fs-5"></i>
                <div>
                <strong>Telepon:</strong><br>
                (+62) 81287195398

                </div>
            </div>

            <div class="mb-3 d-flex align-items-start">
                <i class="bi bi-envelope-fill me-3 fs-5"></i>
                <div>
                <strong>Email:</strong><br>
                franada@gmail.com
                </div>
            </div>

            <div class="mb-4 d-flex align-items-start">
                <i class="bi bi-clock-fill me-3 fs-5"></i>
                <div>
                <strong>Jam Operasional:</strong><br>
                Senin - Minggu: 11:00 - 23:00
                </div>
            </div>

            <div>
                <h5 class="mb-3">Ikuti Kami</h5>
                <div class="d-flex gap-3 fs-4">
                <a href="#" class="text-dark"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-dark"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-dark"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="text-dark"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

        <!-- CTA Section -->
    <div class="text-white shadow-lg p-5 text-center position-relative overflow-hidden mb-2"
        style="background-image: url('{{ asset('images/kontak.jpg') }}'); background-size: cover; background-position: center;">

    <!-- Overlay gelap transparan -->
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 rounded-4"></div>

    <!-- Konten -->
    <div class="position-relative z-1">
        <h2 class="display-5 fw-bold elegant mb-3">Mulai Pengalaman Parfum Premium Anda</h2>
        <p class="lead mb-4">Jelajahi koleksi parfum eksklusif kami dan temukan aroma yang mencerminkan kepribadian Anda.</p>

        <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="#" class="btn btn-light text-primary-color fw-semibold px-4 py-2">
            <i class="bi bi-shop me-2"></i>Kunjungi Toko
        </a>
        <a href="#" class="btn btn-outline-light fw-semibold px-4 py-2">
            <i class="bi bi-collection me-2"></i>Lihat Koleksi
        </a>
        </div>
    </div>
    </div>

    <!-- Map Section -->
    <div class="bg-white rounded-4 shadow p-4 mb-5">
        <h2 class="big-text elegant text-primary-color text-center mb-2">Lokasi Kami</h2>
        <div class="mx-auto mb-4" style="width: 60px; height: 4px; background-color: #d7bfff;"></div>
        <p class="text-center text-muted mb-4">Kunjungi toko flagship kami untuk pengalaman berbelanja parfum yang menyenangkan dan konsultasi langsung dengan pakar parfum kami.</p>
        <div class="ratio ratio-16x9">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.705514403997!2d106.57722244293544!3d-6.154581376883792!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ff9cb17a27a7%3A0x48a5aeac5d04b0d1!2sFranada%20Parfum!5e0!3m2!1sid!2sid!4v1747146188473!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>



    </div>

    @push('scripts')
    <script>
        // Simple accordion functionality
        document.addEventListener('DOMContentLoaded', function() {
            const accordionHeaders = document.querySelectorAll('.bg-light-color');

            accordionHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    const icon = this.querySelector('.bi');

                    // Toggle visibility
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                        icon.classList.replace('bi-chevron-up', 'bi-chevron-down');
                    } else {
                        content.style.maxHeight = content.scrollHeight + 'px';
                        icon.classList.replace('bi-chevron-down', 'bi-chevron-up');
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
