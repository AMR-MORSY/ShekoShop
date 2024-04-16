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

    <section id="content-sidebar" class=" container">
        
    <section id="sideBar" class=" relative">
        <button data-drawer-target="devisions-sidebar" data-drawer-toggle="devisions-sidebar"
            aria-controls="devisions-sidebar" type="button"
            class="inline-flex items-center mt-2 p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                </path>
            </svg>
        </button>

        <aside id="devisions-sidebar"
            class=" absolute top-0 left-0 w-64 z-50 h-screen pt-20 transition-transform -translate-x-full bg-white  sm:translate-x-0"
            aria-label="Sidebar">
            <div class=" px-3 pb-4 overflow-y-auto bg-white">
                <ul class="space-y-2 font-medium">

                    @foreach ($devisions as $dev)
                        <li>
                            <button type="button"
                                class="flex items-center w-full text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                                aria-controls="dropdown-example" data-collapse-toggle="{{ $dev->devision_name }}">

                                <a href="{{ route('usersDevision.show', ['devision' => $dev->slug]) }}"
                                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 18 18">
                                        <path
                                            d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                                    </svg>
                                    <span class="flex-1 ms-3 whitespace-nowrap">{{ $dev->devision_name }}</span>

                                </a>

                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="{{ $dev->devision_name }}" class="hidden py-2 space-y-2">
                                @foreach ($dev->categories as $category)
                                    <li>
                                        <a href="{{ route('usersCategory.show', ["devision"=>$dev->slug,'category' => $category->slug]) }}"
                                            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">

                                            <span
                                                class="flex-1 ms-3 whitespace-nowrap">{{ $category->category_name }}</span>

                                        </a>

                                    </li>
                                @endforeach



                            </ul>
                        </li>
                    @endforeach


                </ul>
            </div>
        </aside>
    </section>
    <section class="p-4  sm:ml-64 ">
        @yield('content')
    </section>

    </section>

</x-guest-layout>
