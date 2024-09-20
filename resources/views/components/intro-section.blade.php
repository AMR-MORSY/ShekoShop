@props(
    ['title']
)

<section id="devisions-intro" style="background-image: url('{{ asset('assets/nas1.png') }}');"
class=" h-screen max-h-[50vh] bg-cover bg-center">
<div class=" max-w-lg md:max-w-full mx-auto px-2  h-full flex flex-col justify-center items-center">
    <p class=" text-white text-2xl md:text-4xl font-bold text-center">{{$title}} </p>

    <div class="  w-full  flex justify-center mt-7 items-center">
        @foreach ($devisions as $dev)
            <div class=" mx-2">
                <p class=" text-center text-sm md:text-lg font-bold  text-white">
                    {{ $dev->devision_name }}
                </p>
                <p class=" text-center text-xs md:text-sm font-light  text-white"><span
                        class=" text-center  text-white mr-1">{{ $dev->products->count() }}</span><span
                        class=" text-center text-white">products</span></p>
            </div>
        @endforeach
    </div>

</div>

</section>