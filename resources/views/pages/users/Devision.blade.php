@extends("layouts.navigation-layout")
@section('desc')
{{$devision->description}}
    
@endsection
@section('title')
{{$devision->devision_name}}
    
@endsection
@section('content')

<div class=" grid grid-cols-3 gap-4">
    @foreach ($devision->categories as $category)
    <div class=" col-span-3 mx-auto  lg:col-span-1">
        <div class=" w-full max-w-full rounded-xl border border-1">
            <a href="{{route('usersCategory.show',['devision'=>$devision->slug,'category'=>$category->slug])}}" style="cursor: pointer; padding:4px;">
                <img src="{{$category->images[0]->path}}" alt="">
            </a>
            <p class=" text-2xl text-center text-black">{{$category->category_name}}</p>
           
        </div>

    </div>

        
    @endforeach
    
</div>


    
@endsection