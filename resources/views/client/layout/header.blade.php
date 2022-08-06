<!-- Header Area Start -->
<header class="header-area clearfix">
    <!-- Close Icon -->
    <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    <!-- Logo -->
    <div class="logo">
        <a href="index.html"><img src="{{ asset('frontend/img/core-img/logo.png') }}" alt=""></a>
    </div>
    <!-- Amado Nav -->
    <nav class="amado-nav">
        <ul>
            @if (isset($nav_hover))
                <li class="{{ $nav_hover == 'home' ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                <li class="{{ $nav_hover == 'shop' ? 'active' : '' }}"><a href="{{ route('shop') }}">Shop</a></li>
                <li class="{{ $nav_hover == 'contact' ? 'active' : '' }}"><a href="{{ route('contact') }}">ContactUs</a>
                </li>
            @endif
        </ul>
    </nav>

    @if (Auth::user() == null)
        <div class="amado-btn-group mt-30 mb-100">
            <a href="{{ route('sign-in') }}" class="btn amado-btn mb-15">Sign In</a>
            <a href="{{ route('register') }}" class="btn amado-btn mb-15">Register</a>

        </div>
    @else
        <a href="{{route('users')}}" class="btn amado-btn mb-15">Profile</a>
        @if (Auth::user()->role == 0)
            <a href="{{ route('admin.dashboard') }}" class="btn amado-btn mb-15 text">Administrator</a>
        @endif
    @endif
    <!-- Cart Menu -->
    <div class="cart-fav-search mb-100">
        <a href="{{ route('cart.list') }}" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Cart
            <span>({{ Auth::user() ? Auth::user()->amount_cart : 0 }})</span></a>
        <a href="#" class="fav-nav"><img src="img/core-img/favorites.png" alt=""> Favourite</a>
        <a href="#" class="search-nav"><img src="img/core-img/search.png" alt=""> Search</a>
    </div>
    <!-- Social Button -->
    <div class="social-info d-flex justify-content-between">
        <a href="#"><i class="fa-brands fa-pinterest-square" aria-hidden="true"></i></i></a>
        <a href="#"><i class="fa-brands fa-instagram-square" aria-hidden="true"></i></a>
        <a href="#"><i class="fa-brands fa-facebook-square" aria-hidden="true"></i></a>
        <a href="#"><i class="fa-brands fa-twitter-square" aria-hidden="true"></i></a>
    </div>

    @if (Auth::user())
        <div class="amado-btn-group mt-30 mb-100">
            <a href="{{ route('logout') }}" class="btn amado-btn mb-15">Logout</a>
        </div>
    @endif
</header>
<!-- Header Area End -->
