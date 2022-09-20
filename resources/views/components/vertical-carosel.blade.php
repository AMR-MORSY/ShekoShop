<div class="row gt-0">
    <div class="col-3">
        <div thumbsSlider="" class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($images as $key => $image)
                    <div class="swiper-slide">
                        <img src="{{ $image }}" alt="">

                    </div>
                @endforeach
            </div>

        </div>

    </div>
    <div class="col-9">

        <div class="swiper mySwiper2">
            <div class="swiper-wrapper">
                @foreach ($images as $key => $image)
                    <div class="swiper-slide">
                        <img src="{{ $image }}" alt="">

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@section('livewire-vertical-carousel-scripts')
    <script>
        $(document).ready(function() {
           
        })

      

       
    </script>
@endsection
