<div class="container">
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
                        <input type="text" placeholder="Enter your coupon code" name="coupan_code" id="coupon-code"
                        value="{{ session('coupan_code', '') }}" 
                        {{ session()->has('coupan_code') ? 'readonly' : ''}}>

                        <button type="submit" id="apply-coupon-btn" class="site-btn" 
                        style="display: {{ session()->has('coupan_code') ? 'none' : 'inline-block' }};">
                    APPLY COUPON
                </button>
            
                <button type="button" id="remove-coupon-btn" class="site-btn" 
                        style="display: {{ session()->has('coupan_code') ? 'inline-block' : 'none' }};">
                    REMOVE COUPON
                </button>
                    </form>
                    
                    <div id="coupon-message" style="margin-top: 10px; color: green; display: none;"></div>
                    <div id="coupon-error" style="margin-top: 10px; color: red; display: none;"></div>
                    
                    
                </div>
            </div>
        </div>
        <input type="hidden" class="cart-value" value="{{ session('cart_value') }}">

        <div class="col-lg-6">
            <div class="shoping__checkout">
                <h5>Cart Total</h5>
                <ul>
                    <li>
                        Subtotal <span class="sub-total">${{ $total_amount }}</span>
                    </li>
                    <li id="discount" style="display: {{ session()->has('coupan_code') && $total_amount > 0 ? 'block' : 'none' }};">
                        Discount <span id="coupan-code">${{ session('discount', 0) }}</span>
                    </li>
                    <li>
                        Total <span class="total-amount" id="total-amount">
                           ${{ $total_amount - session('discount', 0) }}
                        </span>
                    </li>
                </ul>
                
                
                <a href="{{ auth()->check() ? route('check.out') : route('user.login', ['redirect' => 'checkout']) }}" class="primary-btn">PROCEED TO CHECKOUT</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
   
    function removeCoupon() {
        $('#coupon-message').hide();
        $.ajax({
            url: '{{ route('remove.coupan') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
            $('#coupon-code').val('').prop('readonly', false);
            $('#coupon-message').text(response.message).show();
            $('#apply-coupon-btn').show(); 
            $('#remove-coupon-btn').hide(); 
            $('#discount').hide(); 
            $('#coupan-code').text('$0');
            let subtotal = parseFloat($('.sub-total').text().replace('$', '')) || 0;
            $('.total-amount').text(`$${subtotal.toFixed(2)}`);
            // $('#coupon-message').show();
        },
            error: function (xhr) {
                const errorMessage = xhr.responseJSON.message || 'An error occurred. Please try again.';
                $('#coupon-error').text(errorMessage).show();
                $('#coupon-message').hide();
            }
        });
     }

     $('#remove-coupon-btn').click(function () {
        $('#coupon-message').hide();
        removeCoupon();
    });

    $(".btn-qty").on("click", function () {
        let $input = $(this).siblings('.item-qty');
        let $total = $(this).closest('tr').find('.item-total');
        let unitPrice = parseFloat($input.data('price'));
        let currentValue = parseInt($input.val());
        let itemId = $input.data('id');

        if ($(this).hasClass("inc")) {
            currentValue += 1;
        }
        
        else if ($(this).hasClass("dec") && currentValue > 1) 
        {
            currentValue -= 1;
            $input.val(currentValue);

            let subtotal = 0;
             $(".item-total").each(function () {
              subtotal += parseFloat($(this).text());
              });
        
             $(".sub-total").text("$" + subtotal.toFixed(2));

            let cartValue = parseFloat(document.querySelector(".cart-value").value);
            
              console.log(cartValue,subtotal);

              if (cartValue > subtotal)
              {
                removeCoupon();
              }
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


                let subtotal = parseFloat($('.sub-total').text().replace('$', '')) || 0;
                subtotal -= itemPrice;


                let discount = parseFloat($('#discount-amount').text().replace('$', '')) || 0;
                const total = subtotal;

          
                $('.sub-total').text(`$${subtotal.toFixed(2)}`);
                
     
                $('li:contains("Total") span').text(`$${total.toFixed(2)}`);

                if (subtotal <= 0) {
                    $('#discount').hide();
                    $('li:contains("Total") span').text('$0.00'); 
                } else {
                   
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
$(document).ready(function () {
    $('#apply-coupon-btn').click(function (e) {
        e.preventDefault();
        const couponCode = $('#coupon-code').val();

        if (!couponCode) {
            $('#coupon-error').text('Please enter a coupon code.').show();
            return;
        }

        $.ajax({
            url: '{{ route('apply.coupan') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                coupan_code: couponCode
            },
            success: function (response) {
                $('#coupon-code').prop('readonly', true);
                $('#coupon-message').text(response.message).show();
                $('#coupon-error').hide();

       
                $('#discount').show();
                $('#coupan-code').text('$' + response.discount);
                $('#total-amount').text('$' + response.total_amount);

               
                $('#apply-coupon-btn').hide();
                $('#remove-coupon-btn').show();

            },
            error: function (xhr) {
                const errorMessage = xhr.responseJSON.message || 'An error occurred. Please try again.';
                $('#coupon-error').text(errorMessage).show();
                $('#coupon-message').hide();
            }
        });
    });
  
    
});

</script>


