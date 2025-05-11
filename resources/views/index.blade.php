<x-app-layout>
    <div class="hero-section container-1">
        <div class="container-text">
            <h1 class="large-text">We care about Fragrances</h1>
            <p class="lead my-4">Perfume is the art of creating a unique and lasting impression on the senses.</p>
            <button class="button-style btn-hover">See more</button>
        </div>
        <div id="image-container-1" class="shadow-md rounded">
            <img src="{{ asset('images/perfume-background.jpg') }}" class="rounded h-100" alt="image">
        </div>
    </div>

    <div class="brand-section container-2">
        <div class="slogan text-center">
            <h1 class="large-text elegant">Essence</h1>
            <p class="tagline">Luxury Defined. One Drop at a Time.</p>
        </div>
        <div class="brand-image">
            <img src="https://images.rawpixel.com/image_png_1100/cHJpdmF0ZS90ZW1wbGF0ZXMvZmlsZXMvY3JlYXRlX3Rvb2wvMjAyNC0wMi8wMWhxMnB2ZDZkZWM1bjBwemJ6MHducHB0NS1sc3ZiYmlobi5wbmc.png"
                alt="Perfume bottle" class="rounded shadow-lg img-fluid">
        </div>
        <div class="container-text">
            <h2 class="big-text">Why shop with Essence</h2>
            <p class="my-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Mollitia quod, enim quo
                laboriosam possimus expedita atque neque illo laudantium commodi ut impedit cumque perferendis! Vitae et
                perferendis cum voluptas eaque!</p>
            <button class="button-style btn-hover">Read More</button>
        </div>
    </div>

    <div class="services-section container-3">
        <h1 class="large-text text-center mb-5">Our Services</h1>
        <div class="container-3-services">
            <div class="service-card">
                <img src="logos/recommendation.png" alt="Recommendation icon" loading="lazy">
                <h2>Recommendations</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quo obcaecati distinctio temporibus
                    suscipit illum placeat alias error voluptas.</p>
            </div>
            <div class="service-card">
                <img src="logos/giftbox.png" alt="Gifting icon" loading="lazy">
                <h2>Gifting</h2>
                <p>Send thoughtful gifts to your loved ones with ease.</p>
            </div>
            <div class="service-card">
                <img src="logos/perfume-spray.png" alt="Refills icon" loading="lazy">
                <h2>Refills</h2>
                <p>Easily reorder your favorite products with one click.</p>
            </div>
            <div class="service-card">
                <img src="logos/refund.png" alt="Returns icon" loading="lazy">
                <h2>Returns</h2>
                <p>Hassle-free returns with easy tracking.</p>
            </div>
        </div>
    </div>

    <div class="products-section container-4">
        <h1 class="big-text text-center">Our products</h1>
        <p class="text-center mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <div class="category-nav">
            <ul class="nav-pills">
                <li><a href="{{ route('products.index') }}"
                        class="nav-link {{ !request('category') ? 'active' : '' }}">All</a></li>
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('products.index', ['category' => $category->id]) }}"
                            class="nav-link {{ request('category') == $category->id ? 'active' : '' }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="container-4-collection">
            @if (isset($products) && count($products) > 0)
                @foreach ($products as $product)
                    <div class="product-card">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy"
                            class="img-fluid rounded">
                        <div class="product-info">
                            <h3>{{ $product->name }}</h3>
                            <p>${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-products">
                    <p>No products available at the moment.</p>
                </div>
            @endif
        </div>
    </div>

    <div class="testimonial-section">
        <h1 class="large-text text-center mb-5">What Our Customers Say</h1>
        <div class="testimonial-carousel">
            @if (isset($testimonials) && count($testimonials) > 0)
                <div class="swiper testimonial-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="testimonial">
                                    <div class="quote">"{{ $testimonial->comment }}"</div>
                                    <div class="author">-
                                        {{ isset($testimonial->user) ? $testimonial->user->name : $testimonial->author }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            @else
                <div class="no-testimonials">
                    <p>No testimonials available at the moment.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
