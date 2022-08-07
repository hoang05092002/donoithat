@extends('client.layout.main')

@section('title', 'Shop')

@section('content')
    <div class="shop_sidebar_area">

        <!-- ##### Single Widget ##### -->
        <div class="widget catagory mb-50">
            <!-- Widget Title -->
            <h6 class="widget-title mb-30">Catagories</h6>

            <!--  Catagories  -->
            <div class="catagories-menu">
                <ul>
                    @foreach ($catalogs as $catalog)
                        <li><a href="#">{{ $catalog->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- ##### Single Widget ##### -->
        <div class="widget brands mb-50">
            <!-- Widget Title -->
            <h6 class="widget-title mb-30">Brands</h6>

            <div class="widget-desc">
                <!-- Single Form Check -->
                @foreach ($brands as $brand)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="{{ $brand->brand }}">
                        <label class="form-check-label" for="{{ $brand->brand }}">{{ $brand->brand }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="widget brands mb-50">
            <!-- Widget Title -->
            <h6 class="widget-title mb-30">Size</h6>

            <div class="widget-desc">
                <!-- Single Form Check -->
                @foreach ($sizes as $size)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="{{ $size->size }}"
                            value="{{ $size->size }}">
                        <label class="form-check-label" for="{{ $size->size }}">
                            {{ $size->size == 0 ? 'Big Size' : '' }}
                            {{ $size->size == 1 ? 'Medium size' : '' }}
                            {{ $size->size == 2 ? 'Small Size' : '' }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ##### Single Widget ##### -->
        {{-- <div class="widget color mb-50">
            <!-- Widget Title -->
            <h6 class="widget-title mb-30">Color</h6>

            <div class="widget-desc">
                <ul class="d-flex">
                    <li><a href="#" class="color1"></a></li>
                    <li><a href="#" class="color2"></a></li>
                    <li><a href="#" class="color3"></a></li>
                    <li><a href="#" class="color4"></a></li>
                    <li><a href="#" class="color5"></a></li>
                    <li><a href="#" class="color6"></a></li>
                    <li><a href="#" class="color7"></a></li>
                    <li><a href="#" class="color8"></a></li>
                </ul>
            </div>
        </div>

        <!-- ##### Single Widget ##### -->
        <div class="widget price mb-50">
            <!-- Widget Title -->
            <h6 class="widget-title mb-30">Price</h6>

            <div class="widget-desc">
                <div class="slider-range">
                    <div data-min="10" data-max="1000" data-unit="$"
                        class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                        data-value-min="10" data-value-max="1000" data-label-result="">
                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                    </div>
                    <div class="range-price">$10 - $1000</div>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="amado_product_area section-padding-100">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                        <form action="">
                            <div class="input-group rounded">
                                <input type="search" name="search" class="form-control rounded" placeholder="Search"
                                    aria-label="Search" aria-describedby="search-addon" />
                                <a href="" class="ml-2">
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </a>
                            </div>
                        </form>
                        <div class="product-sorting d-flex">
                            <div class="sort-by-date d-flex align-items-center mr-15">
                                <p>Sort by</p>
                                <form action="#" method="get">
                                    <select name="select" id="sortBydate">
                                        <option value="value">Date</option>
                                        <option value="value">Newest</option>
                                        <option value="value">Popular</option>
                                    </select>
                                </form>
                            </div>
                            <div class="view-product d-flex align-items-center">
                                <p>View</p>
                                <form action="#" method="get">
                                    <select name="select" id="viewProduct">
                                        <option value="value">12</option>
                                        <option value="value">24</option>
                                        <option value="value">48</option>
                                        <option value="value">96</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Single Product Area -->
                @foreach ($products as $product)
                    <div class="col-12 col-sm-3 col-md-12 col-xl-3">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img" style="height:200px">
                                <a href="{{ route('sl-product', $product) }}">
                                    <img src="{{ asset($product->main_img) }}" alt="">
                                </a>
                                <!-- Hover Thumb -->
                                {{-- <img class="hover-img" src="{{ asset($product->image)" alt=""> --}}
                            </div>

                            <!-- Product Description -->
                            <div class="product-description d-flex align-items-center justify-content-between">
                                <!-- Product Meta Data -->
                                <div class="product-meta-data">
                                    <div class="line"></div>
                                    <p class="product-price">{{ $product->price }} $</p>
                                    <a href="product-details.html">
                                        <h6>{{ $product->name }}</h6>
                                    </a>
                                </div>
                                <!-- Ratings & Cart -->
                                <div class="ratings-cart text-right">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <div class="cart mr-2">
                                        <form class="addToCart">
                                            {{-- @csrf --}}
                                            @if (Auth::user())
                                                <input type="hidden" name="auth" value="{{ Auth::user()->id }}" />
                                            @endif
                                            <input class="product_id" type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="button" class="btn btn-default" id="addToCart"><img
                                                    src="frontend/img/core-img/cart.png" alt=""></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Single Product Area -->
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#addToCart').on('click', function(e) {
            swal("Good job!", "You clicked the button!", "success");
            $.ajax({
                type: 'get',
                url: '/addToCart',
                data: {
                    'product_id': $('.product_id').val(),
                },
                success: function(data) {
                    console.log(data);
                }
            });

        })
    </script>
    <!-- ##### Main Content Wrapper End ##### -->
@endsection
