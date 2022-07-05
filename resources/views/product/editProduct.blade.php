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
                                    <div class="form-group mt-2">
                                        <label for="prouctCateg">Category:</label>
                                        {{-- <x-sellection id='prouctCateg' class="form-control" name='category_id' :categories="$product_categories" :product="$product" /> --}}

                                        <select id='prouctCateg' class="form-control" name='category_id'>
                                            <option value></option>
                                            @if (isset($product_categories))
                                                {



                                                @foreach ($product_categories as $product_category)
                                                    {


                                                    <option value="{{ $product_category->category_name }}"
                                                        @if ($product_category->category_name == $product->category_id) {{ 'selected' }} @endif>
                                                        {{ $product_category->category_name }}</option>



                                                    }
                                                @endforeach
                                                }
                                            @endif
                                        </select>
                                    </div>

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

                                {{-- <div class="col-12"> --}}
                                    {{-- <div class="row"> --}}

                                        {{-- <div class="col-12 col-md-2"> --}}
                                            {{-- <div class="form-group mt-2"> --}}
                                                {{-- <label for="color">Color:</label> --}}
                                                {{-- <select name="color[]" class="form-control" id="color"> --}}
                                                    {{-- <option value=""></option> --}}
                                                    {{-- @if (isset($colors)) --}}
                                                        {{-- @foreach ($colors as $color) --}}
                                                            {{-- <option value={{ $color->id }}>{{ $color->color_name }} --}}
                                                            {{-- </option> --}}
                                                        {{-- @endforeach --}}
                                                    {{-- @endif --}}
                                                {{-- </select> --}}
                                            {{-- </div> --}}
                                        {{-- </div> --}}
                                        {{-- <div class="col-12 col-md-5"> --}}
                                            {{-- <div class="form-group mt-4"> --}}

                                                {{-- @if (isset($sizes)) --}}
                                                    {{-- <input type="hidden" class="size-collection1" --}}
                                                        {{-- value="{{ old('size[][]') }}" name="size[][]"> --}}
                                                    {{-- @foreach ($sizes as $size) --}}
                                                        {{-- <label for=''>{{ $size->size_name }}</label><input --}}
                                                            {{-- type="checkbox" class="size1" value={{ $size->id }}> --}}
                                                    {{-- @endforeach --}}
                                                {{-- @endif --}}
                                            {{-- </div> --}}
                                        {{-- </div> --}}
                                        {{-- <div class="col-12 col-md-5"> --}}
                                            {{-- <div class="form-group mt-2"> --}}
                                                {{-- <label for="image-collection0">images:</label> --}}

                                                {{-- <input type="file" class="form-control image0" --}}
                                                    {{-- value="{{ old('images[0][][]') }}" multiple='multiple' --}}
                                                    {{-- name="images[0][][]"> --}}
                                            {{-- </div> --}}
                                        {{-- </div> --}}
                                    {{-- </div> --}}
                                {{-- </div> --}}
                              {{--  --}}
                              
                              
                              
                              
                                <button class="btn btn-danger mt-5"  type="submit">submit</button>

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
                        {{-- @error('last_image') --}}
                        {{-- <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span> --}}
{{--                              --}}
                        {{-- @enderror --}}
                        @if ($errors->any())
                        <span style="color: red; font-size:0.75rem; text-align:left;">{{ $errors->first('last_image') }}</span> 
                        <span style="color: red; font-size:0.75rem; text-align:left;">{{ $errors->first('images') }}</span> 
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



                                        <div class="col-12 col-md-7">
                                            <div class="form-group mt-4">
                                                @php
                                                    $color = $product_colors[$v]->color_name;
                                                    $filtered = filter_array($product_sizes, $color);
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
                                                    
                                                @endphp
                                                <form action="{{ route('update_color_size') }}" method="POST">
                                                    @csrf
                                                    @if (isset($sizes))
                                                        <input type="hidden"
                                                            class="collection size-collection{{ $v }}"
                                                            value="" name="size">
                                                        <input type="hidden" name="color"
                                                            value="{{ $product_colors[$v]->id }}">
                                                        <input type="hidden" name="product"
                                                            value="{{ $product->id }}">
                                                        @foreach ($sizes as $size)
                                                            <label for=''>{{ $size->size_name }}</label><input
                                                                type="checkbox" class="sizo{{ $v }}"
                                                                @foreach ($filtered_sizes as $item) @if ($item == $size->size_name)
                                                    {{ 'checked' }} @endif
                                                                @endforeach value={{ $size->id }}>
                                                        @endforeach
                                                    @endif
                                                    <button class="btn btn-primary size-update" type="submit">update
                                                        Sizes</button>
                                                </form>
                                            </div>


                                        </div>



                                        <div class="col-12">
                                            <div class="row">
                                                @for ($i = 0; $i < count($images_urls); $i++)
                                                    <div class="col-3">
                                                        <div class="image-container">
                                                            <img class="w-100" src={{ $images_urls[$i] }}
                                                                alt="">
                                                        </div>
                                                        <div class="d-flex justify-content-center align-items-center mt-2">
                                                            <a href="{{ route('delete_product_image', [
                                                                'product_id' => $product->id,
                                                                'color_id' => $product_colors[$v]->id,
                                                                'image_id' => $images_ids[$i],
                                                            ]) }}"
                                                                class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>

                                                @endfor

                                            </div>
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
                            <div class="input-group mt-2">
                                <button id="addColor" type="button" class="btn btn-danger">Add Color</button>
                            </div>
                        </div>
                        <div class="col-12">
                         
                           @if (session()->has('message'))
                           <div class="alert alert-success">
                            {{ session('message') }}
                            </div>
                           @endif
                         
                           @error('exist_color')
                           <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                           @enderror
                            @error('color', 'add_color')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                            @enderror
                            @error('size', 'add_color')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                            @enderror
                            @error('images.*.*', 'add_color')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                            @enderror
                            @error('images')
                              <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                             @enderror
                        </div>
                                                        
                        <div class="col-12">
                            <form method="POST" action="{{ route('add_product_color') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="color-size">
                                    <div class="row">
                                        
                                    </div>
                                  
                                  
                                  
                                </div>

                                <button class="btn btn-danger mt-5" id='form-submit' type="submit">Add </button>
                               
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>
@endsection

