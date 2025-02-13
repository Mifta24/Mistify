<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Perfume store</title>
    <link rel="stylesheet" href="{{ asset('css/style/styles.css') }}">

</head>
<body>
    <nav class="nav-bar">
        <a id = "logo" href="#">Essence</a>
        <div class="nav-bar-links">
            <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
        <button class="button-style">Order Now</button></div>
    </nav>
    <nav class="nav-bar-responsive">
        <a id = "logo" href="#">Essence</a>
        <div class="nav-bar-links">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
              </svg>
        </div>
    </nav>

    <div class="container-1">
        <div class="container-text">
            <h1 class="large-text">We care about Fragrances</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum optio ea eos minus quae architecto cumque ipsa eius exercitationem nisi, et enim saepe sequi voluptates ducimus provident, nemo aut molestias!</p>
            <button class="button-style">See more</button>
        </div>
        <div id="image-container-1">
            <!-- <img src="images/first-image.png" alt="image"> -->
        </div>
    </div>

    <div class="container-2">
        <div class="slogan">
            <h1 class="large-text">Essence</h1>
            <p>Luxury Defined. One Drop at a Time.</p>
        </div>
        <div>
            <img src="images/second-image.jpg" alt="">
        </div>
        <div class="container-text">
            <h2 class="big-text">Why shop with Essence</h2>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Mollitia quod, enim quo laboriosam possimus expedita atque neque illo laudantium commodi ut impedit cumque perferendis! Vitae et perferendis cum voluptas eaque!</p>
            <button class="button-style">Read More</button>
        </div>
    </div>

    <div class="container-3">
        <h1 class="large-text">Our Services</h1>
        <div class="container-3-services">
            <div>
                <img src="logos/recommendation.png" alt="">
                <h2>Recommendations</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quo obcaecati distinctio temporibus suscipit illum placeat alias error voluptas.</p>
            </div>
            <div>
                <img src="logos/giftbox.png" alt="">
                <h2>Gifting</h2>
                <p>Quo obcaecati distinctio temporibus suscipit illum placeat alias error voluptas.</p>
            </div>
            <div>
                <img src="logos/perfume-spray.png" alt="">
                <h2>Refills</h2>
                <p>Suspendisse mauris nulla, elementum a consectetur sit amet, dapibus eget mauris.</p>
            </div>
            <div>
                <img src="logos/refund.png" alt="">
                <h2>Returns</h2>
                <p>Ut vel felis at mi semper mollis.</p>
            </div>
        </div>
    </div>

    <div class="container-4">
        <h1 class="big-text">Our products</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <div>
            <ul>
                <li><a href="#">Floral</a></li>
                <li><a href="#">Woody</a></li>
                <li><a href="#">Fruity</a></li>
                <li><a href="#">Fresh</a></li>
        </ul>
    </div>

    <div class="container-4-collection">
        <img src="images/perfume-image1.jpg" alt="">
       <img src="images/perfume-image2.jpg" alt="">
        <img src="images/perfume-image3.jpg" alt="">
        <img src="images/perfume-image4.jpg" alt="">
        <img src="images/perfume-image5.jpg" alt="">
        <img src="images/perfume-image6.jpg" alt="">
    </div>
    </div>

    <footer id="footer">
        <div>
            <h1 class="big-text">Essence</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo architecto ut veritatis illum quaerat. Ea similique harum repellat excepturi! Consequuntur iusto deserunt accusantium tempore ullam.</p>
            <p>&copy; 2024 Essence - All rights Reserved</p>

        </div>
        <div>
            <h2 class="big-text">Opening Times</h2>
            <p>Monday: Friday: 10.00 - 23.00
                <br>
                Saturday: 10.00 - 19.00</p>
                <div id="social-logos">
                    <img src="{{ asset('logos') }}/facebook.png" alt="">
                    <img src="{{ asset('logos') }}/instagram.png" alt="">
                    <img src="{{ asset('logos') }}/twitter.png" alt="">
                    <img src="{{ asset('logos') }}/pinterest.png" alt="">
                </div>
        </div>
        <div>
            <h2 class="big-text">Contact Us </h2>
            <p>Tel: (+12) 345 678 910</p>
            <p>Email: info@essence.com</p>
            <p>Address: 12345 Street Name, City Name, Country</p>

        </div>
    </footer>
</body>
</html>
