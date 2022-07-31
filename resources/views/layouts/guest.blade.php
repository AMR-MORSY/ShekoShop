{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

<!-- Styles -->
{{-- <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

<!-- Scripts -->

{{-- </head>
    <body>
        <x-navbar></x-navbar>
        <div id="guest" >
          
            {{ $slot }}
        </div>
        <x-footer/>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/swiper.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body> --}}
{{-- </html> --}}

@extends('layouts.master')
@section('content')
    <div id="guest">

        {{ $slot }}
    </div>
@endsection
