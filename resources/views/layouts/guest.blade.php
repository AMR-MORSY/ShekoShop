<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $description ?? 'Hello' }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }} </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300..700&family=Signika:wght@300..700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->


    @vite(['resources/css/app.css', 'resources/js/app.js'])



</head>

<body class="font-sans text-gray-900 antialiased">

    <div id="app">
        <x-navbar :categories="$categories" :devisions="$devisions"></x-navbar>
        <div>
            {{ $slot }}
        </div>

        <div>
            <notification />
        </div>
        <div>

            <side-cart />
        </div>



    </div>




</body>

</html>
