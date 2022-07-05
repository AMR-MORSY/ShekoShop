@extends('layouts.master')
@section('content')
    <section id="add-products">

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title">
                        <h3>Add Product</h3>
                    </div>
                    <div class="errors-bag w-100 d-flex flex-column align-items-center justify-content-center">
                        @error('images', 'store_product')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                        @error('color', 'store_product')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                        @error('size', 'store_product')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                        @error('images.*.*', 'store_product')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror

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
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('facefront_image', 'store_product')
                                            <span style="color: red; font-size:0.75rem; text-align:left;">
                                                {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductName">Product Name</label>
                                        <input type="text" id='ProductName'
                                            class="@error('product_name') is-invalid @enderror form-control"
                                            placeholder="Product Name" value="{{ old('product_name') }}"
                                            name='product_name'>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('product_name', 'store_product')
                                            <span style="color: red; font-size:0.75rem; text-align:left;">
                                                {{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductPrice">Product Price</label>
                                        <input type="number" min="1" id='ProductPrice' class="form-control"
                                            placeholder="Product Price" value="{{ old('product_price') }}"
                                            name='product_price'>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('product_price', 'store_product')
                                            <span
                                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group mt-2">
                                        <label for="ProductWeight">Product Weight</label>
                                        <input type="number" min="0" id='ProductWeight'
                                            value="{{ old('product_weight') }}" class="form-control"
                                            placeholder="Product Weight Kg..." name='product_weight'>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('product_weight', 'store_product')
                                            <span
                                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductCartDesc">Prod.Cart Desc.</label>
                                        <input type="text" maxlength="250" value="{{ old('product_cartDesc') }}"
                                            id='ProductCartDesc' class="form-control" placeholder="Product Cart Desc."
                                            name='product_cartDesc'>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('product_cartDesc', 'store_product')
                                            <span
                                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group mt-2">
                                        <label for="ProductShortDesc">Prod.Short Desc.</label>
                                        <input type="text" maxlength="1000" id='ProductShortDesc' class="form-control"
                                            placeholder="Product Short Desc." value="{{ old('product_shortDesc') }}"
                                            name='product_shortDesc'>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('product_shortDesc', 'store_product')
                                            <span
                                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group mt-2">
                                        <label for="LongDesc">Product Long Desc.</label>
                                        <textarea name="product_longDesc" id="LongDesc" cols="70" rows="5">{{ old('product_longDesc') }}</textarea>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('product_longDesc', 'store_product')
                                            <span
                                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductThumb">Product Thumb</label>
                                        <input maxlength="100" id='ProductThumb' class="form-control"
                                            placeholder="Product Thumb" value="{{ old('product_thumb') }}"
                                            name='product_thumb'>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('product_thumb', 'store_product')
                                            <span
                                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="prouctCateg">Category:</label>
                                        <select id='prouctCateg' class="form-control" name='category_id'>
                                            <option value=""></option>
                                            @if (isset($product_categories))
                                                {

                                                @foreach ($product_categories as $product_category)
                                                    {
                                                    <option value="{{ $product_category->category_name }}">
                                                        {{ $product_category->category_name }}</option>

                                                    }
                                                @endforeach
                                                }
                                            @endif
                                        </select>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('category_id', 'store_product')
                                            <span
                                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for='ProductLive'>Availability:</label>
                                        <select name='product_live' class="form-control" id='ProductLive'>
                                            <option value="1" selected>Available</option>
                                            <option value="0">Unavailable</option>
                                        </select>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('product_live', 'store_product')
                                            <span
                                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductLocation">Prod.Location</label>
                                        <input type="text" maxlength="250" id='ProductLocation' class="form-control"
                                            placeholder="Product Location" value="{{ old('product_location') }}"
                                            name='product_location'>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('product_location', 'store_product')
                                            <span
                                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="color-size"
                                        style="border: 1px solid black; background-color:gray; padding:1rem 0.5rem">
                                        
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
                                            {{-- <div class="col-12 col-md-5 mt-3"> --}}
                                            {{-- <div class="form-group "> --}}
                                            {{-- <div --}}
                                            {{-- class="title d-flex justify-content-between align-items-center w-100 pt-3  "> --}}
                                            {{-- <p class=" text-center ">Sizes</p> --}}
                                            {{-- <p class=" w-50 text-center " >Quantites</p> --}}
                                            {{-- </div> --}}
                                            {{--  --}}
                                            {{-- @if (isset($sizes)) --}}
                                            {{-- <input type="hidden" class="size-collection0"  name="size[]"> --}}
                                            {{-- <input type="hidden" class="quantity-collection0"  name="quantity[]"> --}}
                                            {{-- @foreach ($sizes as $size) --}}
                                            {{--  --}}
                                            {{-- <div class="d-flex justify-content-between align-items-center" > --}}
                                            {{-- <div class="d-flex justify-content-between align-items-center w-25"> --}}
                                            {{-- <label for='' style="display: inline-block">{{ $size->size_name }}</label> --}}
                                            {{-- <input type="checkbox" class="size0" --}}
                                            {{-- style="display: inline-block" value={{$size->id }}> --}}
                                            {{-- </div> --}}
                                            {{-- <div class="quantity0" style="margin-bottom: 3px"> --}}

                                            {{-- <livewire:counter/> --}}
                                            {{-- </div> --}}

                                            {{-- </div> --}}
                                            {{--  --}}
                                            {{--  --}}
                                            {{--  --}}
                                            {{-- @endforeach --}}
                                            {{-- @endif --}}
                                            {{-- </div> --}}
                                            {{-- </div> --}}
                                            {{-- <div class="col-12 col-md-5"> --}}
                                            {{-- <div class="form-group mt-2"> --}}
                                            {{-- <label for="image-collection0">images:</label> --}}
                                            {{--  --}}
                                            {{--  --}}
                                            {{-- <input type="file" class="form-control image0" value="{{old('images[0][][]')}}" --}}
                                            {{-- multiple='multiple' name="images[0][]" > --}}
                                            {{-- </div> --}}
                                            {{-- </div> --}}
                                            {{-- </div> --}}
                                            {{-- </div> --}}
                                            {{-- </div> --}}

                                            <livewire:add-product-color :colors="$colors" :sizes="$sizes" />
                                        
                                    </div>
                                </div>

                                <button class="btn btn-danger mt-5" id='form-submit' type="submit">submit</button>
                            </div>

                        </form>


                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="title">
                        <h3>Search Product</h3>
                    </div>

                    @livewire('search-product')

                </div>
            </div>
        </div>





    </section>
@endsection

@section('scripts')
    <script>
        var i = 0;
        var counter = 0;
        // $('#addColor').on('click', function() {

            // i++;


            // counter++;
        // })

        $(document).ready(function() {
            $('#form-submit').on('click', function() {

                for (var x = 0; x <= counter; x++) {
                    var sizes_collection = [];
                    $(`.size${x}`).each(function() {

                        if (this.checked) {
                            sizes_collection.push($(this).val());
                        }

                    })
                    $(`.size-collection${x}`).val(sizes_collection);





                }

                var quant = $('.quantity0 .counter').html();

                console.log(quant);



            });













        })
    </script>
@endsection
