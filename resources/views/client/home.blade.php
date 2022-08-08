@extends('client.layout.main')
@section('title', 'home')

@section('content')


    <!-- Mobile Nav (max width 767px)-->
    <div class="mobile-nav">
        <!-- Navbar Brand -->
        <div class="amado-navbar-brand">
            <a href="{{route('home')}}"><img src="frontend/img/core-img/logo.png" alt=""></a>
        </div>
        <!-- Navbar Toggler -->
        <div class="amado-navbar-toggler">
            <span></span><span></span><span></span>
        </div>
    </div>

    <!-- Product Catagories Area Start -->
    <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix ">
            <!-- Single Catagory -->
            @foreach ($products as $product)
                <div class="single-products-catagory clearfix" style="overflow: hidden; height: 500px">
                    <a href="{{ route('sl-product', $product) }}">
                        <img src="{{ asset($product->main_img) }}" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From ${{ $product->price }}</p>
                            <h4>{{ $product->name   }}</h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Product Catagories Area End -->

    <!-- ##### Main Content Wrapper End ##### -->
    {{-- <h1>abc</h1> --}}
@endsection
