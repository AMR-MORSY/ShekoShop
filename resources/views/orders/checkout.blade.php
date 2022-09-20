@extends('layouts.master')
@section('content')
    <div class="container">


        <div class="row">
            <div class="col-12 col-md-9">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            @if (isset($user))
                                <div class=" col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name:</label>
                                        <input type="text" value="{{ $user->first_name }}" class="form-control"
                                            id="first_name">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name:</label>
                                        <input type="text" value="{{ $user->last_name }}" class="form-control"
                                            id="last_name">
                                        <input type="hidden" value="{{ $user->id }}" id="user_id">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="text" value="{{ $user->email }}" class="form-control"
                                            id="email">
                                    </div>

                                </div>
                            @endif
                            @php
                                use App\Models\Government;
                                use App\Models\State;
                                if (isset($user_address)) {
                                    $city = Government::find($user_address->government_id);
                                    $city_name = $city->govern_name;
                                    $city_id = $city->id;
                                    $state = State::find($user_address->state_id);
                                    $state_name = $state->state_name;
                                    $state_id = $state->id;
                                }
                                
                            @endphp

                            @if (isset($user_address))
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Address_line1">Address:</label>
                                        <input type="text" class="form-control" id="Address_line1"
                                            value="{{ $user_address->address }}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="City">City:</label>

                                        <select id="City" class="form-control">


                                            <option value="{{ $city_id }}">{{ $city_name }}
                                            </option>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="State">State:</label>
                                        <select id="state" name="state_id" class="form-control">
                                            <option selected value="{{ $state_id }}">{{ $state_name }}</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile:</label>
                                        <input type="text" value="{{ $user_address->mobile }}" class="form-control"
                                            id="mobile">

                                    </div>
                                </div>
                            @endif

                            @if (isset($user))
                                @livewire('checkout.update-address-btn', ['user_id' => $user->id])
                            @endif

                        </div>

                    </div>
                    <div class="col-12 col-md-6">

                        <div class="your-order">
                            <div id="loading-screen" class="display_none">
                                <div style="color: black; " class="la-ball-fall la-5x">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>


                            </div>
                            <h5>Your Order</h5>
                            <div class="Product-form">
                                <div class="product-subtotal">
                                    <h5>Product</h5>
                                    <h5>Subtotal</h5>
                                </div>
                                @foreach ($cart_products as $product)
                                    <div class="product">
                                        <div class="product-data">

                                            <p>{{ $product['product_name'] }}</p>
                                            <input type="hidden" value="{{ $product['id'] }}" class="product_id">

                                            @if ($product['color'] != null)
                                                <p>Color: <span class="color"> {{ $product['color'] }}</span></p>
                                            @else
                                                <span class="color"></span>
                                            @endif
                                            @if ($product['size'] != null)
                                                <p>Color: <span class="size"> {{ $product['size'] }}</span></p>
                                            @else
                                                <span class="size"></span>
                                            @endif
                                            <p>Quantity: <span class="quantity"> {{ $product['quantity'] }}</span></p>
                                            <p>Price: <span class="price"> {{ $product['product_price'] }}</span>LE
                                            </p>

                                            <span class="error display_none" style="color: red"></span>


                                        </div>
                                        <div>
                                            <p class="subtotals"></p>

                                        </div>
                                    </div>
                                @endforeach
                                <div class="subtotal">
                                    <h5>Subtotal: </h5>
                                    <p id="subtotal"></p>

                                </div>
                                <div class="shipping">
                                    <h5>Shipping</h5>
                                    <div class="shipping-options">
                                        <div class="group">
                                            <label for="pickup">Pickup</label>
                                            <input type="radio" class="ship" checked id="pickup" value="pickup"
                                                name="shipping">


                                        </div>
                                        <div class="group">
                                            <label for="delivery">Delivey</label>
                                            <input type="radio" class="ship" id="delivery" value="delivery"
                                                name="shipping">


                                        </div>


                                    </div>
                                </div>
                                <div class="shipping-rate display_none">
                                    <p>Flat rate:<span id="shipping-rate"></span>LE</p>

                                </div>
                                <div class="payment">
                                    <h5>Payment Method</h5>
                                    <div class="payment-options">
                                        <div class="group">
                                            <label for="cash">Cash on Delivery</label>
                                            <input type="radio" class="cash" checked id="cash"
                                                value="cash_on_delivery" name="cash">


                                        </div>


                                    </div>
                                </div>
                                <div class="total-order">
                                    <h5>Total Order: </h5>
                                    <p id="total-price"></p>
                                </div>
                            </div>

                        </div>
                        <button id="submit-order" type="button" class="btn btn-primary">Place Order</button>






                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">

            </div>
        </div>
    </div>
