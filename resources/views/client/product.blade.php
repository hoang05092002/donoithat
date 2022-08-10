@extends('client.layout.main')

@section('title', 'Product')

@section('content')
<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-50">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('shop')}}">Shop</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$catalog->name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url('{{asset($product->main_img)}}');">
                            </li>
                            @foreach($images as $image)
                            <li data-target="#product_details_slider" data-slide-to="{{$image->sort_id}}" style="background-image: url('{{asset($image->link)}}');">
                            </li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a class="gallery_img" href="frontend/img/product-img/pro-big-1.jpg">
                                    <img class="d-block w-100" src="{{asset($product->main_img)}}" alt="First slide">
                                </a>
                            </div>
                            {{-- @dd($images) --}}
                            @foreach($images as $image)

                            <div class="carousel-item">
                                <a class="gallery_img" href="frontend/img/product-img/pro-big-2.jpg">
                                    <img class="d-block w-100" src="{{asset($image->link)}}" alt="
                                    @if ($image->id == 1)
                                        'Second slide'
                                    @elseif ($image->id == 2)
                                        'Third slide'
                                    @else
                                        'Fourth slide';
                                    @endif">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="single_product_desc">
                    <!-- Product Meta Data -->
                    <div class="product-meta-data">
                        <div class="line"></div>
                        <p class="product-price">${{$product->price}}</p>
                        <a href="product-details.html">
                            <h6>{{$product->name}}</h6>
                        </a>
                        <!-- Ratings & Review -->
                        <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="review">
                                <a href="#">Write A Review</a>
                            </div>
                        </div>
                        <!-- Avaiable -->
                        <p class="avaibility"><i class="fa fa-circle"></i> In Stock</p>
                    </div>

                    <div class="short_overview my-5">
                        <p>{{$product->description}}</p>
                    </div>

                    <!-- Add to Cart Form -->
                    <form class="cart clearfix addToCart">
                        @csrf
                        <div class="cart-btn d-flex mb-50">
                            <p>Qty</p>
                            <div class="quantity">
                                <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                <input type="number" name="discount" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="1">
                                <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                            </div>
                            <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                        </div>
                        <button type="button" id="addToCart" name="addtocart" class="btn amado-btn">Add to cart</button>
                    </form>

                </div>
            </div>
        </div>

        <div class="tab-pane" id="add-comment">

            <form action="#" method="post" class="form-horizontal" id="commentForm" role="form">
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Comment</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="addComment" id="addComment" rows="5"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span>Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#addToCart').on('click', function(e) {
            swal("Product added to cart successfully", "Please go to cart to see more details !", "success");
            $.ajax({
                type: 'get',
                url: '/addToCart',
                data: {
                    'product_id': $('#product_id').val(),
                    'qty': $('#qty').val(),
                },
                success: function(data) {
                    console.log(data);
                }
            });

        })
    </script>
@endsection
