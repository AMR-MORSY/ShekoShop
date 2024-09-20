<x-navigation-layout>
    <x-slot name='description'>
        {{$category->description}}
    </x-slot>
    <x-slot name='title'>
        {{$category->category_name}}
    </x-slot>
<div class=" grid grid-cols-3 gap-4">
    @foreach ($products as $product)
    <div class=" col-span-3 mx-auto  lg:col-span-1">
        <div class=" w-full max-w-full rounded-xl border border-1">
            <a href="{{route('usersProduct.show',['devision'=>$category->devision->slug,'category'=>$category->slug,'product'=>$product->slug])}}" style="cursor: pointer; padding:4px;">
                <img src="{{$product->images[0]->path}}" alt="">
            </a>
            <p class=" text-xl text-center text-black">{{$product->product_name}}</p>
           
        </div>

    </div>

        
    @endforeach
    
</div>
</x-navigation-layout>