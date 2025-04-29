<x-app-layout>
    {{-- Hero Section --}}
    <div class="hero-section container-1 bg-gradient-to-r from-primary-color to-accent-color text-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="large-text font-bold mb-4 elegant">Tentang Kami</h1>
                <p class="tagline max-w-3xl mx-auto">Temukan perjalanan kami dalam menghadirkan aroma terbaik untuk mempercantik momen hidup Anda</p>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container mx-auto px-4 py-12">
        {{-- About Section --}}
        <div class="bg-white rounded-lg shadow-lg p-8 mb-12">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="md:w-1/2">
                    <img src="{{ asset('images/about/parfum-collection.jpg') }}" alt="Koleksi Parfum" class="rounded-lg shadow-md w-full h-auto">
                </div>
                <div class="md:w-1/2">
                    <h2 class="big-text elegant mb-4 text-primary-color">Selamat Datang di <span class="text-accent-color">Essence</span></h2>
                    <p class="text-gray-700 mb-4 leading-relaxed">
                        Kami adalah toko parfum terdepan yang menyediakan berbagai macam parfum berkualitas dengan aroma yang elegan dan tahan lama. Didirikan dengan passion untuk menghadirkan aroma terbaik, kami berkomitmen untuk memberikan pengalaman berbelanja parfum yang memuaskan.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        Setiap produk yang kami tawarkan telah melalui kurasi ketat untuk memastikan hanya parfum dengan kualitas terbaik yang sampai ke tangan Anda.
                    </p>
                    <button class="button-style btn-hover mt-4">Pelajari Lebih Lanjut</button>
                </div>
            </div>
        </div>

        {{-- Brand Values Section --}}
        <div class="brand-section container-2 bg-light-color rounded-lg shadow-lg p-8 mb-12">
            <div class="slogan text-center mb-8">
                <h2 class="big-text elegant text-primary-color">Nilai-nilai Kami</h2>
                <p class="tagline">Luxury Defined. One Drop at a Time.</p>
            </div>
            <div class="brand-image mb-8">
                <img src="{{ asset('images/second-image.jpg') }}" alt="Perfume bottle" class="rounded shadow-lg img-fluid mx-auto" style="max-height: 400px;">
            </div>
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-gray-700 leading-relaxed">
                    Di Essence, kami percaya bahwa sebuah parfum bukan hanya tentang aroma, tetapi juga tentang ekspresi diri dan pengalaman yang tak terlupakan. Kami berkomitmen untuk menyajikan koleksi parfum premium dari berbagai penjuru dunia untuk memenuhi berbagai selera dan kepribadian.
                </p>
            </div>
        </div>

        {{-- Vision Section --}}
        <div class="services-section container-3 mb-12">
            <h2 class="big-text elegant text-center mb-8 text-primary-color">Visi & Misi Kami</h2>
            <div class="container-3-services">
                <div class="service-card">
                    <img src="{{ asset('logos/recommendation.png') }}" alt="Visi" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-3 text-primary-color">Visi</h3>
                    <p class="text-gray-700">
                        Menjadi toko parfum terpercaya yang menyediakan produk berkualitas tinggi dengan harga terjangkau untuk semua kalangan, serta menjadi pioneer dalam inovasi pengalaman berbelanja parfum di Indonesia.
                    </p>
                </div>
                <div class="service-card">
                    <img src="{{ asset('logos/perfume-spray.png') }}" alt="Kualitas" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-3 text-primary-color">Kualitas Premium</h3>
                    <p class="text-gray-700">
                        Memberikan pilihan parfum terbaik dengan kualitas premium dari seluruh dunia yang memuaskan seluruh pelanggan kami.
                    </p>
                </div>
                <div class="service-card">
                    <img src="{{ asset('logos/giftbox.png') }}" alt="Layanan" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-3 text-primary-color">Layanan Terbaik</h3>
                    <p class="text-gray-700">
                        Menyediakan layanan pelanggan yang ramah, profesional dan responsif untuk memastikan pengalaman berbelanja yang menyenangkan.
                    </p>
                </div>
            </div>
        </div>

        {{-- Team Section --}}
        <div class="products-section container-4 bg-light-color rounded-lg shadow-lg p-8 mb-12">
            <h2 class="big-text elegant text-center mb-8 text-primary-color">Tim Kami</h2>
            <p class="text-center mb-8 max-w-3xl mx-auto">
                Dibalik kesuksesan Essence adalah tim profesional yang berdedikasi untuk memberikan yang terbaik bagi pelanggan kami. Kami adalah para pecinta parfum dengan pengetahuan mendalam tentang dunia wewangian.
            </p>
            <div class="container-4-collection">
                <div class="product-card">
                    <img src="{{ asset('images/team-1.jpg') }}" alt="Team Member 1" class="img-fluid rounded">
                    <div class="product-info">
                        <h3 class="text-primary-color">Diana Sari</h3>
                        <p class="text-accent-color">Founder & CEO</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="{{ asset('images/team-2.jpg') }}" alt="Team Member 2" class="img-fluid rounded">
                    <div class="product-info">
                        <h3 class="text-primary-color">Andi Wijaya</h3>
                        <p class="text-accent-color">Fragrance Specialist</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="{{ asset('images/team-3.jpg') }}" alt="Team Member 3" class="img-fluid rounded">
                    <div class="product-info">
                        <h3 class="text-primary-color">Ratna Dewi</h3>
                        <p class="text-accent-color">Customer Experience</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="{{ asset('images/team-4.jpg') }}" alt="Team Member 4" class="img-fluid rounded">
                    <div class="product-info">
                        <h3 class="text-primary-color">Budi Santoso</h3>
                        <p class="text-accent-color">Product Manager</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contact Section --}}
        <div class="testimonial-section">
            <h2 class="big-text elegant text-center mb-8 text-primary-color">Hubungi Kami</h2>
            <div class="testimonial">
                <div class="flex flex-col md:flex-row justify-center items-center gap-8">
                    <div class="md:w-2/3">
                        <p class="quote mb-4">
                            Jika Anda memiliki pertanyaan atau ingin mengetahui lebih lanjut tentang produk kami, jangan ragu untuk menghubungi kami.
                        </p>
                        <div class="flex flex-col gap-3 mt-6">
                            <div class="flex items-center">
                                <i class="bi bi-envelope me-3 text-accent-color"></i>
                                <span>info@essence.com</span>
                            </div>
                            <div class="flex items-center">
                                <i class="bi bi-telephone me-3 text-accent-color"></i>
                                <span>(+12) 345 678 910</span>
                            </div>
                            <div class="flex items-center">
                                <i class="bi bi-geo-alt me-3 text-accent-color"></i>
                                <span>12345 Street Name, City Name, Country</span>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-1/3 flex flex-col items-center">
                        <h3 class="text-xl font-semibold mb-4 text-primary-color">Ikuti Kami</h3>
                        <div id="social-logos" class="flex gap-4">
                            <a href="#"><img src="{{ asset('logos/facebook.png') }}" alt="Facebook" class="w-10 h-10 transition-transform hover:scale-110"></a>
                            <a href="#"><img src="{{ asset('logos/instagram.png') }}" alt="Instagram" class="w-10 h-10 transition-transform hover:scale-110"></a>
                            <a href="#"><img src="{{ asset('logos/twitter.png') }}" alt="Twitter" class="w-10 h-10 transition-transform hover:scale-110"></a>
                            <a href="#"><img src="{{ asset('logos/pinterest.png') }}" alt="Pinterest" class="w-10 h-10 transition-transform hover:scale-110"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
