@extends('layouts.master')
@section('content')
    <section id="intro">
        <x-navbar>
        </x-navbar>
        <div class="intro-background ">
            <div class="intro-image">
                <img id="intro-image" src="{{ asset('storage/hher-23-3.jpg') }}" alt="">
            </div>
            <div class="first-caption animate__animated">
                <h6>NEW BASICS</h6>
                <h2>THE ART OF STYLE</h2>
                <div class="caption-buttons ">
                    <button class="white-btn"> <a href="">SHOP NEW IN</a> </button>
                    <button class="transparent-btn"> <a href="">SHOP ALL</a></button>

                </div>

            </div>

        </div>

    </section>
    {{-- <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">


            </div>
        </div>
    </div> --}}
@endsection
