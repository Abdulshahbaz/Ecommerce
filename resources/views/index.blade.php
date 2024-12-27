@extends('layout.app')
@section('content')
 <style>
    .add-to-cart {
    background-color: #7fad39;
}

.remove-cart {
    background-color: #ff0000;
}
 </style>
 <section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    @foreach ($category_name as $items)
                    <ul>
                        <li>
                            <a href="#">
                             {{$items->category_name}}
                            </a>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
                
                @foreach ($banner_image as $items)              
                <div class="hero__item set-bg">
                    <img src="{{ asset('admin/img/' . $items->image) }}" alt="Image">
                    <div class="hero__text">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($category_name as $value)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg">
                            <img src="{{ asset('admin/img/' . $value->image) }}" alt="Image">
                            <h5><a  href="#" style="background-color: #7fad39; color:#ffff;">{{ $value->category_name }}</a></h5>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($category_name as $item)
                            <li data-filter=".{{$item->slug_name}}">{{$item->category_name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($product_name as $items)
                <div class="col-lg-3 col-md-4 col-sm-6 mix {{$items->category->slug_name}}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg">
                            <img src="{{ asset('admin/img/' . $items->image) }}" alt="Image">
                            <ul class="featured__item__pic__hover">

                                <li> <a href="javascript:void(0)" class="toggle-heart-btn" data-id="{{$items->id}}">
                                    <i class="fa fa-heart"></i>
                                </a></li>

                                {{-- <li><a href="#"><i id="shopping-cart-icon"   class="fa fa-shopping-cart"></i></a></li> --}}
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">{{$items->name}}</a></h6>
                            <h5>${{$items->price}}</h5>
                        </div>
                        <a href="javascript:void(0)" class="site-btn w-100 text-center toggle-cart-btn"
                            data-id="{{$items->id}}" id="toggle-cart-btn-{{$items->id}}">Loading...</a>
                    </div>
                </div>
                @endforeach
            </div>          
        </div>
    </section>
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{asset('file/img/banner/banner-1.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{asset('file/img/banner/banner-2.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($latest_products as $key => $items)  
                            @if($key%3==0 || $key==0)
                                <div class="latest-prdouct__slider__item">
                            @endif
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset('admin/img/' . $items->image) }}" alt="Image" 
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
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($top_rated_products as $key=>$items)
                            @if($key%3==0 || $key==0)
                            <div class="latest-prdouct__slider__item">
                                @endif
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{asset('admin/img/'.$items->image)}}" alt="" style="width: 151px;">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$items->name}}</h6>
                                        <span>${{$items->price}}</span>
                                    </div>
                                </a>
                               @if(($key+1)%3==0 || count($top_rated_products)-1==$key)
                                 </div>
                               @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($review_products as $key=>$reviewItems)      
                           @if($key%3 == 0 || $key==0)
                            <div class="latest-prdouct__slider__item">
                            @endif
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{asset('admin/img/'.$reviewItems->image)}}" alt=""
                                        style="width:151px;">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$reviewItems->name}}</h6>
                                        <span>${{$reviewItems->price}}</span>
                                    </div>
                                </a>
                                @if (($key+1)%3==0 || count($review_products)-1 == $key)        
                            </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($blogs as $blogsItems)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{asset('admin/img/' .$blogsItems->image)}}" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i>{{$blogsItems->date}}</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">{{$blogsItems->title}}</a></h5>
                            <p>{!!$blogsItems->desc!!}</p>
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