<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>ShekoShop</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/animation.css') }}"> --}}


    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @livewireStyles

    @yield('style')


</head>

<body>

    <x-navbar></x-navbar>
    <x-spinner />
    <x-side-cart /> 
    @yield('content')







    @livewire('user.store-user-address-form')


    <x-footer></x-footer>









    @livewireScripts
   
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#spinner").removeClass('display_flex');
            $("#spinner").addClass('display_none');

        })
    </script>
    @yield('livewire-vertical-carousel-scripts')
    @yield('home-scripts')
    @yield('checkout-scripts')
    @yield('dashboard-scripts')
    @yield('cart-scripts')
    @yield('product_details_scripts')
    @yield('edit-product-scripts')

</body>

</html>
