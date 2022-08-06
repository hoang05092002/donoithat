@extends('client.layout.main')

@section('title', 'Cart')

@section('content')
    <div class="cart-table-area section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="cart-title mt-50">
                        <h2>Shopping Cart</h2>
                    </div>

                    <div class="cart-table clearfix">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($products) --}}
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="cart_product_img">
                                            <a href="{{ route('sl-product', $product) }}"><img
                                                    src="{{ asset($product->main_img) }}" width="200" alt="Product"></a>
                                        </td>
                                        <td class="cart_product_desc">
                                            <h5>{{ $product->name }}</h5>
                                        </td>
                                        <td class="price">
                                            <span>{{ $product->price }}</span>
                                        </td>
                                        <td class="qty">
                                            <div class="qty-btn d-flex">
                                                <div class="quantity">
                                                    <span class="qty-minus"
                                                        onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                                            class="fa fa-minus" aria-hidden="true"></i></span>
                                                    <input type="number" class="qty-text" id="qty" step="1"
                                                        min="1" max="300" name="quantity"
                                                        value="{{ $product->discount }}">
                                                    <span class="qty-plus"
                                                        onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                                            class="fa fa-plus" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <h5>Cart Total</h5>
                        <ul class="summary-table">
                            <li><span>subtotal:</span>
                                <span>
                                    ${{ $total }}
                                </span>
                            </li>
                            <li><span>delivery:</span> <span>Free</span></li>
                            <li><span>total:</span> <span>${{ $total }}</span></li>
                        </ul>
                        <div class="cart-btn mt-100">
                            <form action="{{ route('checkout.index') }}" method="post">
                                @csrf
                                <button type="submit" class="btn amado-btn w-100">Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
