<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container py-3">
        <a class="navbar-brand fw-bold" href="#">Essence</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>

            @auth
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            <a href="#" class="btn btn-primary ms-3">Order Now</a>
        </div>
    </div>
</nav>
