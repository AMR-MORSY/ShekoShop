@extends('layouts.master')
@section('content')
    <section id="add-products">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title">
                        <h3>Add Product</h3>

                    </div>
                    <div class="form-container">
                        <form method="POST" action="{{ route('addProduct') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                @if (session('product_status'))
                                    <div class=" alert alert-success">{{ session('product_status') }}</div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="facefront_image">Facefront Image</label>
                                        <input type="file" class="form-control" id='facefront_image'
                                            name='facefront_image'>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductName">Product Name</label>
                                        <input type="text" id='ProductName'
                                            class="@error('product_name') is-invalid @enderror form-control"
                                            placeholder="Product Name" value="{{ $product->product_name }}"
                                            name='product_name'>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('product_name', 'store_product')
                                            <span
                                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductPrice">Product Price</label>
                                        <input type="number" min="1" id='ProductPrice' class="form-control"
                                            placeholder="Product Price" value="{{ $product->product_price }}"
                                            name='product_price'>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group mt-2">
                                        <label for="ProductWeight">Product Weight</label>
                                        <input type="number" min="0" id='ProductWeight'
                                            value="{{ $product->product_weight }}" class="form-control"
                                            placeholder="Product Weight Kg..." name='product_weight'>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductCartDesc">Prod.Cart Desc.</label>
                                        <input type="text" maxlength="250" value="{{ $product->product_cartDesc }}"
                                            id='ProductCartDesc' class="form-control" placeholder="Product Cart Desc."
                                            name='product_cartDesc'>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group mt-2">
                                        <label for="ProductShortDesc">Prod.Short Desc.</label>
                                        <input type="text" maxlength="1000" id='ProductShortDesc' class="form-control"
                                            placeholder="Product Short Desc." value="{{ $product->product_shortDesc }}"
                                            name='product_shortDesc'>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group mt-2">
                                        <label for="LongDesc">Product Long Desc.</label>
                                        <textarea name="product_longDesc" id="LongDesc" cols="70" rows="5">{{ $product->product_longDesc }}</textarea>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductThumb">Product Thumb</label>
                                        <input maxlength="100" id='ProductThumb' class="form-control"
                                            placeholder="Product Thumb" value="{{ $product->product_thumb }}"
                                            name='product_thumb'>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    @livewire('editproduct.categories', ['product' => $product, 'categories' => $categories])

                                </div>
                                <div class="col-md-6">
                                    @livewire('editproduct.devisions', ['product' => $product])


                                </div>
                                <div class="col-md-6">
                                    @livewire('editproduct.types', ['product' => $product, 'types' => $types])


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for='ProductLive'>Availability:</label>
                                        <select name='product_live' class="form-control" id='ProductLive'>
                                            <option value="1"
                                                @if ($product->product_live == '1') {{ 'selected' }} @endif>Available
                                            </option>
                                            <option value="0"
                                                @if ($product->product_live == '0') {{ 'selected' }} @endif>Unavailable
                                            </option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductLocation">Prod.Location</label>
                                        <input type="text" maxlength="250" id='ProductLocation' class="form-control"
                                            placeholder="Product Location" value="{{ $product->product_location }}"
                                            name='product_location'>
                                    </div>

                                </div>



                                <button class="btn btn-danger mt-5" type="submit">submit</button>

                            </div>

                        </form>


                    </div>
                </div>
                <div class="col-lg-6 mt-5">
                    <div class="row">
                        @error('facefront_image', 'update_facefront')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                        @if (session('image_delete_success'))
                            <div class=" alert alert-success">{{ session('image_delete_success') }}</div>
                        @endif
                        @if (session('delete_product_color'))
                            <div class=" alert alert-success">{{ session('delete_product_color') }}</div>
                        @endif
                        @if (session('sizes_updated'))
                            <div class=" alert alert-success">{{ session('sizes_updated') }}</div>
                        @endif

                        @if ($errors->any())
                            <span
                                style="color: red; font-size:0.75rem; text-align:left;">{{ $errors->first('last_image') }}</span>
                            <span
                                style="color: red; font-size:0.75rem; text-align:left;">{{ $errors->first('images') }}</span>
                        @endif
                        @error('color', 'update_color_size')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                        @error('product', 'update_color_size')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                        @error('size', 'update_color_size')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                        <div class="col-md-6">
                            <form action="{{ route('update_facefront_image') }}" enctype="multipart/form-data"
                                method="Post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Add Facefront Image:</label>
                                    <input type="file" name="facefront_image">
                                </div>
                                <input type="hidden" name="product" value="{{ $product->id }}">
                                <div class="form-group mt-3">
                                    <button class="btn btn-info" type="submit">Update</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-4">

                            <div class="image-container">
                                <img class="w-100" src={{ $facefront_image }} alt="">
                            </div>
                            <div class="face-front-caption">
                                <p style="color: red">Facefront Image</p>
                            </div>

                        </div>
                        <div class="col-12">

                            @php
                                function filter_array($unfiltered_array, $color_name)
                                {
                                    $filtered = array_filter(
                                        $unfiltered_array,
                                        function ($key) use ($color_name) {
                                            return $key == $color_name;
                                        },
                                        ARRAY_FILTER_USE_KEY,
                                    );
                                    return $filtered;
                                }
                            @endphp
                            <div class="row">
                                @if (isset($product_colors))
                                    @for ($v = 0; $v < count($product_colors); $v++)
                                        {{ $product_colors[$v]->color_name }}

                                        <div class="col-12 ">

                                            @php
                                                $color = $product_colors[$v]->id;
                                                $filtered = filter_array($product_sizes, $color);
                                                $filtered_quantities = filter_array($quantities, $color);
                                                $filtered_images_urls = filter_array($product_images_urls, $color);
                                                $filtered_images_ids = filter_array($product_images_ids, $color);
                                                $color_images_ids = null;
                                                foreach ($filtered_images_ids as $key => $value) {
                                                    $color_images_ids = $value;
                                                }
                                                $images_ids = $color_images_ids;
                                                
                                                $color_images_urls = null;
                                                
                                                foreach ($filtered_images_urls as $key => $value) {
                                                    $color_images_urls = $value;
                                                }
                                                $images_urls = $color_images_urls;
                                                $color_sizes = null;
                                                foreach ($filtered as $key => $value) {
                                                    $color_sizes = $value;
                                                }
                                                $filtered_sizes = $color_sizes;
                                                $color_quantities = null;
                                                foreach ($filtered_quantities as $key => $value) {
                                                    $color_quantities = $value;
                                                }
                                                
                                              
                                                
                                            @endphp
                                                <div class="row">
                                                    <div class="col-4">
                                                        <p>Available Sizes:</p>
                                                        @foreach ($filtered_sizes as $size)
                                                        <p>{{$size->size_name}}</p>
                                                            
                                                        @endforeach

                                                    </div>
                                                    <div class="col-4">
                                                        <p>Quantities:</p>
                                                        @foreach ($color_quantities as $quantity)
                                                        <p>{{$quantity}}</p>
                                                            
                                                        @endforeach
                                                    </div>
                                                    <div class="col-4">
                                                        @livewire('editproduct.updatesize-btn', ['color_id' => $color,'color_quantities'=>$color_quantities,'filtered_sizes'=>$filtered_sizes], key($v))
                                                    </div>
                                                </div>



                                        </div>



                                        <div class="col-12">



                                            @livewire('editproduct.carousel', ['product_id' => $product->id, 'color_id' => $product_colors[$v]->id, 'images_ids' => $images_ids, 'images_urls' => $images_urls], key($v))



                                        </div>
                                        <div class="col-12">
                                            <div class="delete-button-container">
                                                <a href="{{ route('delete-product-color', ['product' => $product->id, 'color' => $product_colors[$v]->id]) }}"
                                                    class="btn btn-danger">Delete Color</a>
                                            </div>
                                        </div>
                                    @endfor
                                @endif


                            </div>

                        </div>
                        <div class="col-12">
                            @livewire('editproduct.addcolorbtn')

                        </div>
                        @livewire('editproduct.add-product-color', ['colors' => $colors, 'sizes' => $sizes, 'product_id' => $product->id])
                        @livewire('editproduct.updatesize', ['sizes' => $sizes,'product_id' => $product->id])
                        @livewire('editproduct.color-delete-confirmation')


                        <div class="col-12">

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>
@endsection

@section('scripts')
    <script>
        // var Collection = document.querySelectorAll('.collection');

        // $('.size-update').each(function() {
        //     $(this).on('click', function() {



        //         for (var i = 0; i < Collection.length; i++) {
        //             var collections = [];
        //             $(`.sizo${i}`).each(function() {

        //                 if (this.checked) {
        //                     collections.push($(this).val());

        //                 }



        //             })


        //             $(`.size-collection${i}`).val(collections);




        //         }




        //     });
        // });
    </script>
@endsection
