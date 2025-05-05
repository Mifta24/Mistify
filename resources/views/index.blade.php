<x-app-layout>
    <!-- Header Start -->
    <div class="container-1">
        <div class="container-text">
            <h1 class="large-text">We care about Fragrances</h1>
            <p>"Every scent is a journey, evoking memories, creating impressions, and
                leaving an unforgettable charm. From soft, delicate notes to luxurious
                aromas, each drop brings elegance and confidence to every moment"</p>
            <button class="button-style">See more</button>
        </div>
        <div id="image-container-1">
            <img src="images/header.webp" alt="image">
        </div>
    </div>
    <!-- Header End -->

    <!-- Slogan Start -->
    <div class="container-2 mt-12 mx-auto p-6 max-w-5xl rounded-lg flex items-stretch gap-6">
        <!-- Left Section -->
        <div class="w-1/3 text-center flex flex-col justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Mistify</h1>
                <p class="text-lg text-gray-600">A Symphony of Scents, A Touch of Luxury.</p>
                <h2 class="text-xl font-semibold text-gray-800 mt-4">Why Shop with Mistify</h2>
                <p class="text-gray-600 mt-2">
                    Mistify offers premium fragrances designed to captivate and inspire,
                    ensuring every drop brings a touch of luxury!
                </p>
            </div>
            <div class="flex justify-center mt-4">
                <button class="px-6 py-2 border border-pink-500 text-pink-500 font-semibold rounded-lg hover:bg-pink-500 hover:text-white transition duration-300">
                    Read More
                </button>
            </div>
        </div>

        <!-- Middle Section -->
        <div class="w-1/3 flex justify-center">
            <img src="/images/slogan.webp" alt="Essence Image" class="w-full max-w-xs rounded-lg shadow-md" />
        </div>

        <!-- Right Section -->
        <div class="w-1/3 text-center flex flex-col justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Our Promise</h1>
                <p class="text-lg text-gray-600">Luxury You Can Feel, Quality You Can Trust.</p>
                <h2 class="text-xl font-semibold text-gray-800 mt-4">What Makes Us Different</h2>
                <p class="text-gray-600 mt-2">
                    We source the finest ingredients to create fragrances that captivate your senses.
                </p>
            </div>
            <div class="flex justify-center mt-4">
                <button class="px-6 py-2 border border-pink-500 text-pink-500 font-semibold rounded-lg hover:bg-pink-500 hover:text-white transition duration-300">
                    Discover More
                </button>
            </div>
        </div>
    </div>
    <!-- Slogan End -->

    <!-- Services Start -->
    <div class="container-3">
        <h1 class="large-text">Our Services</h1>
        <div class="container-3-services">
            <div>
                <img src="logos/recommendation.png" alt="" loading="lazy">
                <h2>Recommendations</h2>
                <p>Get the best product recommendations tailored for you.</p>
            </div>
            <div>
                <img src="logos/giftbox.png" alt="" loading="lazy">
                <h2>Gifting</h2>
                <p>Send thoughtful gifts to your loved ones with ease.</p>
            </div>
            <div>
                <img src="logos/perfume-spray.png" alt="" loading="lazy">
                <h2>Refills</h2>
                <p>Easily reorder your favorite products with one click.</p>
            </div>
            <div>
                <img src="logos/refund.png" alt="" loading="lazy">
                <h2>Returns</h2>
                <p>Hassle-free returns with easy tracking.</p>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <!-- Products Start -->
    <div class="container-4">
        <h1 class="big-text">Our products</h1>
        <p>Discover our exquisite collection of fragrances, crafted to captivate
            your senses.</p>
        <div>
            <ul>
                <li><a href="#">Floral</a></li>
                <li><a href="#">Woody</a></li>
                <li><a href="#">Fruity</a></li>
                <li><a href="#">Fresh</a></li>
            </ul>
        </div>

        <div class="container-4-collection">
            <img src="images/1.webp" alt="" loading="lazy">
            <img src="images/2.webp" alt="" loading="lazy">
            <img src="images/3.webp" alt="" loading="lazy">
            <img src="images/4.webp" alt="" loading="lazy">
            <img src="images/5.webp" alt="" loading="lazy">
            <img src="images/6.webp" alt="" loading="lazy">
        </div>
    </div>
    <!-- Products End -->
</x-app-layout>