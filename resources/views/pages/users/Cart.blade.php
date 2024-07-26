@extends('layouts.intro-layout')
@section('desc')
    cart
@endsection
@section('title')
    cart
@endsection
@section('content')
    <div class=" grid grid-cols-2 gap-4">

        <div class=" md:col-span-1 col-span-2">
          
            <product-cart-form target="cart"/>
              
            

        </div>



    </div>

    

 
@endsection