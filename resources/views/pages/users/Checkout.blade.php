<x-intro-layout>
    <x-slot name='description'>
        checkout
    </x-slot>
    <x-slot name='title'>
        checkout
    </x-slot>  

    <checkout-form :user="{{json_encode($user)}}" :payment_methods="{{json_encode($payment_methods)}}" :states="{{json_encode($states)}}" :governments="{{json_encode($governments)}}"/>

</x-intro-layout>


   

    

 

