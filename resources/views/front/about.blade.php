<x-app-layout>
    {{-- Hero Section --}}
    <section class="py-5 text-dark" >
        <div class="container-lg text-center">
            <h1 class="display-4 fw-bold mb-3">Tentang Kami</h1>
            <p class="lead">Temukan perjalanan kami dalam menghadirkan aroma terbaik untuk mempercantik momen hidup Anda.</p>
        </div>
    </section>

    {{-- About Section --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row gx-2 align-items-center">
                <div class="col-md-5">
                    <img src="{{ asset('images/tim/koleksiparfum.webp') }}" class="img-fluid rounded shadow" alt="Koleksi Parfum" style="object-fit: cover; max-height: 400px;">
                </div>
                <div class="col-md-7">
                    <h2 class="fw-bold mb-3">Selamat Datang di <span class="text-secondary">Franada Parfum</span></h2>
                    <p class="text-muted">
                        Kami adalah toko parfum terdepan yang menyediakan berbagai macam parfum berkualitas dengan aroma yang elegan dan tahan lama.
                    </p>
                    <p class="text-muted">
                        Setiap produk yang kami tawarkan telah melalui kurasi ketat untuk memastikan hanya parfum dengan kualitas terbaik yang sampai ke tangan Anda.
                    </p>
                    <a href="#" class="btn btn-outline-dark mt-3 px-4">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Brand Values --}}
    {{-- <section class="py-5">
        <div class="container-lg text-center">
            <h2 class="fw-bold mb-3">Nilai-nilai Kami</h2>
            <p class="text-muted mb-4">Luxury Defined. One Drop at a Time.</p>
            <img src="{{ asset('images/tim/k2.jpg') }}" class="img-fluid rounded shadow mb-4" style="max-height: 400px;" alt="Brand Value Image">
            <p class="text-muted mx-auto" style="max-width: 700px;">
                Di Franada Parfum, kami percaya bahwa sebuah parfum bukan hanya tentang aroma, tetapi juga tentang ekspresi diri dan pengalaman yang tak terlupakan.
            </p>
        </div>
    </section> --}}

    {{-- Vision & Mission --}}
    <section class="py-5 bg-light">
        <div class="container-lg text-center">
            <h2 class="fw-bold mb-5">Visi & Misi Kami</h2>
            <div class="row g-4">
                @php
                    $visions = [
                        ['img' => 'recommendation.png', 'title' => 'Visi', 'desc' => 'Menjadi toko parfum terpercaya yang menyediakan produk berkualitas tinggi dan inovatif di Indonesia.'],
                        ['img' => 'perfume-spray.png', 'title' => 'Kualitas Premium', 'desc' => 'Parfum terbaik dari seluruh dunia dengan standar kualitas tinggi.'],
                        ['img' => 'giftbox.png', 'title' => 'Layanan Terbaik', 'desc' => 'Layanan pelanggan ramah, cepat, dan profesional untuk pengalaman berbelanja yang menyenangkan.'],
                    ];
                @endphp

                @foreach($visions as $item)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <img src="{{ asset('logos/' . $item['img']) }}" class="mb-3" alt="{{ $item['title'] }}" style="width: 50px;">
                            <h5 class="fw-semibold mb-2">{{ $item['title'] }}</h5>
                            <p class="text-muted">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Team Section --}}
    <section class="py-5">
        <div class="container-lg text-center">
            <h2 class="fw-bold mb-4">Tim Kami</h2>
            <p class="text-muted mb-5">Di balik kesuksesan Franada Parfum adalah tim profesional pecinta parfum yang berdedikasi tinggi.</p>
            <div class="row g-4 justify-content-center">
                @foreach([
                    ['name' => 'Fandi Fadillah', 'role' => 'Founder & CEO', 'img' => 'ceo.jpg'],
                    ['name' => 'Miftahudin ALdi Saputra', 'role' => 'Backend', 'img' => 'miftah.jpg'],
                    ['name' => 'Dwi Bayu Nugraha', 'role' => 'Project Manager', 'img' => 'dwi.jpg'],
                    ['name' => 'M Juan Adi Pratama', 'role' => 'UI/UX Desainer', 'img' => 'juan.jpg'],
                    ['name' => 'Rodiyansyah Ramadan', 'role' => 'IT Consultant', 'img' => 'rodiramadan.jpg'],
                    ['name' => 'Agung Rizki Saputra', 'role' => 'Frontend', 'img' => 'saya.jpg'],
                ] as $member)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('images/tim/' . $member['img']) }}" class="card-img-top rounded-top" style="object-fit: cover; height: 250px;" alt="{{ $member['name'] }}">
                        <div class="card-body text-center">
                            <h6 class="fw-bold mb-1">{{ $member['name'] }}</h6>
                            <small class="text-muted">{{ $member['role'] }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section class="py-5 bg-light">
        <div class="container-lg text-center">
            <h2 class="fw-bold mb-4">Hubungi Kami</h2>
            <p class="text-muted mb-4">Jika Anda memiliki pertanyaan atau ingin mengetahui lebih lanjut tentang produk kami, silakan hubungi kami.</p>
            <div class="row justify-content-center g-4">
                <div class="col-md-6 text-start">
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-envelope-fill text-primary me-2"></i> franada@gmail.com</li>
                        <li class="mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i> (+62) 81287195398</li>
                        <li class="mb-2"><i class="bi bi-geo-alt-fill text-primary me-2"></i> Pondok Makmur Blok CS 4, Jl. Raya Kutabumi Blok CD2 No.15, Kuta Baru, Kec. Ps. Kemis, Kabupaten Tangerang, Banten 15560</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">Ikuti Kami</h5>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#"><i class="bi bi-facebook fs-4 text-secondary"></i></a>
                        <a href="#"><i class="bi bi-instagram fs-4 text-secondary"></i></a>
                        <a href="#"><i class="bi bi-twitter-x fs-4 text-secondary"></i></a>
                        <a href="#"><i class="bi bi-pinterest fs-4 text-secondary"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
