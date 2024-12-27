{{-- @extends('layouts.app')
@section('content')
<section class="checkout-success spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Thank You for Your Purchase!</h2>
                <p>Your payment has been successfully processed.</p>
                <p>Order details have been sent to your email.</p>
                <a href="{{ route('home.page') }}" class="site-btn">Return to Home</a>
            </div>
        </div>
    </div>
</section>
@endsection --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }
        .container {
            max-width:600px;
            height: 400px;
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
   
    <body> 
        <div class="container">
        <div class="vh-50 d-flex justify-content-center align-items-center">
            <div>
                <div class="mb-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
                        fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                </div>
                <div class="text-center">
                    <h2>Thank You for Your Purchase!</h2>
                    <p>Your payment has been successfully processed.</p>
                    {{-- <p>Order details have been sent to your email.</p> --}}
                    <a href="{{route('user.order')}}" type="submit" class="btn btn-primary">View Order</a>
                    <a href="{{route('home.page')}}" type="submit" class="btn btn-success">Continue Order</a>
                </div>
            </div>
        </div>
    </body>
</html>

