<div class="offcanvas offcanvas-end" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="true" id="offcanvas"
    aria-labelledby="offcanvasRightLabel">
    {{-- <x-loading-screen /> --}}
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Offcanvas right</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">


        <div class="container">
            <div class="row">
                <div class="col-12">
                    @php
                        $count = count($deactivated_products);
                    @endphp
                    @if ($count > 0)
                        @for ($i = 0; $i < $count; $i++)
                            <p>{{$deactivated_products[$i]['product_name'] }}</p>
                            @if ($deactivated_colors[$i] != null)
                                <div class="color-caption w-100">
                                    <p><span>Color:</span><span>{{ $deactivated_colors[$i]['color_name'] }}</span></p>
                                    <input type="hidden" class="colors" value="{{ $deactivated_colors[$i]['id'] }}">
                                </div>
                            @endif
                            @if ($deactivated_sizes[$i] != null)
                                <div class="size-caption w-100">

                                    <p><span>Size:</span><span>{{ $deactivated_sizes[$i]['size_name'] }}</span></p>
                                    <input type="hidden" class="sizes" value="{{ $deactivated_sizes[$i]['id'] }}">

                                </div>
                            @endif
                        @endfor



                    @endif
                    @if (count($products) == 0)
                        <p>
                            your Cart is Empty
                        </p>
                    @else
                        @for ($i = 0; $i < count($products); $i++)
                            <div class="row products"
                                style="box-shadow: 1px 1px 5px 2px  gray; margin-bottom:1rem; padding:1rem;">
                                <div class="col-md-4">

                                    <div class="image-container">
                                        <img src="{{ $images[$i] }}" class="w-100 images" alt="">
                                    </div>

                                </div>
                                <div class="col-md-8 ">
                                    <input type="hidden" class="product_ids" value="{{ $products[$i]['id'] }}">
                                    <p class="w-100 ">{{ $products[$i]['product_name'] }}</p>
                                    <p class="w-100">{{ $products[$i]['product_cartDesc'] }}</p>
                                    <p class="w-100">
                                        <span>Price:</span>{{ $products[$i]['product_price'] }}<span>LE</span>
                                    </p>
                                    @if ($colors[$i] != null)
                                        <div class="color-caption w-100">
                                            <p><span>Color:</span><span>{{ $colors[$i]['color_name'] }}</span></p>
                                            <input type="hidden" class="colors" value="{{ $colors[$i]['id'] }}">
                                        </div>
                                    @else
                                        <input type="hidden" class="colors">
                                    @endif
                                    @if ($sizes[$i] != null)
                                        <div class="size-caption w-100">

                                            <p><span>Size:</span><span>{{ $sizes[$i]['size_name'] }}</span></p>
                                            <input type="hidden" class="sizes" value="{{ $sizes[$i]['id'] }}">

                                        </div>
                                    @else
                                        <input type="hidden" class="sizes">
                                    @endif
                                    <div class="d-flex justify-content-evenly align-items-center">
                                        @livewire('cart-counter', ['counter_value' => $quantities[$i], 'counter_index' => $i], key($i))

                                        <x-spinner-button class="cart-delete-product">Delete</x-spinner-button>


                                    </div>


                                    <div>
                                        @livewire('item-price', ['price' => $prices[$i], 'index' => $i, 'quantity' => $quantities[$i]], key('price' . $i))

                                    </div>

                                </div>
                            </div>
                        @endfor




                        @livewire('cart-total-price', ['prices' => $prices, 'quantities' => $quantities], key('cart-total-prices'))

                        <div class="col-12 d-flex align-items-center justify-content-center">

                            <div class="proceed-btn-container">
                                {{-- <x-spinner-button id="checkoutBtn"  class="spinner-circle display_none checkOut">Check Out</x-spinner-button> --}}
                                <button id="checkoutBtn" class="btn btn-primary">Check Out</button>
                            </div>
                        </div>
                    @endif



                </div>



            </div>



        </div>






    </div>
</div>

{{-- @php
    if(count($deactivated_products)>0)
    {
        dd($deactivated_products);

    }
@endphp --}}

