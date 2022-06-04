<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/animation.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  
  
   
</head>

<body>

    {{-- @include('components.navbar') --}}


    @yield('content')

    <x-footer></x-footer>


    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
