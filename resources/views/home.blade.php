@extends('layouts.master')
@section('content')
    <section id="intro">
        <x-navbar>
        </x-navbar>
        <div class="intro-background ">
            <div class="intro-image">
                <picture>
                    <source srcset="{{ asset('storage/hher-23-5.jpg') }}" media="(max-width:767px)">
                    <img id="intro-image" src="{{ asset('storage/hher-23-3.jpg') }}" alt="">
                </picture>

            </div>
            <div class="first-caption animate__animated">
                <h6>NEW BASICS</h6>
                <h2>THE ART OF STYLE</h2>
                <div class="caption-buttons ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 all-btn col-md-6">
                                <div id="white-btn">
                                    <button class="white-btn"> <a href="">SHOP NEW IN</a> </button>
                                </div>


                            </div>
                            <div class="col-12 all-btn col-md-6">
                                <div id="transparent-btn">
                                    <button class="transparent-btn"> <a href="">SHOP ALL</a></button>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>

            </div>

        </div>

    </section>

    <section id='shop'>
        <div class="container-fluid">
            <div class="title">
                <h3 class="item">DRESESS</h3>
                <h3 class="item">TOPS</h3>
                <h3 class="item">BOTTOMS</h3>
            </div>
            <div class="carosel-container">
                <x-carosel></x-carosel>

            </div>


        </div>


    </section>

    <section id="nice-girl">
        <div class="container-fluid">
            <div class="after"></div>
            <div class="before"></div>
            <div class="nice-girl-image-contianer">
              
              
              
                <div class="instgram-box">

                    <div class="sale-caption">
                        <h2>UP TO 25% OFF</h2>
                        <button class="sale-btn"><a>SHOP THE SALE</a></button>
                    </div>
                    <div class="sale-insta">
                        <div class="insta-icon">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                        <h3>SEE IT STYLED ON INSTA</h3>
                    </div>
                   
                   

                </div>
                <img src="{{asset('storage/hher-25_ec93b05e-d9c6-410d-bc0d-a33949ae237f (1).jpg')}}" alt="">
            </div>
        </div>

    </section>
@endsection
