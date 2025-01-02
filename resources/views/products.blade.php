@extends('layout.app')
@section('content')
<style>
 .product__pagination .pagination {
    margin: 20px 0;
    display: inline-flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem;
}

.product__pagination .pagination li a,
.product__pagination .pagination li span {
    color: #7fad39;
    padding: 10px 15px;
    border: 1px solid #dee2e6;
    margin: 0 2px;
    height: 40px;
    width: 34px;
    font-size: 21px;
    text-decoration: double;
    transition: background-color 0.3s, color 0.3s;
}

.product__pagination .pagination li a:hover,
.product__pagination .pagination li span:hover {
    background-color: #7fad39;
    color: #fff;
    text-decoration: none;
}

.product__pagination .pagination .active span {
    background-color: #7fad39;
    color: #fff;
    border-color: #7fad39;
}

.product__pagination .pagination .disabled span,
.product__pagination .pagination .disabled a {
    color: #6c757d;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

.add-to-cart {
    background-color: #7fad39;
}

.remove-cart {
    background-color: #ff0000;
}

</style>
@include('layout.hero-section')

<section class="breadcrumb-section set-bg" data-setbg="{{asset('file/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Organi Product</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Products</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Category</h4>
                        @foreach ($category_name as $items)
                        <ul>
                            <li>
                                <a href="{{route('products.grid',['id' => $items->id])}}">
                                 {{$items->category_name}}
                                </a>
                            </li>
                        </ul>
                        @endforeach
                    </div>
                    <div class="sidebar__item">
                        <h4>Price</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="10" data-max="540">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Latest Products</h4>
                            <div class="latest-product__slider owl-carousel">
                                @foreach ($latest_products as $key => $items)  
                                @if($key%3==0 || $key==0)
                                    <div class="latest-prdouct__slider__item">
                                @endif
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset('admin/img/' . $items->image) }}" alt=""
                                            style="width: 151px;">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$items->name}}</h6>
                                            <span>${{$items->price}}</span>
                                        </div>
                                    </a>
                                    @if(($key+1)%3==0 || count($latest_products)-1==$key)
                                </div>
                            @endif
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>Sale Off</h2>
                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                            @foreach ($top_rated_products as $key=>$items)
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg"
                                        data-setbg="{{asset('admin/img/'.$items->image)}}">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>{{$items->name}}</span>
                                        {{-- <h5><a href="#">Raisin’n’nuts</a></h5> --}}
                                        <div class="product__item__price">${{$items->price}}</div>
                                    </div>
                                </div>
                            </div>
                          @endforeach
                        </div>
                    </div>
                </div>
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select>
                                    <option value="0">Default</option>
                                    <option value="0">Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>16</span> Products found</h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">                 
                    @foreach ($product_name as $items)
                    <div class="col-lg-4 col-md-4 col-sm-4 mx {{$items->category->slug_name}}">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('admin/img/' . $items->image) }}">
                                <ul class="product__item__pic__hover">
                                    <li> <a href="javascript:void(0)" class="toggle-heart-btn" data-id="{{$items->id}}">
                                        <i class="fa fa-heart"></i>
                                    </a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{route('product.details',$items->id)}}">{{$items->name}}</a></h6>
                                <h5>${{$items->price}}</h5>
                            </div>
                            <a href="javascript:void(0)" class="site-btn w-100 text-center toggle-cart-btn"
                            data-id="{{$items->id}}" id="toggle-cart-btn-{{$items->id}}">Loading...</a>
                        </div>
                    </div>
                    @endforeach            
                </div>
                <div class="product__pagination">
                    <nav>
                        <ul class="pagination justify-content-center">
                            {{ $product_name->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>
                </div>                
            </div>
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
            if (cartProducts.includes(productId)) {
                $(this)
                    .text('Remove Cart')
                    .removeClass('add-to-cart')
                    .addClass('remove-cart')
                    .addClass('red');
            } else {
                $(this)
                    .text('Add Cart')
                    .removeClass('remove-cart')
                    .addClass('add-to-cart')
                    .addClass('green');
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
    $.ajax({
        url: "{{ route('cart.add', ':id') }}".replace(':id', productId),
        type: 'GET',
        success: function (response) {
            alert(response.message);
            $('#toggle-cart-btn-' + productId)
                .text('Remove Cart')
                .removeClass('add-to-cart')
                .addClass('remove-cart');
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
    $.ajax({
        url: "{{ route('cart.remove', ':id') }}".replace(':id', productId),
        type: 'GET',
        success: function (response) {
            alert(response.message);
            $('#toggle-cart-btn-' + productId)
                .text('Add Cart')
                .removeClass('remove-cart')
                .addClass('add-to-cart');
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

{{-- Heart-icon count --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
document.querySelectorAll('.toggle-heart-btn').forEach(button =>
    button.addEventListener('click', e => {
        e.preventDefault();
        const heartCountElement = document.getElementById('heart-count');
        heartCountElement.textContent = 
            parseInt(heartCountElement.textContent || 0, 10) + 1;
    })
);
});
</script>
@endsection