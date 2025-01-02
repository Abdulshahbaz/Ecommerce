<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
      


    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('file/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('file/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('file/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('file/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('file/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('file/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('file/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('file/css/style.css')}}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder" style="display:none">
        <div class="loader"></div>
    </div>

    @include('layout.header')
    @yield('content')
    @include('layout.footer')

    <!-- Js Plugins -->
    <script src="{{('file/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{('file/js/bootstrap.min.js')}}"></script>
    <script src="{{('file/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{('file/js/jquery-ui.min.js')}}"></script>
    <script src="{{('file/js/jquery.slicknav.js')}}"></script>
    <script src="{{('file/js/mixitup.min.js')}}"></script>
    <script src="{{('file/js/owl.carousel.min.js')}}"></script>
    <script src="{{('file/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/mixitup@3/dist/mixitup.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>