<div class="container">
    <div class="row">
        <div class="col-12">
            @if (count($products) == 0)
                <p>
                    your Cart is Empty
                </p>
            @else
                @for ($i = 0; $i < count($products); $i++)
                    <div class="row" style="box-shadow: 1px 1px 5px 2px  gray; margin-bottom:1rem; padding:1rem;">
                        <div class="col-md-4">

                            <div class="image-container">
                                <img src="{{ $images[$i] }}" class="w-100" alt="">
                            </div>

                        </div>
                        <div class="col-md-8 ">
                            <p class="w-100">{{ $products[$i]['product_name'] }}</p>
                            <p class="w-100">{{ $products[$i]['product_cartDesc'] }}</p>
                            <p class="w-100">
                                <span>Price:</span>{{ $products[$i]['product_price'] }}<span>LE</span>
                            </p>
                            @if ($colors[$i] != null)
                                <div class="color-caption w-100">
                                    <p><span>Color:</span>{{ $colors[$i]['color_name'] }}</p>
                                </div>
                            @endif
                            @if ($sizes[$i] != null)
                                <div class="size-caption w-100">

                                    <p><span>Size:</span>{{ $sizes[$i]['size_name'] }}</p>

                                </div>
                            @endif
                            <div class="d-flex justify-content-start align-items-center">
                                @livewire('cart-counter', ['counter_value' => $quantities[$i], 'counter_index' => $i], key($i))

                                <button class="btn btn-danger ml-1"
                                    wire:click="deleteItem({{ $i }})">DELETE</button>


                            </div>


                            <div>
                                @livewire('item-price', ['price' => $prices[$i], 'index' => $i, 'quantity' => $quantities[$i]], key('price' . $i))

                            </div>

                        </div>
                    </div>
                @endfor



                @livewire('cart-total-price', ['prices' => $prices, 'quantities' => $quantities], key('cart-total-prices'))
            @endif



        </div>
        <div class="col-12 d-flex align-items-center justify-content-center">
            
            <div class="proceed-btn-container">
                <button class="btn btn-primary" wire:click.prevent='submitOrder' style="display: {{$display}}">Check Out</button>
            </div>
        </div>


    </div>



</div>