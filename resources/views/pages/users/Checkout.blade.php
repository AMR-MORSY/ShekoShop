<x-intro-layout>
    <x-slot name='description'>
        Checkout
    </x-slot>
    <x-slot name='title'>
        Checkout
    </x-slot>  
    @if (isset($user))
    <checkout-form :user="{{json_encode($user)}}" :payment_methods="{{json_encode($payment_methods)}}" :states="{{json_encode($states)}}" :governments="{{json_encode($governments)}}"/>
       @else
       <checkout-form  :payment_methods="{{json_encode($payment_methods)}}" :states="{{json_encode($states)}}" :governments="{{json_encode($governments)}}"/>

    @endif

   

</x-intro-layout>


   

    

 

