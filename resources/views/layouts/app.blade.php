<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Online Perfume Store</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style/styles.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Add in head section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation') <!-- Navbar -->

        <!-- Page Content -->
        <main class="container py-4">
            {{ $slot }}
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
                    <p>Monday: Friday: 10.00 - 23.00
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
        </main>


    </div>


    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
