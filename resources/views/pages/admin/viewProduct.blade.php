<x-dashboard-layout>
    <h1 class="text-5xl m-3">View Product</h1>

    @if (session('status'))

    <server-toast message="{{session('status')}}"></server-toast>
        
    @endif

   
    @isset($product)

    <div class=" grid grid-cols-2 gap-4">
        <div class=" col-span-2 md:col-span-1">
            <img src="{{$product->images[0]->path}}" class=" w-100 object-cover"/>
        </div>
        <div class=" col-span-2 md:col-span-1">
            <p class=" text-red-900 font-bold text-base"><span class=" text-lg font-extrabold text-red-400 ">Name:</span>{{$product->product_name}}</p>
            <p class=" text-red-900 font-bold text-base"><span class=" text-lg font-extrabold text-red-400 ">Price:</span>{{$product->product_price}}</p>
            <p class=" text-red-900 font-bold text-base"><span class=" text-lg font-extrabold text-red-400 ">Category:</span>{{$product->category->category_name}}</p>
            <p class=" text-red-900 font-bold text-base"><span class=" text-lg font-extrabold text-red-400 ">Short Desc:</span>{{ $product->product_shortDesc }}</p>
            <p class=" text-red-900 font-bold text-base"><span class=" text-lg font-extrabold text-red-400 ">Stock:</span>{{ $product->product_stock }}</p>
            <p class=" text-red-900 font-bold text-base"><span class=" text-lg font-extrabold text-red-400 ">Live:</span>{{ $product->product_stock }}</p>
        </div>
    </div>
  
   


  
    <a type="button" class=" focus:outline-none mt-10 text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 "href="{{ route('product.edit', ['product' => $product->id]) }}">Edit</a>
   
   


    @endisset


  
  

</x-dashboard-layout>
