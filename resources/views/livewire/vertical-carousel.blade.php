<div class="row gt-0">
    <div class="col-3">
        <div thumbsSlider="" class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($filteredImages as $key=>$image)
                    <div class="swiper-slide">
                        <img src="{{ $image }}" alt="">
                        <div class="after"> </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>
    <div class="col-9">

        <div class="swiper mySwiper2">
            <div class="swiper-wrapper">
                @foreach ($filteredImages as $key=>$image)
                    <div class="swiper-slide">
                        <img src="{{ $image }}" alt="">
                        <div class="after"> </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@section('livewire-vertical-carousel-scripts')
    <script>
      
        window.addEventListener('contentChanged', event => {
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

        })
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
    </script>
@endsection
