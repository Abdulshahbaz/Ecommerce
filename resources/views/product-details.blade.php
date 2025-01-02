@extends('layout.app')
@section('content')
@include('layout.hero-section')
<style>
    .add-to-cart {
    background-color: #7fad39;
}

.remove-cart {
    background-color: #ff0000;
}
 </style>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('file/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Vegetable’s Package</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <a href="./index.html">Vegetables</a>
                        <span>Vegetable’s Package</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{asset('admin/img/'.$get_product_detail->image)}}" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="{{asset('file/img/product/details/product-details-2.jpg')}}"
                            src="img/product/details/thumb-1.jpg')}}" alt="">
                        <img data-imgbigurl="{{asset('file/img/product/details/product-details-3.jpg')}}"
                            src="img/product/details/thumb-2.jpg')}}" alt="">
                        <img data-imgbigurl="{{asset('file/img/product/details/product-details-5.jpg')}}"
                            src="img/product/details/thumb-3.jpg')}}" alt="">
                        <img data-imgbigurl="{{asset('file/img/product/details/product-details-4.jpg')}}"
                            src="img/product/details/thumb-4.jpg')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{$get_product_detail->name}}</h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div>
                    <div class="product__details__price">${{$get_product_detail->price}}</div>
                    <p>{!!$get_product_detail->desc!!}</p>
                    <div class="product__details__quantity">
                        <div class="quantity" style="display: flex; align-items: center;">
                            <a type="button" class="btn-qty dec" style="padding: 5px; cursor: pointer;">-</a>
                            <input type="text"  class="item-qty" data-id="{{ $get_product_detail->id }}" 
                                   data-price="{{ $get_product_detail->price }}"
                                   style="text-align: center; width: 50px; margin: 0 5px;">
                            <a type="button" class="btn-qty inc" style="padding: 5px; cursor: pointer;">+</a>
                        </div>
                    </div>
                    {{-- <a href="#" class="primary-btn">ADD TO CARD</a> --}}
                    <a href="javascript:void(0)" class="primary-btn toggle-cart-btn"
                    data-id="{{$get_product_detail->id}}" id="toggle-cart-btn-{{$get_product_detail->id}}">ADD TO CARD</a>

                    <a href="javascript:void(0)"  class="heart-icon" data-id="{{$get_product_detail->id}}">
                        <span class="icon_heart_alt"></span>
                    </a>
                   
                    <ul>
                        <li><b>Availability</b> <span>In Stock</span></li>
                        <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                        <li><b>Weight</b> <span>0.5 kg</span></li>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
           
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                aria-selected="false">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">Reviews <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                    Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus
                                    suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam
                                    vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
                                    Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,
                                    accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a
                                    pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula
                                    elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci luctus
                                    et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam
                                    vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                    ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                    elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                    porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                    nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                                    Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
                                    porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
                                    sed sit amet dui. Proin eget tortor risus.</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                    Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                    Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                    sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                    eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                    Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                    sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                    diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                    ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                    Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                    Proin eget tortor risus.</p>
                                <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                    ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                    elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                    porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                    nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                    Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                    Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                    sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                    eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                    Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                    sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                    diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                    ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                    Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                    Proin eget tortor risus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($related_products as $related_product)          
            <div class="col-lg-3 col-md-4  mx {{$related_product->category->slug_name}}">
                <div class="product__item">
                    <div class="product__item__pic set-bg">    
                        <img class="product__details__pic__item--large"
                        src="{{asset('admin/img/'.$related_product->image)}}" alt="">
                        <ul class="product__item__pic__hover">

                            <li> <a href="javascript:void(0)" class="heart-icon" data-id="{{$related_product->id}}">
                                <i class="fa fa-heart"></i>
                            </a></li>
                            
                            <li><a href="{{route('shoping.cart')}}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="{{route('product.details',$related_product->id)}}">{{$related_product->name}}</a></h6>
                        <h5>${{$related_product->price}}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
