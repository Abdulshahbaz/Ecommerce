 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }
        h1 {
            color: #ff5100;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 20px;
        }
        h1::after {
    content: '';
    display: block;
    width: 60%;
    height: 3px;
    background-color: #ffffff57;
    margin: 10px auto 0;
    border-radius: 2px;
}
        .order-details {
            text-align: center;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        .order-details span {
            font-weight: bold;
            color: #007BFF;
        }
       
        .pay-button {
            text-align: center;
            margin-top: 20px;
        }
        #razorpay-button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        #razorpay-button:hover {
            background-color: #218838;
        }
        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Payment</h1>

        <div class="order-details">
            <p>Order ID: <span>{{$order->id}}</span></p>
            <p>Total Amount: <span>₹{{$totalamount / 100}}</span></p>
        </div>

        <div class="pay-button">
            <button id="razorpay-button">Pay with Razorpay</button>
        </div>
    </div>

    <footer>
        &copy; 2024 Your Company. All rights reserved.
    </footer>
   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

   <script>
  var options = {
    "key": "{{$STRIPE_KEY}}",
    "amount": "{{ $totalamount }}", 
    "currency": "INR",
    "order_id": "{{ $razorpay_order_id }}", 
    "main_order_id":"{{$order->id}}",
    "name": "Your Company Name",
    "description": "Payment for order {{ $order->id }}",
    "image": "https://yourdomain.com/logo.png",
    "handler": function (response) {
        axios.post('/verify-payment', {
        payment_id: response.razorpay_payment_id,
        order_id: response.razorpay_order_id,
        signature: response.razorpay_signature,
        main_order_id:{{$order->id}}

        }).then((response) => {
            alert('Payment successful!');
            window.location.href = '/success'; 
        }).catch(() => {
            alert('Payment verification failed!');
        });
    },
    "prefill": {
        "name": "{{ Auth::user()->name }}",
        "email": "{{ Auth::user()->email }}",
        "contact": "{{ $order->phone }}"
    },
    "theme": {
        "color": "#F37254"
    }
};

var rzp1 = new Razorpay(options);
document.getElementById('razorpay-button').onclick = function (e) {
    rzp1.open();
    e.preventDefault();
};

   </script>
</body>
</html> 