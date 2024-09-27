<x-dashboard-layout>
    <h1 class="text-5xl m-3">Products</h1>




    @foreach ($products as $product)
        <div class=" grid grid-cols-2 gap-4">
            <div class=" col-span-2 lg:col-span-1">
                <div class=" w-full">
                    <img src="{{ $product->images[0]->path }}" class=" w-full h-100" alt="{{ $product->images[0]->name }}">
                </div>
            </div>
            <div class=" col-span-2 lg:col-span-1">
                <div class=" w-full">
                    <h3><span class=" text-left text-2xl text-red-400">Name:</span>
                        {{ $product->product_name }}</h3>
                    <h3><span class=" text-2xl text-red-400 ">Category:</span>{{ $product->category->category_name }}
                    </h3>
                    
                    <p><span class=" text-2xl text-red-400 ">Short Desc:</span>{{ $product->product_shortDesc }}</p>
                    <p><span class=" text-2xl text-red-400 ">Stock:</span>{{ $product->product_stock }}</p>
                    <p><span class=" text-2xl text-red-400 ">Live:</span>
                        @if ($product->product_live == 0)
                            No
                        @else
                            Yes
                        @endif
                    </p>

                </div>
                <div class=" flex justify-between items-center">
                    <a type="button"
                        class=" focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 "href="{{ route('product.edit', ['product' => $product->id]) }}">Edit</a>
                </div>
            </div>
        </div>
      
    @endforeach

</x-dashboard-layout>