<script>
$(document).ready(function () {
$.ajax({
    url: "{{ route('cart.products') }}",
    type: 'GET',
    success: function (cartProducts) {
        $('.toggle-cart-btn').each(function () {
            let productId = $(this).data('id');
            let qtyInput = $(`.item-qty[data-id="${productId}"]`);
            if (cartProducts.includes(productId)) {
                $(this)
                    .text('Remove Cart')
                    .removeClass('add-to-cart')
                    .addClass('remove-cart')
                    .addClass('red');
                    if (qtyInput.length) {
                        qtyInput.val(1);
                    }
            } else {
                $(this)
                    .text('Add Cart')
                    .removeClass('remove-cart')
                    .addClass('add-to-cart')
                    .addClass('green');
                    if (qtyInput.length) {
                        qtyInput.val(0);
                    }
            }
        });
    },
    error: function () {
        alert('Unable to fetch cart details.');
    }
});

// Add to Cart
$(document).on('click', '.add-to-cart', function (e) {
    e.preventDefault();
    let productId = $(this).data('id');
    let qtyInput = $(`.item-qty[data-id="${productId}"]`);
    let quantity = qtyInput.length ? qtyInput.val() : 1;
    $.ajax({
        url: "{{ route('cart.add', ':id') }}".replace(':id', productId),
        type: 'GET',
        data: {
                    product_id: productId,
                    quantity: quantity,
                    _token: "{{ csrf_token() }}"
        },
        success: function (response) {
            alert(response.message);
            $('#toggle-cart-btn-' + productId)
                .text('Remove Cart')
                .removeClass('add-to-cart')
                .addClass('remove-cart');
                if (qtyInput.length) {
                    qtyInput.val(quantity);
                    }
            updateCartCount();
        },
        error: function (xhr) {
            alert('Something went wrong, please try again.');
        }
    });
});

// Remove from Cart
$(document).on('click', '.remove-cart', function (e) {
    e.preventDefault();
    let productId = $(this).data('id');
    let qtyInput = $(`.item-qty[data-id="${productId}"]`);
    $.ajax({
        url: "{{ route('cart.remove', ':id') }}".replace(':id', productId),
        type: 'GET',
        data: {
                    product_id: productId,
                    _token: "{{ csrf_token() }}"
                },
        success: function (response) {
            alert(response.message);
            $('#toggle-cart-btn-' + productId)
                .text('Add Cart')
                .removeClass('remove-cart')
                .addClass('add-to-cart');
                if (qtyInput.length) {
                        qtyInput.val(0);
                    }
            updateCartCount();
        },
        error: function (xhr) {
            alert('Error: ' + xhr.responseJSON.message);
        }
    });
});
});

function updateCartCount() {
    $.ajax({
        url: "{{ route('cart.count') }}",
        type: 'GET',
        success: function(response) {
            $('#cart-count').text(response.count);
        },
        error: function(xhr) {
            console.log('Unable to fetch cart count');
        }
    });
}
</script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.heart-icon').forEach(button =>
          button.addEventListener('click', e => {
              e.preventDefault();
              const heartCountElement = document.getElementById('heart-count');
              heartCountElement.textContent = 
                  parseInt(heartCountElement.textContent || 0, 10) + 1;
          })
      );
  });
  </script>
<script>
    $(document).ready(function () {
    $(".btn-qty").on("click", function () {
        let $input = $(this).siblings('.item-qty');
        let currentValue = parseInt($input.val());
        let itemId = $input.data('id');

        if ($(this).hasClass("inc"))
       {
            currentValue += 1;
        }
         else if ($(this).hasClass("dec") && currentValue > 1)
       {
            currentValue -= 1;
        }

        $input.val(currentValue);
        
        $.ajax({
            url: '/cart/update',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', 
                id: itemId,
                qty: currentValue
            },
            success: function (response) {
                console.log("Cart updated successfully");
            },
            error: function () {
                alert("Error updating cart");
            }
        });

    });
});
</script>
@endsection