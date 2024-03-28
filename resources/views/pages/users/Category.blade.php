@extends("layouts.navigation-layout")
@section('desc')
{{$category->description}}
    
@endsection
@section('title')
{{$category->category_name}}
    
@endsection
@section('content')
<div class=" grid grid-cols-3 gap-4">
    @foreach ($products as $product)
    <div class=" col-span-3 mx-auto  lg:col-span-1">
        <div class=" w-full max-w-full rounded-xl border border-1">
            <a href="{{route('usersProduct.show',['devision'=>$category->devision->slug,'category'=>$category->slug,'product'=>$product->slug])}}" style="cursor: pointer; padding:4px;">
                <img src="{{$product->images[0]->path}}" alt="">
            </a>
            <p class=" text-2xl text-center text-black">{{$product->product_name}}</p>
           
        </div>

    </div>

        
    @endforeach
    
@endsection