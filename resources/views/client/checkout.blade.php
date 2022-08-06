@extends('client.layout.main')

@section('title', 'Checkout')

@section('content')
    <!-- Mobile Nav (max width 767px)-->
    <div class="cart-table-area section-padding-100">
        <div class="container-fluid">
            <form action="{{ route('checkout.order', $total) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">
                            <div class="cart-title">
                                <h2>Checkout</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="name" value=""
                                        placeholder="Name" required name="username">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="email" value="" name="email"
                                        placeholder="Email" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control" id="phone" placeholder="Phone Number" name="user_phone"
                                        value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control" id="address" placeholder="Address" name="address"
                                        value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="message" class="form-control w-100" id="comment" cols="30" rows="10"
                                        placeholder="Leave a comment about your order"></textarea>
                                </div>
                                {{-- <div class="col-12">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">Create an accout</label>
                                </div>
                                <div class="custom-control custom-checkbox d-block">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">Ship to a different
                                        address</label>
                                </div>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span>${{ $total }}</span></li>
                                <li><span>delivery:</span> <span>Free</span></li>
                                <li><span>total:</span> <span>${{ $total }}</span></li>
                            </ul>
                            <div class="payment-method">
                                <!-- Cash on delivery -->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="radio" name="payment" class="custom-control-input" id="cod"
                                        checked value="Cash on Delivery">
                                    <label class="custom-control-label" for="cod">Cash on Delivery</label>
                                </div>
                                <!-- Paypal -->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="radio" name="payment" class="custom-control-input" id="paypal" value="Paypal">
                                    <label class="custom-control-label" for="paypal">Paypal <img class="ml-15"
                                            src="img/core-img/paypal.png" alt=""></label>
                                </div>
                            </div>
                            <div class="cart-btn mt-100">
                                <button type="submit" class="btn amado-btn w-100">Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
