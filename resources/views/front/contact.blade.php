<x-app-layout>
    {{-- Hero Section with Parallax Effect --}}
    <section class="py-5 text-dark" >
        <div class="container-lg text-center">
            <h1 class="display-4 fw-bold mb-3">Hubungi Kami</h1>
            <p class="lead">Kami siap membantu menjawab pertanyaan dan memberikan saran terbaik untuk kebutuhan parfum Anda.</p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-5 bg-light">
    <div class="container">
        <div class="row g-5 align-items-stretch">

        <!-- Formulir Kontak -->
        <div class="col-lg-6">
            <div class="bg-white p-5 rounded-4 shadow-sm h-100 d-flex flex-column justify-content-between">
            <div>
                <h2 class="fw-bold text-black mb-2 text-center">Kirim Pesan</h2>
                <div class="mx-auto mb-4" style="width: 60px; height: 4px; background-color: #d7bfff;"></div>
                <p class="text-muted text-center mb-4">
                Apakah Anda memiliki pertanyaan, butuh rekomendasi, atau ingin memberikan masukan? Isi formulir ini, dan tim kami akan segera merespon Anda.
                </p>
            </div>
            <form>
                <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control shadow-sm" placeholder="Masukkan nama lengkap">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control shadow-sm" placeholder="email@example.com">
                </div>
                <div class="col-12">
                    <label class="form-label">Subjek</label>
                    <input type="text" class="form-control shadow-sm" placeholder="Subjek pesan Anda">
                </div>
                <div class="col-12">
                    <label class="form-label">Pesan</label>
                    <textarea class="form-control shadow-sm" rows="4" placeholder="Tulis pesan Anda di sini..."></textarea>
                </div>
                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-outline-dark px-4 py-2">
                    <i class="bi bi-send me-2"></i>Kirim Pesan
                    </button>
                </div>
                </div>
            </form>
            </div>
        </div>

        <!-- Informasi Kontak -->
        <div class="col-lg-6">
            <div class="bg-white text-dark p-5 rounded-4 shadow-sm h-100 d-flex flex-column justify-content-between">
            <div>
                <h2 class="fw-bold text-black mb-3">Informasi Kontak</h2>
                <hr class="mb-4" style="border-top: 2px solid #d7bfff;">
                <div class="mb-3 d-flex">
                <i class="bi bi-geo-alt-fill text-black fs-5 me-3"></i>
                <div>
                    <strong>Alamat:</strong><br>
                    Pondok Makmur Blok CS 4, Jl. Raya Kutabumi Blok CD2 No.15, Kuta Baru, Ps. Kemis, Tangerang, Banten 15560
                </div>
                </div>
                <div class="mb-3 d-flex">
                <i class="bi bi-telephone-fill text-black fs-5 me-3"></i>
                <div><strong>Telepon:</strong><br>(+62) 812-8719-5398</div>
                </div>
                <div class="mb-3 d-flex">
                <i class="bi bi-envelope-fill text-black fs-5 me-3"></i>
                <div><strong>Email:</strong><br>franada@gmail.com</div>
                </div>
                <div class="mb-4 d-flex">
                <i class="bi bi-clock-fill text-black fs-5 me-3"></i>
                <div><strong>Jam Operasional:</strong><br>Senin - Minggu: 11:00 - 23:00</div>
                </div>
            </div>

            <div>
                <h5 class="mb-3">Ikuti Kami</h5>
                <div class="d-flex gap-3 fs-4">
                <a href="#" class="text-dark hover-opacity"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-dark hover-opacity"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-dark hover-opacity"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="text-dark hover-opacity"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            </div>
        </div>

        </div>
    </div>
    </section>

    <style>
    .hover-opacity:hover {
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .btn-primary {
        background-color: #6c4ec2;
        border-color: #6c4ec2;
    }

    .btn-primary:hover {
        background-color: #593bb4;
        border-color: #593bb4;
    }

    .text-primary {
        color: #6c4ec2 !important;
    }
    </style>


        <!-- CTA Section -->
    <div class="text-white shadow-lg p-5 text-center position-relative overflow-hidden mb-2"
        style="background-image: url('{{ asset('images/kontak.jpg') }}'); background-size: cover; background-position: center;">

    <!-- Overlay gelap transparan -->
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 rounded-4"></div>

    <!-- Konten -->
    <div class="position-relative z-1">
        <h2 class="display-5 fw-bold elegant mb-3">Mulai Pengalaman Parfum Premium Anda</h2>
        <p class="lead mb-4 text-white">Jelajahi koleksi parfum eksklusif kami dan temukan aroma yang mencerminkan kepribadian Anda.</p>

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