@endsection

@section('checkout-scripts')
    <script>
        $(document).ready(function() {
            var total = 0;
            var subtotals = Array.from($(".subtotals"));
            for (var i = 0; i < subtotals.length; i++) {
                var quantity = $(".quantity").eq(i).html();
                var price = $(".price").eq(i).html();
                var totalPrice = Number(quantity) * Number(price);
                $(".subtotals").eq(i).html(`${totalPrice.toFixed(2)}LE`);
                total = total + totalPrice;

            }

            $("#total-price").html(`${total.toFixed(2)}`);
            $("#subtotal").html(`${total.toFixed(2)}`);
            $('.ship').each(function() {

                $(this).on('change', function() {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: "{{ route('shipping') }}",
                        method: 'post',
                        data: {
                            shipping: $(this).val(),
                            state_id: $("#state").val(),

                        },
                        beforeSend: function() {
                            $("#loading-screen").removeClass('display_none');
                            $("#loading-screen").addClass('display_flex');


                        },
                        complete: function() {
                            $("#loading-screen").removeClass('display_flex');
                            $("#loading-screen").addClass('display_none');


                        },
                        success: function(result) {

                            if (result.message == "success") {

                                $(".shipping-rate").removeClass('display_none');
                                $(".shipping-rate").addClass('display_flex');
                                $(".shipping").css("border-bottom", "0px");
                                $("#shipping-rate").html(`${result.shipping_rate}`);
                                var totalOrderPrice = $("#total-price").html();
                                var totalShipping = Number(totalOrderPrice) + Number(
                                    result.shipping_rate);

                                $("#total-price").html(`${totalShipping.toFixed(2)}`);



                            } else {

                                $(".shipping-rate").removeClass('display_flex');
                                $(".shipping-rate").addClass('display_none');
                                $(".shipping").css("border-bottom",
                                    "2px solid  #E6E6E6 ");
                                var totalOrderPrice = $("#total-price").html();
                                var totalShipping = Number(totalOrderPrice) - Number(
                                    result.shipping_rate);

                                $("#total-price").html(`${totalShipping.toFixed(2)}`);


                            }
                        }
                    });

                })

            });

            $("#submit-order").click(function() {
                var products = [];
                var product_ids = Array.from($(".product_id"));

                for (var x = 0; x < product_ids.length; x++) {
                    var quantity = $(".quantity").eq(x).html();
                    var price = $(".price").eq(x).html();
                    var product_id = $(".product_id").eq(x).val();
                    var color = $(".color").eq(x).html();
                    var size = $(".size").eq(x).html();
                    var product = {
                        'product_id': product_id,
                        "color": color,
                        'quantity': quantity,
                        'size': size,
                        'price': price

                    }
                    products.push(product);

                }

                jQuery.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    url: "{{ route('order') }}",
                    method: 'POST',
                    data: {
                        shipping_method: $("input[name='shipping']:checked").val(),
                        state_id: $("#state").val(),
                        payment_method: $("#cash").val(),
                        user_id: $("#user_id").val(),
                        subtotal: $("#subtotal").html(),
                        total_price: $("#total-price").html(),
                        products: products,


                    },
                    beforeSend: function() {
                        $("#spinner").removeClass('display_none');
                        $("#spinner").addClass('display_flex');


                    },
                    complete: function() {
                        $("#spinner").removeClass('display_flex');
                        $("#spinner").addClass('display_none');


                    },
                    success: function(result) {

                        if (result.message == "failed") {
                            result.errors.forEach(element => {
                                $(".error").eq(element.index).html(
                                `${element.message}`);
                                $(".error").eq(element.index).removeClass(
                                    'display_none');
                                $(".error").eq(element.index).addClass('display_block');



                            });
                        } else {
                            console.log(result);
                            // location.href="{{ route('home') }}";
                        }
                        //    window.location="{{ route('home') }}";


                    }

                })

            });
        });
    </script>
@endsection
