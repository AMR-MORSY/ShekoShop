<x-guest-layout>
    @section('description')
        {{ $product->product_shortDesc }}
    @endsection
    @section('title')
        {{ $product->product_name }}
    @endsection

    <div class=" grid grid-cols-2 gap-4">

        <div class=" col-span-2 mx-auto  lg:col-span-1">
            <div class=" w-full max-w-full rounded-xl border border-1">
                <a style="cursor: pointer; padding:4px;">
                    <img src="{{ $product->images[0]->path }}" alt="">
                </a>


            </div>

        </div>
        {{-- @if (Route::currentRouteName() == 'usersProduct.edit')
            @dd($prodOptions)
        @endif --}}
        @if (Route::currentRouteName() == 'usersProduct.show')
            <div class=" col-span-2 mx-auto  lg:col-span-1">
                <p class=" text-2xl text-center text-black">{{ $product->product_name }}</p>
                <product-cart-form :extras="{{ json_encode($options) }}" :sizes="{{ json_encode($sizes) }}"
                    :product="{{ $product }}" />

            </div>

            {{-- when the route is product.edit, we should present the properties of the selected
            product such as the selected product size,..... --}}
        @else
            <div class=" col-span-2 mx-auto  lg:col-span-1">
                <p class=" text-2xl text-center text-black">{{ $product->product_name }}</p>
                {{-- <product-cart-form  :prodoptions="{{json_encode($prodOptions)}}" :extras="{{ json_encode($options) }}" :sizes="{{ json_encode($sizes) }}"
                    :size="{{ json_encode($size) }}" :quantity="{{ json_encode($quantity) }}"
                    :product="{{ $product }}" :price="{{json_encode($price)}}" :prodindex="{{json_encode($index)}}" :target="{{json_encode($target)}}"/> --}}

                <product-cart-form :extras="{{ json_encode($options) }}"
                    :sizes="{{ json_encode($sizes) }}":product="{{ $product }}"
                    :prodindex="{{ json_encode($index) }}" :target="{{ json_encode($target) }}" />

            </div>
        @endif








</x-guest-layout>
