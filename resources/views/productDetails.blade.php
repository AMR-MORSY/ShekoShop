@extends('layouts.master')
@section('content')


    <section id="vertical-carosel">
        <div class="container">

            <div class="row">
                <div class="col-12 col-md-6 mb-5">
                    @if (isset($images))
                        <div class="vertical-carosel-container">

                            {{-- <livewire:vertical-carousel :images="$images" /> --}}
                            <x-vertical-carosel :images="$images"></x-vertical-carosel>
                        </div>
                    @else
                        <div class="facefront-container ">
                            <img src="{{ $facefrontImage }}" class="w-100 " alt="">
                        </div>
                    @endif

                </div>
                <div class="col-md-6">
                    <div class="prodcut-name">
                        <p>{{ $product->product_name }}</p>

                    </div>
                    <div class="prodcut-long-desc">
                        <p>{{ $product->product_longDesc }}</p>

                    </div>

                    <input type="hidden" id="product_id" value="{{ $product->id }}">

                    <div>
                        @if (isset($colors))
                            <p>Available Colors:</p>
                            {{-- <livewire:colors :colors="$colors" /> --}}
                            <div class="row colors-collection">


                                @foreach ($colors as $color)
                                    <div class="col-1 ">
                                        <div class="colors"
                                            @if ($color->id == $colors[0]->id) style="border:2px dashed black;background-color: {{ $color->color_code }};cursor:pointer;"
                                        @else

                                        style="background-color: {{ $color->color_code }};cursor:pointer;" @endif
                                            onclick="submitColorID({{ $color->id }},{{ $product->id }})"></div>



                                    </div>
                                @endforeach

                                <input class="color" type="hidden" value="{{ $colors[0]->id }}">






                            </div>
                        @else
                            {{-- <input class="color" type="hidden"> --}}
                        @endif


                    </div>
                    <div>
                        @if (isset($sizes))
                            <p>Available Sizes:</p>
                            {{-- <livewire:sizes :sizes="$sizes" /> --}}
                            <div class="row w-25 mb-2">

                                <select class="form-control size">

                                    @foreach ($sizes as $size)
                                        <option value="{{ $size['id'] }}">

                                            {{ $size['size_name'] }}

                                        </option>
                                    @endforeach

                                </select>




                            </div>
                        @else
                            {{-- <input class="size" type="hidden"> --}}
                        @endif


                    </div>

                    @if ($product->product_live == 0)
                        <p style="color: red">out of stock</p>
                    @else
                        <p style="color: green">in stock</p>
                    @endif

                    <div class="features">
                        <div class="row">

                            <div class="col-md-6">
                                @role('admin')
                                    <a href="{{ route('product_update', ['product' => $product->id]) }}"
                                        class="btn btn-primary">Update</a>
                                @endrole


                            </div>
                        </div>
                    </div>

                    @if ($product->product_stock > 0)
                        <div class="counter-container">
                            <livewire:counter wire:key='productdetailscounter' counter_host="product_details" />
                        </div>
                        @if (isset($colors))
                            <div class="add-cart-button">
                                <button id="Add_Cart_btn" class="btn btn-danger">Add To Cart</button>


                            </div>
                        @else
                            <div class="add-cart-button">

                                <button id="Add_Cart_btn" class="btn btn-danger">Add To Cart</button>


                            </div>
                        @endif
                    @endif








                </div>
            </div>
        </div>
    </section>
@endsection

