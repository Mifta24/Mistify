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
        <div class="bg-white rounded-xl shadow-xl p-0 mb-16 overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 p-10 lg:p-12">
                    <h2 class="big-text elegant mb-2 text-primary-color">Kirim Pesan</h2>
                    <div class="w-20 h-1 bg-accent-color mb-6"></div>
                    <p class="text-gray-700 mb-8 leading-relaxed">
                        Apakah Anda memiliki pertanyaan tentang produk kami, membutuhkan rekomendasi parfum, atau ingin memberikan masukan? Isi formulir di bawah ini, dan tim kami akan menghubungi Anda sesegera mungkin.
                    </p>

                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-accent-color focus:border-accent-color transition-all duration-300" placeholder="Masukkan nama lengkap">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-accent-color focus:border-accent-color transition-all duration-300" placeholder="email@example.com">
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                            <input type="text" id="subject" name="subject" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-accent-color focus:border-accent-color transition-all duration-300" placeholder="Subjek pesan Anda">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                            <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-accent-color focus:border-accent-color transition-all duration-300" placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>

                        <div>
                            <button type="submit" class="button-style btn-hover px-8 py-3 flex items-center gap-2">
                                Kirim Pesan
                                <i class="bi bi-send"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="md:w-1/2 bg-gradient-to-br from-primary-color to-accent-color text-white p-10 lg:p-12">
                    <h2 class="big-text elegant mb-2 text-white">Informasi Kontak</h2>
                    <div class="w-20 h-1 bg-white opacity-70 mb-8"></div>

                    <div class="space-y-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 p-4 rounded-full shadow-lg backdrop-blur-sm">
                                <i class="bi bi-geo-alt text-white text-2xl"></i>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-xl font-medium text-white">Alamat</h3>
                                <p class="mt-2 text-white text-opacity-80 leading-relaxed">
                                    Essence Flagship Store<br>
                                    Jl. Perfume No. 123<br>
                                    Jakarta Selatan, Indonesia
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 p-4 rounded-full shadow-lg backdrop-blur-sm">
                                <i class="bi bi-telephone text-white text-2xl"></i>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-xl font-medium text-white">Telepon</h3>
                                <p class="mt-2 text-white text-opacity-80 leading-relaxed">
                                    (+62) 21-123-4567<br>
                                    (+62) 812-3456-7890
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 p-4 rounded-full shadow-lg backdrop-blur-sm">
                                <i class="bi bi-envelope text-white text-2xl"></i>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-xl font-medium text-white">Email</h3>
                                <p class="mt-2 text-white text-opacity-80 leading-relaxed">
                                    info@essence.com<br>
                                    customer.service@essence.com
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-white bg-opacity-20 p-4 rounded-full shadow-lg backdrop-blur-sm">
                                <i class="bi bi-clock text-white text-2xl"></i>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-xl font-medium text-white">Jam Operasional</h3>
                                <p class="mt-2 text-white text-opacity-80 leading-relaxed">
                                    Senin - Jumat: 10:00 - 21:00<br>
                                    Sabtu - Minggu: 10:00 - 22:00
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12">
                        <h3 class="text-xl font-medium text-white mb-6">Ikuti Kami</h3>
                        <div class="flex gap-4">
                            <a href="#" class="bg-white bg-opacity-20 p-4 rounded-full flex items-center justify-center transition-all duration-300 hover:bg-white hover:text-primary-color backdrop-blur-sm">
                                <i class="bi bi-facebook text-xl"></i>
                            </a>
                            <a href="#" class="bg-white bg-opacity-20 p-4 rounded-full flex items-center justify-center transition-all duration-300 hover:bg-white hover:text-primary-color backdrop-blur-sm">
                                <i class="bi bi-instagram text-xl"></i>
                            </a>
                            <a href="#" class="bg-white bg-opacity-20 p-4 rounded-full flex items-center justify-center transition-all duration-300 hover:bg-white hover:text-primary-color backdrop-blur-sm">
                                <i class="bi bi-twitter-x text-xl"></i>
                            </a>
                            <a href="#" class="bg-white bg-opacity-20 p-4 rounded-full flex items-center justify-center transition-all duration-300 hover:bg-white hover:text-primary-color backdrop-blur-sm">
                                <i class="bi bi-youtube text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Map Section with Curved Edges --}}
        <div class="bg-white rounded-xl shadow-xl overflow-hidden mb-16">
            <div class="p-8 bg-gradient-to-r from-primary-color/10 to-accent-color/10">
                <h2 class="big-text elegant mb-2 text-primary-color text-center">Lokasi Kami</h2>
                <div class="w-20 h-1 bg-accent-color mx-auto mb-6"></div>
                <p class="text-center text-gray-600 max-w-2xl mx-auto mb-8">
                    Kunjungi toko flagship kami untuk pengalaman berbelanja parfum yang menyenangkan dan konsultasi langsung dengan pakar parfum kami.
                </p>
            </div>
            <div class="h-[450px] w-full">
                <!-- Replace with your Google Maps embed code -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2904131261937!2d106.82968131470182!3d-6.225290995493482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e4758d0c81%3A0x730e7c33f7cc97a0!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1619529703768!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        {{-- FAQ Section with Modern Accordion --}}
        <div class="bg-white rounded-xl shadow-xl p-10 lg:p-12">
            <div class="text-center mb-12">
                <h2 class="big-text elegant mb-2 text-primary-color">Pertanyaan Umum</h2>
                <div class="w-20 h-1 bg-accent-color mx-auto mb-4"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Temukan jawaban untuk pertanyaan yang sering ditanyakan oleh pelanggan kami
                </p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <div class="border border-gray-100 rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-light-color px-6 py-4 cursor-pointer hover:bg-gray-50 transition-colors duration-300">
                        <h3 class="text-lg font-semibold text-primary-color flex justify-between items-center">
                            <span>Berapa lama pengiriman sampai ke tujuan?</span>
                            <i class="bi bi-chevron-down text-accent-color"></i>
                        </h3>
                    </div>
                    <div class="px-6 py-4 bg-white">
                        <p class="text-gray-700 leading-relaxed">
                            Pengiriman biasanya membutuhkan waktu 2-5 hari kerja untuk wilayah Jabodetabek dan 5-7 hari kerja untuk wilayah lainnya di Indonesia. Kami juga menyediakan opsi pengiriman ekspres yang dapat sampai dalam 1-2 hari kerja.
                        </p>
                    </div>
                </div>

                <div class="border border-gray-100 rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-light-color px-6 py-4 cursor-pointer hover:bg-gray-50 transition-colors duration-300">
                        <h3 class="text-lg font-semibold text-primary-color flex justify-between items-center">
                            <span>Apakah ada biaya pengiriman?</span>
                            <i class="bi bi-chevron-down text-accent-color"></i>
                        </h3>
                    </div>
                    <div class="px-6 py-4 bg-white">
                        <p class="text-gray-700 leading-relaxed">
                            Ya, biaya pengiriman dihitung berdasarkan berat dan jarak pengiriman. Namun, kami sering mengadakan promo gratis ongkir untuk pembelian di atas nilai tertentu. Silakan cek halaman promo untuk informasi terbaru.
                        </p>
                    </div>
                </div>

                <div class="border border-gray-100 rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-light-color px-6 py-4 cursor-pointer hover:bg-gray-50 transition-colors duration-300">
                        <h3 class="text-lg font-semibold text-primary-color flex justify-between items-center">
                            <span>Bagaimana kebijakan pengembalian dan refund?</span>
                            <i class="bi bi-chevron-down text-accent-color"></i>
                        </h3>
                    </div>
                    <div class="px-6 py-4 bg-white">
                        <p class="text-gray-700 leading-relaxed">
                            Kami menerima pengembalian produk dalam waktu 7 hari setelah penerimaan jika produk dalam kondisi asli dan belum dibuka. Refund akan diproses dalam 3-5 hari kerja setelah produk diterima kembali oleh tim kami.
                        </p>
                    </div>
                </div>

                <div class="border border-gray-100 rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-light-color px-6 py-4 cursor-pointer hover:bg-gray-50 transition-colors duration-300">
                        <h3 class="text-lg font-semibold text-primary-color flex justify-between items-center">
                            <span>Apakah semua parfum dijamin original?</span>
                            <i class="bi bi-chevron-down text-accent-color"></i>
                        </h3>
                    </div>
                    <div class="px-6 py-4 bg-white">
                        <p class="text-gray-700 leading-relaxed">
                            Ya, Essence hanya menjual parfum original dengan sertifikat keaslian. Kami memperoleh produk langsung dari distributor resmi dan brand house untuk menjamin kualitas dan keaslian setiap produk.
                        </p>
                    </div>
                </div>

                <div class="border border-gray-100 rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-light-color px-6 py-4 cursor-pointer hover:bg-gray-50 transition-colors duration-300">
                        <h3 class="text-lg font-semibold text-primary-color flex justify-between items-center">
                            <span>Bagaimana cara memilih parfum yang tepat?</span>
                            <i class="bi bi-chevron-down text-accent-color"></i>
                        </h3>
                    </div>
                    <div class="px-6 py-4 bg-white">
                        <p class="text-gray-700 leading-relaxed">
                            Kami menyediakan layanan konsultasi parfum secara online maupun di toko fisik kami. Tim kami akan membantu merekomendasikan parfum berdasarkan preferensi, kesukaan aroma, dan kesempatan penggunaan yang Anda inginkan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <p class="text-gray-600 mb-6">Belum menemukan jawaban yang Anda cari?</p>
                <a href="#" class="button-style btn-hover inline-flex items-center gap-2">
                    Ajukan Pertanyaan Lainnya
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- CTA Section --}}
        <div class="mt-16 bg-gradient-to-r from-primary-color to-accent-color text-white p-10 lg:p-16 rounded-xl shadow-xl text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
            <div class="relative z-10">
                <h2 class="big-text elegant mb-4">Mulai Pengalaman Parfum Premium Anda</h2>
                <p class="text-white text-opacity-90 mb-8 max-w-2xl mx-auto text-lg">
                    Jelajahi koleksi parfum eksklusif kami dan temukan aroma yang mencerminkan kepribadian Anda
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#" class="bg-white text-primary-color py-3 px-8 rounded-lg font-semibold hover:bg-opacity-90 transition-all duration-300 flex items-center gap-2">
                        <i class="bi bi-shop"></i>
                        Kunjungi Toko
                    </a>
                    <a href="#" class="bg-transparent border-2 border-white text-white py-3 px-8 rounded-lg font-semibold hover:bg-white hover:bg-opacity-10 transition-all duration-300 flex items-center gap-2">
                        <i class="bi bi-collection"></i>
                        Lihat Koleksi
                    </a>
                </div>
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
