<x-app-layout>
{{-- Our Story Section --}}
<section class="py-5">
    <div class="container-lg">
        <h2 class="text-center fw-bold mb-5">Our Story</h2>

        {{-- Section 1: Text Left, Image Right --}}
        <div class="row align-items-center mb-5">
            <div class="col-md-6 order-md-1">
                <p class="text-muted">
                    Tangerang, 2020 menjadi awal dari perjalanan Toko Franada Parfum. Berawal dari ketertarikan kami terhadap dunia wewangian dan keinginan untuk menghadirkan parfum berkualitas dengan harga yang terjangkau, lahirlah toko fisik pertama kami di pusat kota Tangerang.
                </p>
                <p class="text-muted">
                    Didirikan oleh Bapak Franada, toko ini dibangun dari nol dengan semangat untuk menghadirkan pengalaman belanja parfum yang berbeda — lengkap, nyaman, dan terpercaya. Awalnya kami hanya menjual beberapa varian parfum refill, namun seiring dengan meningkatnya kepercayaan pelanggan, koleksi kami terus berkembang hingga mencakup berbagai jenis parfum original, inspired, hingga produk eksklusif pilihan.
                </p>
            </div>
            <div class="col-md-6 order-md-2">
                <img src="{{ asset('images/journey.jpg') }}" class="img-fluid rounded shadow" alt="Foto toko" style="object-fit: cover; height: 100%; max-height: 400px; width: 100%;">
            </div>
        </div>

        {{-- Section 2: Image Left, Text Right --}}
        <div class="row align-items-center">
            <div class="col-md-6 order-md-1">
                <img src="{{ asset('images/perfume-background.jpg') }}" class="img-fluid rounded shadow" alt="Interior toko" style="object-fit: cover; height: 100%; max-height: 400px; width: 100%;">
            </div>
            <div class="col-md-6 order-md-2">
                <p class="text-muted">
                    Dari sebuah toko kecil di Tangerang, kini Franada Parfum terus berinovasi dan berkembang melalui kehadiran kami secara online. Visi kami sederhana: menjadi pilihan utama masyarakat Indonesia dalam mencari parfum favorit mereka.
                </p>
                <p>Kami percaya bahwa parfum bukan sekadar wewangian, tapi juga bagian dari identitas, suasana hati, dan cara seseorang mengekspresikan diri. Karena itu, setiap produk yang kami hadirkan selalu dipilih dan diracik dengan penuh perhatian terhadap kualitas, ketahanan aroma, dan kepuasan pelanggan.
</p>
            </div>
        </div>
    </div>
</section>




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
                    ['name' => '-', 'role' => 'Founder & CEO', 'img' => 'ceo.jpg'],
                    ['name' => '-', 'role' => 'Brand & Product Designer', 'img' => 'miftah.jpg'],
                    ['name' => '-', 'role' => 'Marketer', 'img' => 'dwi.jpg'],
                    ['name' => '-', 'role' => 'Costumer Service', 'img' => 'juan.jpg'],
                    ['name' => '-', 'role' => 'Content Creator', 'img' => 'rodiramadan.jpg'],
                    ['name' => '-', 'role' => 'Parfum Specialist', 'img' => 'saya.jpg'],
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