@section('product_details_scripts')
    <script>
        $(document).ready(function() {
            var reloading = sessionStorage.getItem("reloading");
            if (reloading == "true") {
                var sizes = sessionStorage.getItem('sizes');
                var images = sessionStorage.getItem("images");
                var color_id = sessionStorage.getItem("color_id");
                if (images && sizes) {
                    sizes = JSON.parse(sizes)
                    // sessionStorage.removeItem("sizes");

                    images = JSON.parse(images)
                    // console.log('hello')
                    // console.log(sizes);
                    // sessionStorage.removeItem("images");
                    // sessionStorage.removeItem("color_id");
                    updateCarouselSlides(sizes, images);
                    $('.color').val(color_id);

                }

                $("#spinner").removeClass('display_flex');
                $("#spinner").addClass('display_none');

                sessionStorage.removeItem("reloading");
                var myOffcanvas = document.getElementById("offcanvas");
                var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
                bsOffcanvas.show();


                // initializeCarousel();







            } else {
                shadowingImages();
                sessionStorage.removeItem("sizes");
                sessionStorage.removeItem("images");
                sessionStorage.removeItem("color_id");
                $("#spinner").removeClass('display_flex');
                $("#spinner").addClass('display_none');

            }






        })

        // function initializeCarousel() {



        //     shadowingImages();
        // }

        var swip = new Swiper(".mySwiper", {
            spaceBetween: 5,
            slidesPerView: 4,
            direction: "vertical",
            freeMode: true,
            observer: true,
            observeParents: true,
            parallax: true,
            mousewheel: true,
            watchSlidesProgress: true,
            grabCursor: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 0,
            loop: true,
            observer: true,
            observeParents: true,
            parallax: true,
            thumbs: {
                swiper: swip,
            },
        });



        $('#Add_Cart_btn').on('click', function() {


            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: "{{ route('add_cart_product') }}",
                method: 'post',
                data: {
                    size: $('.size').val(),
                    color: $('.color').val(),
                    product_id: $('#product_id').val(),
                    quantity: $('.counter').html(),


                },

                beforeSend: function() {

                    $("#spinner").removeClass('display_none');
                    $("#spinner").addClass('display_flex');


                },


                success: function(result) {
                    if (result.success) {
                        sessionStorage.setItem("reloading", "true");

                        location.reload();



                        // function myFunction() {
                        //     sessionStorage.setItem("reloading", "true");

                        // };

                        // if (window.attachEvent) {
                        //     window.attachEvent('load', myFunction());
                        // } else if (window.addEventListener) {
                        //     window.addEventListener('load', myFunction(), false);
                        // } else {
                        //     document.addEventListener('load', myFunction(), false);
                        // }


                    }
                }
            });



        });

        function updateCarouselSlides(sizes, images) {

            var sizeData = '';

            sizes.forEach(element => {

                sizeData = sizeData + "<option value=" + element.id + ">" + element
                    .size_name + "</option>"

            });

            $(".size").html(sizeData);
            var imageData = '';

            images.forEach(element => {
                imageData = imageData + "<div class='swiper-slide'><img src=" +
                    element + "></div>";
            })

            $('.swiper-wrapper').each(function() {


                $(this).html('');
            })
            swip.appendSlide(imageData);
            swiper2.appendSlide(imageData);
            shadowingImages();


        }


        function shadowingImages() {
            let list = Array.from(document.querySelectorAll(".myswiper img"));
            list.forEach((el) => {
                el.addEventListener("click", (e) => {
                    //code that affects the element you click on
                    el.style.boxShadow = "0 7px #261d09";
                    list.filter((x) => x != el).forEach((otherEl) => {
                        //code that affects the other elements you didn't click on
                        otherEl.style.boxShadow = "none";
                    });
                });
            });


        }

        // function highlightSelectedDiv()
        // {
        //     $('.colors').each(function(){
        //         $(this).on('click',function(){
        //             $(this).css("border","2px dashed black");
        //             $(this).siblings().css("border","0");
        //         })
        //     })

        // }

        function submitColorID(color_id, product_id) {

        //   /  highlightSelectedDiv();
           
          
            $('.color').val(color_id);
          

            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: "{{ route('get_color_details') }}",
                method: 'post',
                data: {

                    color_id: color_id,
                    product_id: product_id,

                },
                beforeSend: function() {

                    $("#spinner").removeClass('display_none');
                    $("#spinner").addClass('display_flex');


                },

                success: function(data) {

                    if (data.success) {
                        var sizes = data.sizes;
                        var images = data.images;

                        console.log(sizes);

                        updateCarouselSlides(sizes, images);
                        sessionStorage.setItem('sizes', JSON.stringify(sizes));
                        sessionStorage.setItem('images', JSON.stringify(images));
                        sessionStorage.setItem('color_id', color_id);
                        $("#spinner").removeClass('display_flex');
                        $("#spinner").addClass(
                            'display_none');
                    }

                },
            });


        }
    </script>
@endsection
