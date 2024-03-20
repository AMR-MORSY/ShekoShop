<x-dashboard-layout>
    @if (session('status'))
        <server-toast message="{{ session('status') }}"></server-toast>
    @endif
    @if (Route::currentRouteName() == 'devision.show')
        <h1 class="text-5xl m-3">View Devision</h1>
    @else
        <h1 class="text-5xl m-3">View Category</h1>
    @endif
    <div class=" flex flex-col items-center ">
        <div class=" w-full mx-auto rounded-lg  bg-white">
            <div class=" flex justify-around rounded-t-lg bg-blue-200">
                <div class=" w-10 flex-none text-center p-3">Id</div>
                <div class=" w-32 flex-none text-center p-3">Name</div>
                <div class=" w-48 flex-1 text-center p-3">Description</div>
                @if (Route::currentRouteName() == 'devision.show')
                    <div class=" w-48 flex-1 text-center p-3">Categories</div>
                @else
                    <div class=" w-48 flex-1 text-center p-3">Devision</div>
                @endif

                <div class=" w-48 flex-1 text-center p-3">image</div>


            </div>
            @if (Route::currentRouteName() == 'devision.show')
                <div class=" flex justify-around">
                    <div class=" w-10 flex-none text-center p-3">{{ $devision->id }}</div>
                    <div class="  w-32 flex-none text-center p-3">{{ $devision->devision_name }}</div>
                    <div class=" w-48 flex-1 text-center p-3">
                        {{ $devision->description }}
                    </div>
                    <div class=" w-48 flex-1 text-center p-3">
                        @foreach ($devision->categories as $category)
                            {{ $category->category_name }}
                        @endforeach

                    </div>
                    <div class=" w-48 flex-1 text-start p-3">

                        <div class=" w-full flex justify-center items-center">
                            <img src="{{ $devision->images[0]->path }}" class=" h-40 w-40" alt="">
                        </div>






                    </div>
                </div>

                <div class=" border-t-2 border-blue-300 p-2">
                    <a type="button"
                        class=" focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 "href="{{ route('devision.edit', ['devision' => $devision->id]) }}">Edit
                    </a>
                </div>
            @else
                <div class=" flex justify-around">
                    <div class=" w-10 flex-none text-center p-3">{{ $category->id }}</div>
                    <div class="  w-32 flex-none text-center p-3">{{ $category->category_name }}</div>
                    <div class=" w-48 flex-1 text-center p-3">
                        {{ $category->description }}
                    </div>
                    <div class=" w-48 flex-1 text-center p-3">

                        {{ $category->devision->devision_name }}



                    </div>
                    <div class=" w-48 flex-1 text-start p-5 ">

                        <div class=" w-full flex-column justify-center  items-center " >
                            <div class=" w-41 h-41 flex justify-center items-center hover:border hover:border-red-400 ">
                                <img src="{{ $category->images[0]->path }}" class=" h-40 w-40" alt="">

                            </div>
                            <p class=" text-center text-black">Click to Update</p>

                        </div>






                    </div>
                </div>


                <div class=" border-t-2 border-blue-300 p-2">
                    <a type="button"
                        class=" focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 "href="{{ route('category.edit', ['category' => $category->id]) }}">Edit
                    </a>
                </div>
            @endif


        </div>



    </div>


</x-dashboard-layout>