@section('scripts')
    <script>
        var i = -1;
        var counter = 0;
        $('#addColor').on('click', function() {

            i++;
            $('.color-size >.row').append('<div class="col-12 col-md-2"><div class="form-group mt-2"><label for="color">Color:</label><select name="color[]" class="form-control" id="color"><option value=""></option>@if(isset($colors))@foreach($colors as $color)<option value={{$color->id}}>{{$color->color_name}}</option>@endforeach @endif</select></div></div><div class="col-12 col-md-5"><div class="form-group mt-4"><input type="hidden" class="size-collection'+i+'" value name="size[]">@if (isset($sizes))@foreach ($sizes as $size)<label for="">{{$size->size_name}}</label><input type="checkbox" id="" value="{{$size->id}}" class="size'+i+'"> @endforeach @endif </div></div><div class="col-12 col-md-5"><div class="form-group mt-2"><label for="">images:</label><input type="file"class="form-control" multiple="multiple" name="images['+i+'][]"></div></div>');
           counter++;




        })

        $(document).ready(function() {
            $('#form-submit').on('click', function() {
                $.ajax('/product/addColor',{beforeSend:function(){
    $('.spinner').css('display','flex');
},success:function(){
    $('.spinner').css('display','none');
}});


                for (var x = 0; x <= counter; x++) {
                    var sizes_collection = [];
                    $(`.size${x}`).each(function() {

                        if (this.checked) {
                            sizes_collection.push($(this).val());

                        }

                    })
                    $(`.size-collection${x}`).val(sizes_collection);





                }



            });




        });

        var Collection = document.querySelectorAll('.collection');

        $('.size-update').each(function() {
            $(this).on('click', function() {
               

               
                for (var i = 0; i < Collection.length; i++) {
                    var collections = [];
                    $(`.sizo${i}`).each(function() {

                        if (this.checked) {
                            collections.push($(this).val());
                           
                        }



                    })

                   
                    $(`.size-collection${i}`).val(collections);


                    

                }




            });
        });
        








     
     

     
     

     
    </script>
@endsection
