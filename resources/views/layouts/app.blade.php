<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Essence - Premium Perfumes</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style/styles.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Add in head section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        :root {
            --primary-color: #3a5a40;
            --secondary-color: #a3b18a;
            --accent-color: #588157;
            --light-color: #f5f5f5;
            --dark-color: #212529;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.7;
            color: #333;
            background-color: #fafafa;
        }

        h1,
        h2,
        h3,
        .elegant {
            font-family: 'Playfair Display', serif;
        }

        .large-text {
            font-size: 3.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 1.5rem;
        }

        .big-text {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .button-style {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-hover:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Navigation */
        .navbar {
            background-color: white !important;
            padding: 15px 0;
        }

        .navbar .nav-link {
            color: var(--dark-color) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: var(--accent-color) !important;
        }

        .navbar .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 600;
        }

        .auth-link {
            border: 1px solid var(--accent-color);
            border-radius: 4px;
            margin-left: 5px !important;
        }

        .cart-icon {
            font-size: 1.3rem;
        }

        /* Hero Section */
        .hero-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            padding: 80px 0;
            align-items: center;
        }

        #image-container-1 {
            /* background-image: url('{{ asset('images/hero-perfume.jpg') }}'); */
            background-size: cover;
            background-position: center;
            height: 500px;
            border-radius: 10px;
        }

        /* Brand Section */
        .brand-section {
            padding: 80px 0;
            background-color: var(--light-color);
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
            text-align: center;
        }

        .brand-image img {
            max-width: 80%;
            margin: 0 auto;
            display: block;
        }

        .tagline {
            font-style: italic;
            color: var(--accent-color);
            font-size: 1.2rem;
            margin-top: -10px;
        }

        /* Services Section */
        .services-section {
            padding: 80px 0;
        }

        .container-3-services {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
        }

        .service-card {
            text-align: center;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .service-card img {
            width: 60px;
            margin-bottom: 15px;
        }

        /* Products Section */
        .products-section {
            padding: 80px 0;
            background-color: var(--light-color);
        }

        .category-nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            margin: 30px 0;
            padding: 0;
        }

        .category-nav li {
            margin: 0 15px;
        }

        .category-nav a {
            text-decoration: none;
            color: var(--dark-color);
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .category-nav a.active,
        .category-nav a:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .container-4-collection {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }

        .product-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .product-info {
            padding: 15px;
            text-align: center;
        }

        .product-info h3 {
            margin-bottom: 5px;
            font-size: 1.2rem;
        }

        .product-info p {
            color: var(--accent-color);
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Testimonial Section */
        .testimonial-section {
            padding: 80px 0;
        }

        .testimonial-carousel {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .testimonial {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            margin: 10px;
            transition: transform 0.3s ease;
        }

        .testimonial:hover {
            transform: translateY(-5px);
        }

        .quote {
            font-size: 18px;
            color: #333;
            font-style: italic;
            line-height: 1.6;
            margin-bottom: 15px;
            position: relative;
        }

        .quote::before,
        .quote::after {
            content: '"';
            font-size: 30px;
            color: var(--accent-color);
            font-family: serif;
        }

        .author {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 16px;
        }

        .swiper-pagination-bullet-active {
            background-color: var(--primary-color);
        }

        /* Footer */
        #footer {
            background-color: var(--dark-color);
            color: white;
            padding: 60px 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            padding: 60px 20px;
        }

        #footer h1,
        #footer h2 {
            color: white;
            margin-bottom: 20px;
        }

        #footer p {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 15px;
        }

        #social-logos {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        #social-logos img {
            width: 30px;
            height: 30px;
            transition: all 0.3s ease;
        }

        #social-logos img:hover {
            transform: scale(1.2);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-section {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .large-text {
                font-size: 2.8rem;
            }

            .big-text {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {

            .container-3-services,
            .container-4-collection {
                grid-template-columns: 1fr 1fr;
            }

            .large-text {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 576px) {

            .container-3-services,
            .container-4-collection {
                grid-template-columns: 1fr;
            }

            .category-nav ul {
                flex-wrap: wrap;
            }

            .category-nav li {
                margin: 5px;
            }

            .large-text {
                font-size: 2.2rem;
            }

            .big-text {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">

        <!-- Navigation -->
        <header>
            @include('layouts.navigation') <!-- Navbar -->
        </header>


        <!-- Main Content -->
        <main>
            {{-- Flash Message --}}
            <div class="container mt-4">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>

            {{-- page content --}}
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer id="footer">
            <div>
                <h1 class="big-text">Essence</h1>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo architecto ut veritatis illum
                    quaerat. Ea similique harum repellat excepturi! Consequuntur iusto deserunt accusantium tempore
                    ullam.</p>
                <p>&copy; 2024 Essence - All rights Reserved</p>

            </div>
            <div>
                <h2 class="big-text">Opening Times</h2>
                <p>Monday - Friday: 10.00 - 23.00
                    <br>
                    Saturday: 10.00 - 19.00
                </p>
                <div id="social-logos">
                    <img src="{{ asset('logos/facebook.png') }}" alt="Facebook" loading="lazy">
                    <img src="{{ asset('logos/instagram.png') }}" alt="Instagram" loading="lazy">
                    <img src="{{ asset('logos/twitter.png') }}" alt="Twitter" loading="lazy">
                    <img src="{{ asset('logos/pinterest.png') }}" alt="Pinterest" loading="lazy">
                </div>
            </div>
            <div>
                <h2 class="big-text">Contact Us </h2>
                <p>Tel: (+12) 345 678 910</p>
                <p>Email: info@essence.com</p>
                <p>Address: 12345 Street Name, City Name, Country</p>

            </div>
        </footer>

    </div>


    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Swiper for testimonials
            const testimonialSwiper = new Swiper('.testimonial-swiper', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                spaceBetween: 30,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>