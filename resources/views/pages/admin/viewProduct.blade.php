<x-dashboard-layout>
    <h1 class="text-5xl m-3">View Product</h1>

    @if (session('status'))

    <server-toast message="{{session('status')}}"></server-toast>
        
    @endif

   
    @isset($product)
    {{-- @dd($product) --}}
    <p>{{$product->product_cartDesc}}</p>
    <p>{{$product->category->category_name}}</p>

    <img src="{{$product->images[0]->path}}"/>
  
    <a type="button" class=" focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 "href="{{ route('product.edit', ['product' => $product->id]) }}">Edit</a>
   
   


    @endisset


  
  

</x-dashboard-layout>
