@extends('layouts.master')
@section('content')
    <section id="intro">
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
                <img src="{{ asset('storage/hher-25_ec93b05e-d9c6-410d-bc0d-a33949ae237f (1).jpg') }}" alt="">
            </div>
        </div>

    </section>

    {{-- <section id="vertical-carosel"> --}}
        {{-- <div class="container"> --}}
            {{-- <div class="row"> --}}
                {{-- <div class="col-lg-6"> --}}
                    {{-- <div class="vertical-carosel-container"> --}}
                        {{-- <x-vertical-carosel> --}}
                        {{-- </x-vertical-carosel> --}}

                    {{-- </div> --}}


                {{-- </div> --}}
            {{-- </div> --}}
        {{-- </div> --}}

    {{-- </section> --}}


    <section id='feebacks'>
        <div class="container-fluid" style="overflow:hidden;">
            <div class="feedback-caption">
                <h5>DIRECT FROM THE CUSTOMERS</h5>
                <h2>5 STAR FEEDBACK</h2>
            </div>
            <x-feedback-carosel></x-feedback-carosel>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const swiper = new Swiper(".swiper", {
                speed: 400,
                breakpointsBase: "container",
                navigation: {
                    nextEl: ".swiper-next",
                    prevEl: ".swiper-prev",
                    hiddenClass: "swiper-button-hidden",
                    hideOnClick: true,
                },
                observer: true,
                observeParents: true,
                parallax: true,

                autoHeight: true,
                loop: false,
                // allowSlideNext:true,

                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 3,
                    },

                    // when window width is >= 640px
                    767: {
                        slidesPerView: 4,
                        spaceBetween: 3,
                    },
                },
            });

            $(window).scroll(function() {
                let wind = $(window).scrollTop();

                let nice = $("#shop").offset().top;
                console.log(nice);
                console.log(wind);
                if (wind >= nice) {
                    console.log("hi");
                    $(".nice-girl-image-contianer > img").css(
                        "transform",
                        "Scale(1.1)"
                    );
                    $(".after").css("left", "100%");
                    $(".before").css("right", "100%");
                } else {
                    $(".nice-girl-image-contianer > img").css("transform", "Scale(1)");
                    $(".after").css("left", "90%");
                    $(".before").css("right", "90%");
                }
            });

           
            const feedbackSwiper = new Swiper(".feedback-swiper", {
                speed: 400,
                spaceBetween: 1,
                breakpointsBase: "container",
                effect: "fade",
                navigation: {
                    nextEl: ".swiper-nex",
                    prevEl: ".swiper-pre",
                    // hiddenClass: "swiper-button-hidden",
                    // hideOnClick: true,
                },
                observer: true,
                observeParents: true,
                parallax: true,
                autoHeight: true,
                loop: false,
                // allowSlideNext:true,
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 1,
                    },
                    // when window width is >= 640px
                },
                on: {
                    setTransition: function(transition = "5000") {},
                    slideChangeTransitionStart: function() {
                        let stars = document.querySelectorAll(".bkh");
                        for (let i = 0; i < stars.length; i++) {
                            stars[i].classList.remove("animate__slideInDown");
                        }
                        console.log("swiper start");
                    },
                    slideChangeTransitionEnd: function() {
                        let stars = document.querySelectorAll(".bkh");
                        for (let i = 0; i < stars.length; i++) {
                            stars[i].classList.add("animate__slideInDown");
                        }
                    },
                },
            });
        });
    
       
    </script>
@endsection
