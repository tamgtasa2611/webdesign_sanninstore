@vite(["resources/sass/app.scss", "resources/js/app.js"])
<x-layout>
    @include('layouts/nav')
    <div class="container-fluid vh-100 py-3 fs-6">
        <div class="d-flex justify-content-between">
            <div class="w-100 text-capitalize text-center fs-4 fw-bold">Lego Products</div>
        </div>
        <hr>
        <div class="d-flex">
            <div class="w-20 pe-3">
                <div class="w-100">Filters</div>
                <hr>
                <form action="" method="get">
                    <div class="w-100 filter-item">
                        <div>
                            <div class="d-flex justify-content-between align-items-center hover-pointer filter-main"
                                 data-bs-toggle="collapse" data-bs-target="#sort" aria-expanded="false"
                                 aria-controls="sort">
                                <div class="filter-title">Sort by</div>
                                <div>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                            <div class="collapse collapsing expand" id="sort">
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sort" id="re" value=""
                                               checked>
                                        <label class="form-check-label" for="re">
                                            Recommended
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sort" id="ne" value="">
                                        <label class="form-check-label" for="ne">
                                            Newest
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sort" id="lo" value="">
                                        <label class="form-check-label" for="lo">
                                            Price: Low to High
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sort" id="hi" value="">
                                        <label class="form-check-label" for="hi">
                                            Price: High to Low
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <div class="w-100 filter-item">
                        <div>
                            <div class="d-flex justify-content-between align-items-center hover-pointer filter-main"
                                 data-bs-toggle="collapse" data-bs-target="#price" aria-expanded="false"
                                 aria-controls="price">
                                <div class="filter-title">Price</div>
                                <div>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                            <div class="collapse collapsing expand" id="price">
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="price" id="0" value=""
                                        >
                                        <label class="form-check-label" for="0">
                                            $0 - $50
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="price" id="1" value="">
                                        <label class="form-check-label" for="1">
                                            $50 - $100
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="price" id="2" value="">
                                        <label class="form-check-label" for="2">
                                            $100 - $200
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="price" id="3" value="">
                                        <label class="form-check-label" for="3">
                                            > $200
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <div class="w-100 filter-item">
                        <div>
                            <div class="d-flex justify-content-between align-items-center hover-pointer filter-main"
                                 data-bs-toggle="collapse" data-bs-target="#brand" aria-expanded="false"
                                 aria-controls="brand">
                                <div class="filter-title">Brand</div>
                                <div>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                            <div class="collapse collapsing expand" id="brand">
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="brand" id="ga" value=""
                                        >
                                        <label class="form-check-label" for="ga">
                                            Giorgio Armani
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="brand" id="ch" value="">
                                        <label class="form-check-label" for="ch">
                                            Channel
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="brand" id="di" value="">
                                        <label class="form-check-label" for="di">
                                            Dior
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="brand" id="dg" value="">
                                        <label class="form-check-label" for="dg">
                                            Dolce & Gabbana
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <a href="" class="btn btn-dark w-45">Reset</a>
                        <button class="btn btn-primary w-45">Apply</button>
                    </div>
                </form>
            </div>
            <div class="w-80">
                <div class="w-100 text-end">
                    <div>
                        Showing {{count($products)}} products
                    </div>
                </div>
                <hr>
                <div class="container text-center">
                    <div class="row row-cols-3">
                        @foreach($products as $product)
                            <div class="col shadow border">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img
                                        src="{{$product->image}}"
                                        width="200px" alt="">
                                </div>
                                <div>
                                    {{$product->product_name}}
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="w-50 text-start p-3 text-success fw-bold">${{$product->price}}</div>
                                    <div class="d-flex w-50 justify-content-end">
                                        <div>
                                            <i class="p-3 bi bi-star bg-warning"></i>
                                        </div>
                                        <div>
                                            <i class="p-3 bi bi-bag bg-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('layouts/footer')
</x-layout>
<script src="{{asset('frontend/js/product.js')}}"></script>