@section('cart-scripts')
    <script>
        function deleteBtnFunction() {

            $(".cart-delete-product").each(function() {
                $(this).on('click', function() {
                    var index = $(this).index('.cart-delete-product');
                    var size = $('.sizes').eq(index).val();
                    var color = $('.colors').eq(index).val();
                    var quantity = $('.counters').eq(index).html();
                    var productId = $('.product_ids').eq(index).val();
                    jQuery.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        url: "{{ route('delete_cart_product') }}",
                        method: 'post',
                        data: {
                            quantity: quantity,
                            size: size,
                            color: color,
                            product_id: productId

                        },

                        beforeSend: function() {

                            $(".spinner-circle").eq(index).removeClass("display_none");
                            $(".spinner-circle").eq(index).addClass("display_block")

                        },

                        complete: function() {
                            $(".spinner-circle").eq(index).removeClass("display_block");
                            $(".spinner-circle").eq(index).addClass("display_none")

                        },

                        success: function(result) {

                            function controllcheckoutBtn() {
                                let products = Array.from(document.querySelectorAll(
                                    '.products'));
                                if (products.length <= 0) {
                                    $('#checkoutBtn').addClass('display_none')

                                } else {
                                    $('#checkoutBtn').removeClass('display_none');

                                }

                            }

                            function calculateTotalCartPrice() {
                                var totalItemPrice = $(".total_item_price").eq(index).html();

                                var totalCartPrice = $("#total_cart_price").html();

                                totalCartPrice = Number(totalCartPrice) - Number(
                                    totalItemPrice);
                                $("#total_cart_price").html(`${totalCartPrice.toFixed(2)}`);
                                console.log(totalCartPrice);

                            }


                            if (result.message = "success") {
                                calculateTotalCartPrice()
                                $(".products").eq(index).remove();
                                controllcheckoutBtn();
                                $('#cart-counter').html(`${result.CountDBProducts}`)


                            }

                        },
                    });

                })





            });




            // let deleteBtn = document.querySelectorAll(".cart-delete-product");
            // let sizes = document.querySelectorAll(".sizes");
            // let colors = document.querySelectorAll(".colors");
            // let quantities = document.querySelectorAll(".counters");
            // let productIds = document.querySelectorAll(".product_ids");


            // for (let n = 0; n < deleteBtn.length; n++) {
            //     deleteBtn[n].addEventListener("click", function() {

            //         var size = sizes[n].value;
            //         var color = colors[n].value;
            //         let quantity = quantities[n].innerHTML;
            //         var productId = productIds[n].value;
            //         jQuery.ajax({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            //             },
            //             url: "{{ route('delete_cart_product') }}",
            //             method: 'post',
            //             data: {
            //                 quantity: quantity,
            //                 size: size,
            //                 color: color,
            //                 product_id: productId

            //             },

            //             beforeSend: function() {

            //                 $(".spinner-circle").eq(n).removeClass("display_none");
            //                 $(".spinner-circle").eq(n).addClass("display_block")

            //             },

            //             complete: function() {
            //                 $(".spinner-circle").eq(n).removeClass("display_block");
            //                 $(".spinner-circle").eq(n).addClass("display_none")

            //             },

            //             success: function(result) {

            //                 function controllcheckoutBtn() {
            //                     let products = Array.from(document.querySelectorAll('.products'));
            //                     if (products.length <= 0) {
            //                         $('#checkoutBtn').addClass('display_none')

            //                     } else {
            //                         $('#checkoutBtn').removeClass('display_none');

            //                     }

            //                 }

            //                 function calculateTotalCartPrice() {
            //                    var totalItemPrice = $(".total_item_price").eq(n).html();

            //                     var totalCartPrice = $("#total_cart_price").html();

            //                     totalCartPrice = Number(totalCartPrice) - Number(totalItemPrice);
            //                     $("#total_cart_price").html(`${totalCartPrice.toFixed(2)}`);
            //                     console.log(totalCartPrice);

            //                 }


            //                 if (result.message = "success") {
            //                     calculateTotalCartPrice()
            //                     $(".products").eq(n).remove();
            //                     controllcheckoutBtn();
            //                     $('#cart-counter').html(`${result.CountDBProducts}`)


            //                 }

            //             },
            //         });

            //     })





            // }


        }

        function checkoutBtnFunction() {
            $("#checkoutBtn").on('click', function() {

                let url = window.location.pathname;
                let position = url.search('checkout');

                if (position == -1) {
                    jQuery.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        url: "{{ route('submitOrder') }}",
                        method: 'get',

                        beforeSend: function() {

                            $("#loading-screen").removeClass('display_none');
                            $("#loading-screen").addClass('display_flex');

                        },

                        complete: function() {
                            $(".checkOut").removeClass("display_block");
                            $(".checkOut").addClass("display_none");

                        },

                        success: function(result) {

                            if (result.route == 'login') {
                                window.location.href = "{{ route('login') }}"
                            } else if (result.route == 'checkout') {

                                let url = `checkout/${result.user_id}`;

                                window.location.href = `${url}`

                            }
                        }
                    });

                }


            });
        }


        $(document).ready(function() {

            deleteBtnFunction();
            checkoutBtnFunction();


        });
    </script>
@endsection
