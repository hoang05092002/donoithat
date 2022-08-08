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
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($products) --}}
                                @foreach ($products as $id => $product)
                                    <tr>
                                        <td class="cart_product_img">
                                            <a href="{{ route('sl-product', $id) }}">
                                                <img src="{{ asset($product->main_img) }}" width="200" alt="Product">
                                            </a>
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
                                                <div class="ml-5">
                                                    <button class="btn btn-danger btn-sm rounded-2" type="button"
                                                        data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <button class="btn amado-btn mb-15">Update Cart</button>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <h5>Cart Total</h5>
                        <ul class="summary-table">
                            <li><span>subtotal:</span>
                                <span>
                                    {{ $total }} VND
                                </span>
                            </li>
                            <li><span>delivery:</span> <span>Free</span></li>
                            <li><span>total:</span> <span>{{ $total }} VND</span></li>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#deleteCart').on('click', function(e) {
            swal("Product removed from cart successfully", "success");
            $.ajax({
                type: 'get',
                url: '/deleteCart',
                data: {
                    'product_id': $('#product_id').val(),
                },
                success: function(data) {
                    console.log(data);
                }
            });
        })
    </script>
@endsection
