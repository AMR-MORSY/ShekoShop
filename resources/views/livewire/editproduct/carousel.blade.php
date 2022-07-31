<!-- Slider main container -->

  {{-- @for ($i = 0; $i < count($images_urls); $i++)
                                                    <div class="col-3">
                                                        <div class="image-container">
                                                            <img class="w-100" src={{ $images_urls[$i] }}
                                                                alt="">
                                                        </div>
                                                        <div class="d-flex justify-content-center align-items-center mt-2">
                                                            <a href="{{ route('delete_product_image', [
                                                                'product_id' => $product->id,
                                                                'color_id' => $product_colors[$v]->id,
                                                                'image_id' => $images_ids[$i],
                                                            ]) }}"
                                                                class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>

                                                @endfor --}}

<div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">

        @for ($i = 0; $i < count($images_urls); $i++)
        <div class="swiper-slide">
            <div class="swiper-slide-image-contianer">
                <img src="{{ $images_urls[$i] }}"
                    alt="">
            </div>
            <div class="swiper-slide-caption">
                {{-- <p class="decription">Ay halfata fargha</p>
                <p class="price">12.15$</p> --}}
                <div class="d-flex justify-content-center align-items-center mt-2">
                    <a href="{{ route('delete_product_image', [
                        // 'product_id' => $product_id,
                        // 'color_id' => $color_id,
                        'image' => $images_ids[$i],
                    ]) }}"
                        class="btn btn-danger">Delete</a>
                </div>
            </div>

        </div>
        @endfor
      

    </div>
    <!-- If we need pagination -->
    {{-- <div class="swiper-pagination"></div> --}}

    <!-- If we need navigation buttons -->
    <div class="swiper-prev"></div>
    <div class="swiper-next"></div>

    <!-- If we need scrollbar -->
    {{-- <div class="swiper-scrollbar"></div> --}}
</div>

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
        });
    </script>
@endsection
