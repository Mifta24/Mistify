<x-app-layout>
    {{-- Hero Section --}}
    <section class="bg-gradient text-black py-5" style="background: linear-gradient(to right, #6a11cb, #2575fc);">
        <div class="container text-center">
            <h1 class="display-4 fw-bold elegant mb-3">Tentang Kami</h1>
            <p class="lead">Temukan perjalanan kami dalam menghadirkan aroma terbaik untuk mempercantik momen hidup Anda</p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-5">
        <div class="container">
            {{-- About Section --}}
            <div class="card mb-5 shadow-sm border-0">
                <div class="row g-0 align-items-center">
                    <!-- Kolom Gambar -->
                    <div class="col-md-6">
                        <img src="{{ asset('images/tim/koleksiparfum.webp') }}"
                            class="img-fluid rounded-start w-100"
                            alt="Koleksi Parfum"
                            style="max-height: 400px; object-fit: cover;">
                    </div>

                    <!-- Kolom Teks -->
                    <div class="col-md-6">
                        <div class="card-body p-4">
                            <h2 class="card-title elegant text-black mb-3">
                                Selamat Datang di <span class="text-secondary">Essence</span>
                            </h2>
                            <p class="card-text text-muted">
                                Kami adalah toko parfum terdepan yang menyediakan berbagai macam parfum berkualitas dengan aroma yang elegan dan tahan lama. Didirikan dengan passion untuk menghadirkan aroma terbaik, kami berkomitmen untuk memberikan pengalaman berbelanja parfum yang memuaskan.
                            </p>
                            <p class="card-text text-muted">
                                Setiap produk yang kami tawarkan telah melalui kurasi ketat untuk memastikan hanya parfum dengan kualitas terbaik yang sampai ke tangan Anda.
                            </p>
                            <a href="#" class="btn button-style mt-3">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Brand Values Section --}}
            <div class="bg-light rounded p-5 mb-5 shadow-sm">
                <div class="text-center mb-4">
                    <h2 class="elegant text-black">Nilai-nilai Kami</h2>
                    <p class="text-muted">Luxury Defined. One Drop at a Time.</p>
                </div>
                <div class="text-center mb-4">
                    <img src="{{ asset('images/tim/k2.jpg') }}" alt="Perfume bottle" class="img-fluid rounded shadow" style="max-height: 400px;">
                </div>
                <p class="text-center text-muted mx-auto" style="max-width: 700px;">
                    Di Essence, kami percaya bahwa sebuah parfum bukan hanya tentang aroma, tetapi juga tentang ekspresi diri dan pengalaman yang tak terlupakan.
                </p>
            </div>

            {{-- Vision & Mission Section --}}
            <div class="text-center mb-5">
                <h2 class="elegant text-black mb-4">Visi & Misi Kami</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <img src="{{ asset('logos/recommendation.png') }}" class="mb-3" style="width: 50px;" alt="Visi">
                                <h5 class="card-title text-black">Visi</h5>
                                <p class="card-text text-muted">
                                    Menjadi toko parfum terpercaya yang menyediakan produk berkualitas tinggi dan inovatif di Indonesia.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <img src="{{ asset('logos/perfume-spray.png') }}" class="mb-3" style="width: 50px;" alt="Kualitas">
                                <h5 class="card-title text-black">Kualitas Premium</h5>
                                <p class="card-text text-muted">
                                    Parfum terbaik dari seluruh dunia dengan standar kualitas tinggi.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <img src="{{ asset('logos/giftbox.png') }}" class="mb-3" style="width: 50px;" alt="Layanan">
                                <h5 class="card-title text-black">Layanan Terbaik</h5>
                                <p class="card-text text-muted">
                                    Layanan pelanggan ramah, cepat, dan profesional untuk pengalaman berbelanja yang menyenangkan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Team Section --}}
            <div class="container bg-light rounded p-5 mb-5 shadow-sm text-center">
                <h2 class="elegant text-black mb-4">Tim Kami</h2>
                <p class="text-muted mb-5">
                    Dibalik kesuksesan Essence adalah tim profesional pecinta parfum yang berdedikasi tinggi.
                </p>
                <div class="row justify-content-center g-4">
                    @foreach ([
                    ['name' => 'Fandi Fadillah', 'role' => 'Founder & CEO', 'img' => 'ceo.jpg'],
                    ['name' => 'Miftahudin ALdi Saputra', 'role' => 'Backend', 'img' => 'miftah.jpg'],
                    ['name' => 'Dwi Bayu Nugraha', 'role' => 'Project Manager', 'img' => 'dwi.jpg'],
                    ['name' => 'M Juan Adi Pratama', 'role' => 'UI/UX Desainer', 'img' => 'juan.jpg'],
                    ['name' => 'Rodiyansyah Ramadan', 'role' => 'IT Consultant', 'img' => 'rodiramadan.jpg'],
                    ['name' => 'Agung Rizki Saputra', 'role' => 'Frontend', 'img' => 'saya.jpg'],
                    ] as $member)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ asset('images/tim/' . $member['img']) }}"
                                class="card-img-top rounded-top object-fit-cover"
                                style="height: 250px; width: 100%; object-fit: cover;"
                                alt="{{ $member['name'] }}">
                            <div class="card-body text-center">
                                <h5 class="card-title text-black">{{ $member['name'] }}</h5>
                                <p class="card-text text-secondary">{{ $member['role'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>



            {{-- Contact Section --}}
            <div class="text-center">
                <h2 class="elegant text-black mb-4">Hubungi Kami</h2>
                <p class="text-muted mb-4">Jika Anda memiliki pertanyaan atau ingin mengetahui lebih lanjut tentang produk kami, silakan hubungi kami.</p>
                <div class="row justify-content-center mb-4">
                    <div class="col-md-6 text-start">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-envelope text-info me-2"></i> info@essence.com</li>
                            <li class="mb-2"><i class="bi bi-telephone text-info me-2"></i> (+12) 345 678 910</li>
                            <li class="mb-2"><i class="bi bi-geo-alt text-info me-2"></i> 12345 Street Name, City Name, Country</li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-center">
                        <h5 class="text-black mb-3">Ikuti Kami</h5>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="#"><img src="{{ asset('logos/facebook.png') }}" class="img-fluid" style="width: 30px;" alt="Facebook"></a>
                            <a href="#"><img src="{{ asset('logos/instagram.png') }}" class="img-fluid" style="width: 30px;" alt="Instagram"></a>
                            <a href="#"><img src="{{ asset('logos/twitter.png') }}" class="img-fluid" style="width: 30px;" alt="Twitter"></a>
                            <a href="#"><img src="{{ asset('logos/pinterest.png') }}" class="img-fluid" style="width: 30px;" alt="Pinterest"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>