
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
                                @if(session('product_status'))
                                    <div class=" alert alert-success">{{ session('product_status') }}</div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="facefront_image">Facefront Image</label>
                                        <input type="file" class="form-control" id='facefront_image' name='facefront_image'>

                                    </div>
                                </div>
                                 
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductName" >Product Name</label>
                                        <input type="text" id='ProductName'  class="@error('product_name') is-invalid @enderror form-control"
                                            placeholder="Product Name" value="{{$product->product_name}}" name='product_name'>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('product_name','store_product') <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>@enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductPrice" >Product Price</label>
                                        <input type="number" min="1" id='ProductPrice' class="form-control"
                                            placeholder="Product Price" value="{{$product->product_price}}" name='product_price'>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group mt-2">
                                        <label for="ProductWeight">Product Weight</label>
                                        <input type="number" min="0" id='ProductWeight' value="{{$product->product_weight}}" class="form-control"
                                            placeholder="Product Weight Kg..." name='product_weight'>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductCartDesc" >Prod.Cart Desc.</label>
                                        <input type="text" maxlength="250" value="{{$product->product_cartDesc}}" id='ProductCartDesc' class="form-control"
                                            placeholder="Product Cart Desc." name='product_cartDesc'>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group mt-2">
                                        <label for="ProductShortDesc" >Prod.Short Desc.</label>
                                        <input type="text" maxlength="1000" id='ProductShortDesc' class="form-control"
                                            placeholder="Product Short Desc." value="{{$product->product_shortDesc}}" name='product_shortDesc'>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group mt-2">
                                        <label for="LongDesc">Product Long Desc.</label>
                                        <textarea name="product_longDesc"   id="LongDesc" cols="70" rows="5">{{$product->product_longDesc}}</textarea>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductThumb" >Product Thumb</label>
                                        <input maxlength="100" id='ProductThumb' class="form-control"
                                            placeholder="Product Thumb" value="{{$product->product_thumb}}" name='product_thumb'>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="prouctCateg">Category:</label>
                                        {{-- <x-sellection id='prouctCateg' class="form-control" name='category_id' :categories="$product_categories" :product="$product" /> --}}
                                      
                                        <select id='prouctCateg' class="form-control"  name='category_id'>
                                            <option value></option>
                                            @if (isset($product_categories))
                                                {
                                                    
                                                    

                                                @foreach ($product_categories as $product_category)
                                                    {
                                                    
                                                      
                                                        <option value="{{ $product_category->category_name }}" @if ($product_category->category_name==$product->category_id) {{"selected"}} @endif >
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
                                            <option value="1" @if ($product->product_live=="1") {{"selected"}} @endif >Available</option>
                                            <option value="0"  @if ($product->product_live=="0") {{"selected"}} @endif>Unavailable</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductLocation" >Prod.Location</label>
                                        <input type="text" maxlength="250" id='ProductLocation' class="form-control"
                                            placeholder="Product Location" value="{{$product->product_location}}" name='product_location'>
                                    </div>

                                </div>
                             
                             
                             
                             
                             

                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             

                             
                             
                             

                             
                             
                             
                             
                             

                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             

                             <div class="col-12">
                                <div class="row">

                                   <div class="col-12 col-md-2">
                                    <div class="form-group mt-2">
                                        <label for="color">Color:</label>
                                        <select name="color[]" class="form-control" id="color">
                                            <option value=""></option>
                                            @if (isset($colors))
                                                @foreach ($colors as $color)
                                                    <option value={{ $color->id }}>{{ $color->color_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                   </div>
                                   <div class="col-12 col-md-5">
                                    <div class="form-group mt-4">
                                       
                                        @if (isset($sizes))
                                        <input type="hidden" class="size-collection1"  value="{{old('size[][]')}}" name="size[][]">
                                            @foreach ($sizes as $size)
                                                <label for=''>{{ $size->size_name }}</label><input type="checkbox" class="size1" value={{ $size->id }}>
                                            @endforeach
                                        @endif
                                    </div>
                                  </div>
                                   <div class="col-12 col-md-5">
                                    <div class="form-group mt-2">
                                        <label for="image-collection0">images:</label>
                                     
                                        <input type="file" class="form-control image0" value="{{old('images[0][][]')}}" multiple='multiple' name="images[0][][]" >
                                    </div>
                                   </div>
                                </div>
                            </div>


                                <div class="col-12">
                                    <div class="input-group mt-2">
                                        <button id="addColor" type="button" class="btn btn-danger">Add Color</button>
                                    </div>
                                </div>
                                <button class="btn btn-danger mt-5" id='form-submit' type="submit">submit</button>
                               
                            </div>
                          
                        </form>
                       
                     
                    </div>
                </div>
                <div class="col-lg-6">
                    @if(session('image_delete_success'))
                    <div class=" alert alert-success">{{ session('image_delete_success') }}</div>
                @endif
                    <div class="col-12">
                        <div class="color-size">
                            @php
                                    function filter_array($unfiltered_array,$color_name)
                                    {
                                        $filtered=array_filter($unfiltered_array,function($key) use ($color_name)
                                        {
                                              return $key==$color_name;
                                               },ARRAY_FILTER_USE_KEY);
      
                                                return $filtered;
                                     }
                            @endphp
                            <div class="row">
                                @if (isset($product_colors))
                                @foreach ($product_colors as $product_color)
                                <div class="col-12 col-md-2">
                                    <div class="form-group mt-2">
                                        <label for="color">Color:</label>
                                        <select name="color[]" class="form-control" id="color">
                                            <option value=""></option>
                                            @if (isset($colors))
                                                @foreach ($colors as $color)
                                                    <option value={{ $color->id }} @if ($color->color_name==$product_color->color_name)
                                                        {{"selected"}}
                                                        
                                                    @endif>{{ $color->color_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-7">
                                    <div class="form-group mt-4">
                                        @php
                                        $color=$product_color->color_name;
                                        $filtered=filter_array($product_sizes,$color);
                                        $filtered_images_urls=filter_array($product_images_urls,$color);
                                        $filtered_images_ids=filter_array($product_images_ids,$color);
                                        $color_images_ids=null;
                                        foreach ($filtered_images_ids as $key => $value) {
                                            $color_images_ids=$value;
                                               }
                                               $images_ids=$color_images_ids;
                                            
                                            $color_images_urls=null;
                                           

                                            foreach ($filtered_images_urls as $key => $value) {
                                                $color_images_urls=$value;
                                            }
                                            $images_urls=$color_images_urls;
                                            $color_sizes=null;
                                            foreach ($filtered as $key => $value) {
                                                $color_sizes=$value;
                                            }
                                            $filtered_sizes= $color_sizes;
                                          
                                        @endphp
                                       
                                        @if (isset($sizes))
                                        <input type="hidden" class="size-collection0"  value="{{old('size[][]')}}" name="size[][]">
                                            @foreach ($sizes as $size)
                                                <label for=''>{{ $size->size_name }}</label><input type="checkbox" class="size0" @foreach ($filtered_sizes as $item)
                                                    @if ($item== $size->size_name)
                                                    {{'checked'}}
                                                        
                                                    @endif
                                                @endforeach value={{ $size->id }}>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <a href="" class="btn btn-primary">update Sizes</a>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        @for ($i = 0; $i < count($images_urls); $i++)
                                        <div class="col-3">
     
                                            <div class="image-container">
                                                <img class="w-100" src={{$images_urls[$i]}} alt="">
                                            </div>
                                            <div class="d-flex justify-content-center align-items-center mt-2">
                                                <a href="{{route('delete_product_image',['product_id'=>$product->id,'color_id'=>$product_color->id,'image_id'=>$images_ids[$i]])}}" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                            
                                        @endfor
                                         
                                    </div>
                                </div>
                                    
                                @endforeach
                               
                               
                                @endif
                        
                               
                            </div>
                        </div>
                    </div>
                   
                   
                   

                   
                 
                </div>
            </div>
        </div>

       
       


    </section>
@endsection

@section('scripts')
    <script>
        
       
        var i = 1;
        var counter = 0;
        $('#addColor').on('click', function() {

            i++;
            $('.color-size >.row').append('<div class="col-12 col-md-2"><div class="form-group mt-2"><label for="color">Color:</label><select name="color[]" class="form-control" id="color"><option value=""></option>@if(isset($colors))@foreach($colors as $color)<option value={{$color->id}}>{{$color->color_name}}</option>@endforeach @endif </select></div></div><div class="col-12 col-md-5"><div class="form-group mt-4"><input type="hidden" class="size-collection'+i+'" value name="size[][]">@if (isset($sizes))@foreach ($sizes as $size)<label for="">{{$size->size_name}}</label><input type="checkbox" id="" value="{{$size->id}}" class="size'+i+'"> @endforeach @endif </div></div><div class="col-12 col-md-5"><div class="form-group mt-2"> <label for="">images:</label><input type="file"class="form-control" multiple="multiple" name="images['+i+'][][]"></div></div>');
            counter++;
        })

        $(document).ready(function() {
            $('#form-submit').on('click', function() {

                for (var x = 0; x <= counter; x++) {
                    var sizes_collection = [];
                    $(`.size${x}`).each(function(){
                       
                        if(this.checked)
                        {
                            sizes_collection.push($(this).val());
                        }
                        
                    })
                    $(`.size-collection${x}`).val(sizes_collection);
                  
                  
                 
                 

                }
               
               
              
            });

            
            
            
            
            
            
            
            
            
    
          

        })
    </script>
@endsection
