<x-guest-layout>
    @section('title')
    @yield('title')
    @endsection

    @section('description')
        @yield('desc')
    @endsection



    <section id="devisions-intro" style="background-image: url('{{ asset('assets/nas1.png') }}');"
        class=" h-screen max-h-[50vh] bg-cover bg-center">
        <div class=" w-full  h-full flex flex-col justify-center items-center">
            <p class=" text-white text-6xl text-center">@yield('title') </p>

            <div class="  w-full  flex justify-center mt-7 items-center">
                @foreach ($devisions as $dev)
                    <div class=" mx-2">
                        <p class=" text-center text-2xl text-center text-white">
                            {{ $dev->devision_name }}
                        </p>
                        <p class=" text-center text-2xl text-center text-white"><span
                                class=" text-center  text-center text-white mr-1">{{ $dev->products->count() }}</span><span
                                class=" text-center  text-center text-white">products</span></p>
                    </div>
                @endforeach
            </div>

        </div>

    </section>

  
        
    
    <section >
        @yield('content')
    </section>

    </section>

</x-guest-layout>
