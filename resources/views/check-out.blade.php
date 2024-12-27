
@extends('layout.app')
@section('content')
<style>
    .checkout__input__radio {
    position: relative;
    display: block;
    margin-bottom: 15px;
    cursor: pointer;
    font-size: 16px;
    user-select: none;
}

.checkout__input__radio input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    margin-right: 500px;
}

.checkout__input__radio .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #eee;
    border-radius: 50%;
}

.checkout__input__radio input:checked ~ .checkmark {
    background-color: #2196F3;
}

.checkout__input__radio .checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.checkout__input__radio input:checked ~ .checkmark:after {
    display: block;
}

.checkout__input__radio .checkmark:after {
    top: 6px;
    left: 6px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}

</style>
    @include('layout.hero-section')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('file/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
      @if (session('success'))
        <div class="alert alert-success" id="success-message">{{(session('success'))}}</div>
      @endif
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your
                        code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{ route('check.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="fname" value="{{old('fname')}}">
                                        @error('fname')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="lname"  value="{{old('lname')}}">
                                        @error('lname')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country"  value="{{old('country')}}">
                                @error('country')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address" placeholder="Street Address"
                                    class="checkout__input__add"  value="{{old('address')}}">
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                             
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city"  value="{{old('city')}}">
                                @error('city')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text" name="state"  value="{{old('state')}}">
                                @error('state')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="zip"  value="{{old('zip')}}">
                                @error('zip')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone"  value="{{old('phone')}}">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email"  value="{{old('email')}}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text" name="or_no"  value="{{old('or_no')}}"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                                @error('or_no')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                @foreach ($cart_items as $itemsCart)
                                <ul>
                                    <li>{{$itemsCart->product->name}}<span>${{ $itemsCart->product->price }}</span></li>
                                    {{-- <li>Fresh Vegetable <span>$151.99</span></li>
                                    <li>Organic Bananas <span>$53.99</span></li> --}}
                                </ul>
                                @endforeach
                                <div class="checkout__order__subtotal">Subtotal <span>${{ $total_amount }}</span></div>
                                <div class="checkout__order__total">Total <span>${{$total}}</span>
                                </div>

                                <input type="hidden" name="subtotal" value="{{ $total_amount }}">
                                <input type="hidden" id="coupan_code" name="coupan_code" value="{{ session('coupan_code') }}">
                                
                                <input type="hidden" name="total" value="{{ $total}}">
                                                      
                                {{-- <div class="checkout__input__radio">
                                    <label for="payment" style="margin-left: 31px;">
                                        Cash On Delivery
                                        <input type="radio" id="payment" name="payment_method" value="cash">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__radio">
                                    <label for="paypal" style="margin-left: 31px;">
                                        Online Payment
                                        <input type="radio" id="paypal" name="payment_method" value="online">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>        --}}
                                <button type="submit" class="site-btn" id="rzp-button1">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        setTimeout(function () {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }
        },2000);
    </script>
@endsection
