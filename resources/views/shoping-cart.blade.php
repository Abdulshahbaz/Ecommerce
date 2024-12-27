@extends('layout.app')
@section('content')
@include('layout.hero-section')
 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-section set-bg" data-setbg="{{asset('file/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    {{-- <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart_items as $itemsCart)
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="{{asset('admin/img/' .$itemsCart->product->image)}}" alt=""
                                     style="width: 200px; height:100px;">
                                    <h5>{{$itemsCart->product->name}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    ${{ $itemsCart->product->price }}
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity" style="display: flex; align-items: center;">
                                        <a type="button" class="btn-qty dec" style="padding: 5px; cursor: pointer;">-</a>
                                        <input type="text" value="{{ $itemsCart->qty }}" 
                                               class="item-qty" data-id="{{ $itemsCart->id }}" 
                                               data-price="{{ $itemsCart->product->price }}"
                                               style="text-align: center; width: 50px; margin: 0 5px;">
                                        <a type="button" class="btn-qty inc" style="padding: 5px; cursor: pointer;">+</a>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    <span class="item-total">{{ $itemsCart->qty * $itemsCart->product->price }}</span>
                                </td>
                                
                                <td class="shoping__cart__item__close">
                                    <span class="icon_close delete_item" data-id="{{ $itemsCart->id }}"></span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                        Upadate Cart</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form id="coupon-form" action="{{ route('apply.coupan') }}" method="POST">
                            @csrf
                            <input type="text" placeholder="Enter your coupon code" name="coupan_code" id="coupon-code">
                            <button type="submit" id="apply-coupon-btn" class="site-btn">APPLY COUPON</button>
                            <button type="button" id="remove-coupon-btn" class="site-btn" style="display: none;">REMOVE COUPON</button>
                        </form>
                        
                        <div id="coupon-message" style="margin-top: 10px; color: green; display: none;"></div>
                        <div id="coupon-error" style="margin-top: 10px; color: red; display: none;"></div>
                        
                        
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>
                            Subtotal <span class="sub-total">${{ $total_amount }}</span>
                        </li>
                        <li id="discount" style="display: {{ session()->has('coupan_code') && $total_amount > 0 ? 'block' : 'none' }};">
                            Discount <span id="discount-amount">${{ session('value', 0) }}</span>
                        </li>
                        <li>
                            Total <span class="total_amount" id="total-amount">
                        ${{ is_numeric($total_amount) && is_numeric(session('value')) ? $total_amount - session('value') : $total_amount }}
                    </span>
                        </li>
                    </ul>
                    
                    <a href="{{route('check.out')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div> --}}
    <div id="file-container"></div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- <script>
  $(document).ready(function () {
    $(".btn-qty").on("click", function () {
        let $input = $(this).siblings('.item-qty');
        let $total = $(this).closest('tr').find('.item-total');
        let unitPrice = parseFloat($input.data('price'));
        let currentValue = parseInt($input.val());
        let itemId = $input.data('id');

        if ($(this).hasClass("inc")) {
            currentValue += 1;
        } else if ($(this).hasClass("dec") && currentValue > 1) {
            currentValue -= 1;
        }

        $input.val(currentValue);
        let newTotal = (unitPrice * currentValue).toFixed(2);
        $total.text(newTotal);
       
        let subtotal = 0;
        let total = 0;
        $(".item-total").each(function () {
            subtotal += parseFloat($(this).text());
            total += parseFloat($(this).text());
        });
        
        $(".sub-total").text("$" + subtotal.toFixed(2));
        $(".total_amount").text("$" + total.toFixed(2));
        
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

<script>
    $('.delete_item').on('click', function() {
    const row = $(this).closest('tr');
    const itemId = $(this).data('id');
    const itemPrice = parseFloat(row.find('.item-total').text().replace('$', ''));

    if (confirm('Are you sure you want to delete this item?')) {
        $.ajax({
            url: `/cart/delete/${itemId}`,
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function() {
                row.remove();

                // Recalculate subtotal
                let subtotal = parseFloat($('.sub-total').text().replace('$', '')) || 0;
                subtotal -= itemPrice;

                // Recalculate discount and total
                let discount = parseFloat($('#discount-amount').text().replace('$', '')) || 0;
                const total = subtotal; // Set total as equal to subtotal

                // Update subtotal
                $('.sub-total').text(`$${subtotal.toFixed(2)}`);
                
                // Update total (same as subtotal now)
                $('li:contains("Total") span').text(`$${total.toFixed(2)}`);

                // Hide the discount if subtotal is less than or equal to 0
                if (subtotal <= 0) {
                    $('#discount').hide();
                    $('li:contains("Total") span').text('$0.00'); // Set total to $0.00 if subtotal is 0 or less
                } else {
                    // If subtotal is positive, update total and hide discount
                    $('#discount').hide();
                }
            },

            error: function() {
                alert('Failed to delete item. Please try again.');
            }
        });
    }
});
</script> 

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let totalAmount = parseFloat("{{ $total_amount }}");

        // Check session storage for coupon state
        if (sessionStorage.getItem('couponApplied') === 'true') {
            document.getElementById('coupon-code').value = sessionStorage.getItem('couponCode');
            document.getElementById('coupon-code').disabled = true;
            document.getElementById('apply-coupon-btn').style.display = 'none';
            document.getElementById('remove-coupon-btn').style.display = 'inline-block';
            document.getElementById('discount').style.display = 'block';
            document.getElementById('discount-amount').innerText = '$' + sessionStorage.getItem('discountAmount');
            document.getElementById('total-amount').innerText = `$${totalAmount - parseFloat(sessionStorage.getItem('discountAmount'))}`;
        } else {
            resetCouponState();
        }

        document.getElementById('coupon-form').addEventListener('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('coupon-message').innerText = data.message;
                        document.getElementById('coupon-message').style.display = 'block';
                        document.getElementById('coupon-error').style.display = 'none';

                        document.getElementById('apply-coupon-btn').style.display = 'none';
                        document.getElementById('remove-coupon-btn').style.display = 'inline-block';

                        document.getElementById('discount').style.display = 'block';
                        document.getElementById('discount-amount').innerText = '$' + data.discount;

                        let discountedAmount = totalAmount - data.discount;
                        document.getElementById('total-amount').innerText = `$${discountedAmount}`;

                        document.getElementById('coupon-code').disabled = true;

                        // Store coupon state in session storage
                        sessionStorage.setItem('couponApplied', 'true');
                        sessionStorage.setItem('couponCode', document.getElementById('coupon-code').value);
                        sessionStorage.setItem('discountAmount', data.discount);
                    } else {
                        document.getElementById('coupon-error').innerText = data.message;
                        document.getElementById('coupon-error').style.display = 'block';
                        document.getElementById('coupon-message').style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('coupon-error').innerText = 'An error occurred. Please try again.';
                    document.getElementById('coupon-error').style.display = 'block';
                });
        });

        document.getElementById('remove-coupon-btn').addEventListener('click', function () {
            resetCouponState();
            sessionStorage.removeItem('couponApplied');
            sessionStorage.removeItem('couponCode');
            sessionStorage.removeItem('discountAmount');
        });

        function resetCouponState() {
            document.getElementById('coupon-code').value = '';
            document.getElementById('coupon-code').disabled = false;
            document.getElementById('apply-coupon-btn').style.display = 'inline-block';
            document.getElementById('remove-coupon-btn').style.display = 'none';
            document.getElementById('discount').style.display = 'none';
            document.getElementById('coupon-message').style.display = 'none';
            document.getElementById('coupon-error').style.display = 'none';
            document.getElementById('total-amount').innerText = `$${totalAmount}`;
        }
    });
</script>  --}}

<script>
    function showdata() {
        $.ajax({
            url: `/get-file`, 
            type: 'GET', 
            dataType: 'json', 
            success: function (data) {
                if (data.success) {
                    $('#file-container').html(data.fileContent);
                } else {
                    alert(data.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error); 
            }
        });
    }
        showdata();
</script>

@endsection