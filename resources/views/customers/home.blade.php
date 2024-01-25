@vite(["resources/sass/app.scss", "resources/js/app.js"])
<x-layout>
    @include('layouts/nav')
    <div class="container-fluid p-0">
        <div class="ratio ratio-21x9 bg-dark position-relative">
            <img src="{{asset('images/home_2.webp')}}" class="w-100 object-fit-contain opacity-75" alt="home">
            <div
                class="position-absolute luxury-font text-white text-capitalize d-flex justify-content-center align-items-center flex-column">
                <span class="fs-1 fade-in fade-bottom">
                    Year of the Dragon
                </span>
                <p class="fade-in fade-bottom">
                    Celebrate Spring Festival with the gift of play
                </p>
            </div>
        </div>
    </div>
    {{--  Products  --}}
    <div class="container text-dark mt-5 bg-white rounded">
        <div class="fs-1 pt-5 luxury-font home-product-text fade-in text-center fade-top">
            Spring Festival gift ideas
        </div>
        <div class="d-flex justify-content-evenly align-items-center mt-5 fade-in fade-bottom">
            <div class="w-20 text-center home-product-card">
                <div class="w-100 bg-warning rounded">
                    <img src="{{asset('images/product_1.webp')}}" class="p-3" alt="product">
                </div>
                <h5 class="mt-3">Auspicious Dragon</h5>
                <p>Mark the Year of the Dragon with this colorful LEGO® set</p>
            </div>
            <div class="w-20 text-center home-product-card">
                <div class="w-100 bg-warning rounded">
                    <img src="{{asset('images/product_2.webp')}}" class="p-3" alt="product">
                </div>
                <h5 class="mt-3">Family Reunion Celebration</h5>
                <p>Enjoy a Spring Festival tradition at a Chinese-style restaurant.</p>
            </div>
            <div class="w-20 text-center home-product-card">
                <div class="w-100 bg-warning rounded">
                    <img src="{{asset('images/product_3.webp')}}" class="p-3" alt="product">
                </div>
                <h5 class="mt-3">Money Tree</h5>
                <p>Build this traditional New Year gift, adorned with riches and rewards.</p>
            </div>
            <div class="w-20 text-center home-product-card">
                <div class="w-100 bg-warning rounded">
                    <img src="{{asset('images/product_4.webp')}}" class="p-3" alt="product">
                </div>
                <h5 class="mt-3">Festival Calendar</h5>
                <p>Give this rotating set, featuring traditional New Year symbols.</p>
            </div>
        </div>
    </div>
    {{--  End Products  --}}
    <div class="container-fluid p-0">
        <div class="ratio ratio-21x9 bg-dark position-relative">
            <img src="{{asset('images/home_3.webp')}}" class="w-100 object-fit-contain opacity-75" alt="home">
            <div
                class="position-absolute luxury-font text-white text-capitalize d-flex justify-content-center align-items-center flex-column">
                <span class="fs-1 fade-in fade-bottom">
                    Give love that’s built to last
                </span>
                <p class="fade-in fade-bottom">
                    This Valentine’s Day, give a LEGO® gift from the heart
                </p>
            </div>
        </div>
    </div>
    {{--  Products  --}}
    <div class="container text-dark mt-5 bg-white rounded">
        <div class="fs-1 pt-5 luxury-font home-product-text fade-in text-center fade-top">
            Valentine's Day Ideas
        </div>
        <div class="d-flex justify-content-evenly align-items-center mt-5 fade-in fade-bottom">
            <div class="w-20 text-center home-product-card">
                <div class="w-100 bg-danger rounded">
                    <img src="{{asset('images/product_5.webp')}}" class="p-3" alt="product">
                </div>
                <h5 class="mt-3">Bouquet of Roses</h5>
                <p>Give a radiant bouquet filled with a dozen buildable red roses</p>
            </div>
            <div class="w-20 text-center home-product-card">
                <div class="w-100 bg-danger rounded">
                    <img src="{{asset('images/product_6.webp')}}" class="p-3" alt="product">
                </div>
                <h5 class="mt-3">Tiny Plants</h5>
                <p>Craft 9 plants each nestled in a terracotta-colored plant pot</p>
            </div>
            <div class="w-20 text-center home-product-card">
                <div class="w-100 bg-danger rounded">
                    <img src="{{asset('images/product_7.webp')}}" class="p-3" alt="product">
                </div>
                <h5 class="mt-3">Vincent van Gogh - The Starry Night</h5>
                <p>Give a gift of mindful building and artistic expression</p>
            </div>
            <div class="w-20 text-center home-product-card">
                <div class="w-100 bg-danger rounded">
                    <img src="{{asset('images/product_8.webp')}}" class="p-3" alt="product">
                </div>
                <h5 class="mt-3">Wildflower Bouquet</h5>
                <p>Go wild with an arrangement that can be displayed forever</p>
            </div>
        </div>
    </div>
    {{--  End Products  --}}
    <div class="container-fluid p-0 mt-5">
        <div class="ratio ratio-21x9 bg-dark position-relative">
            <img src="{{asset('images/home_1.webp')}}" class="w-100 opacity-75 object-fit-cover" alt="">
            <div
                class="position-absolute text-white d-flex justify-content-center align-items-center">
                <div class="container d-flex justify-content-between fade-in fade-bottom">
                    <div class="w-25 text-center d-flex justify-content-center align-items-center flex-column">
                        <i class="bi bi-truck fs-2 p-2"></i>
                        <div class="text-uppercase">FREE SHIPPING AND RETURNS</div>
                        <p>Safety and easiness guaranteed on your shopping</p>
                    </div>
                    <div class="w-25 text-center d-flex justify-content-center align-items-center flex-column">
                        <i class="bi bi-chat-dots fs-2 p-2"></i>
                        <div class="text-uppercase">ONLINE CLIENT ADVISOR</div>
                        <p>Our Client Advisors will guide you through a personalized shopping experience</p>
                    </div>
                    <div class="w-25 text-center d-flex justify-content-center align-items-center flex-column">
                        <i class="bi bi-gift fs-2 p-2"></i>
                        <div class="text-uppercase">GIFT BOX AVAILABLE</div>
                        <p>Free and customizable gift box for your goods</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts/scroll_to_top')
    @include('layouts/footer')
</x-layout>
<script src="{{asset('frontend/js/home.js')}}"></script>
