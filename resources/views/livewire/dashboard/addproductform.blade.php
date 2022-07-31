<section id="add-product">
    
<div class="col-lg-6">
    <div class="title">
        <h3>Add Product</h3>
    </div>
    {{-- <div class="errors-bag w-100 d-flex flex-column align-items-center justify-content-center">

        @error('color', 'store_product')
            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
        @enderror
        @error('color.*', 'store_product')
            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
        @enderror
        @error('size', 'store_product')
            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
        @enderror

        @error('size.*.*', 'store_product')
            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
        @enderror
        @error('quantity', 'store_product')
            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
        @enderror
        @error('quantity.*.*', 'store_product')
            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
        @enderror
        @error('images', 'store_product')
            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
        @enderror
        @error('images.*.*', 'store_product')
            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
        @enderror
        @error('images.*', 'store_product')
            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
        @enderror

    </div> --}}
    <div class="form-container">
        <form wire:submit.prevent='addproduct' enctype="multipart/form-data">
            @csrf

            <div class="row">
                @if (session('product_status'))
                    <div class=" alert alert-success">{{ session('product_status') }}</div>
                @endif
                <div class="col-md-6">
                    <div class="form-group mt-2">
                        <label for="facefront_image">Facefront Image</label>
                        <input type="file" class="form-control" id='facefront_image'
                         wire:model= 'facefront_image'  name='facefront_image'>

                    </div>
                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                        @error('facefront_image')
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
                          wire:model='product_name'  name='product_name'>
                    </div>
                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                        @error('product_name')
                            <span style="color: red; font-size:0.75rem; text-align:left;">
                                {{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group mt-2">
                        <label for="ProductPrice">Product Price</label>
                        <input type="text"  id='ProductPrice' class="form-control"
                            placeholder="Product Price" value="{{ old('product_price') }}"
                      wire:model='product_price'     name='product_price'>
                    </div>
                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                        @error('product_price')
                            <span
                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="form-group mt-2">
                        <label for="ProductWeight">Product Weight</label>
                        <input type="text" min="0" id='ProductWeight'
                            value="{{ old('product_weight') }}" class="form-control"
                            placeholder="Product Weight Kg..." wire:model='product_weight' name='product_weight'>
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
                       wire:model= 'product_cartDesc'    name='product_cartDesc'>
                    </div>
                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                        @error('product_cartDesc')
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
                        wire:model='product_shortDesc'    name='product_shortDesc'>
                    </div>
                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                        @error('product_shortDesc')
                            <span
                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-group mt-2">
                        <label for="LongDesc">Product Long Desc.</label>
                        <textarea name="product_longDesc"   wire:model='product_longDesc'   id="LongDesc" cols="70" rows="5">{{ old('product_longDesc') }}</textarea>
                    </div>
                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                        @error('product_longDesc')
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
                            wire:model='product_thumb'     name='product_thumb'>
                    </div>
                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                        @error('product_thumb')
                            <span
                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    @if (isset($categories))
                        {{-- @livewire('dashboard.categories', ['categories' => $categories]) --}}
                        <div class="form-group mt-2">
                            <label for="prouctCateg">Category:</label>
                            <select id='prouctCateg' class="form-control" wire:model='category' wire:change='changeCategory'  name='category_id'>
                                <option value="" selected>--Select-Category--</option>
                        
                                @foreach ($categories as $category)
                                    {
                                    <option value="{{ $category->category_name }}">
                                        {{ $category->category_name }}</option>
                        
                                    }
                                @endforeach
                        
                            </select>
                        </div>
                        
                    @endIf
                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                        @error('category')
                            <span
                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="col-md-6">
                     @if (isset($devisions)) 
                        {{-- @livewire('dashboard.devisions', ['devisions' => $devisions]) --}}
                    @endIf 
                    <div class="form-group mt-2">
                        <label for="prouctCateg">Devision:</label>
                        <select id='prouctCateg' class="form-control" wire:model='devision' name='devision_id'>
                            <option value="" selected>--Select-Devision--</option>
                    
                            @foreach ($devisions as $devision)
                                {
                                <option value="{{ $devision->devision_name }}">
                                    {{ $devision->devision_name }}</option>
                    
                                }
                            @endforeach
                    
                        </select>
                    </div>
                    
                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                        @error('devision')
                            <span
                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                
                <div class="col-md-6">
                    @if (isset($types))
                        {{-- @livewire('dashboard.types', ['types' => $types]) --}}
                        <div class="form-group mt-2">
                            <label for="prouctCateg">Type:</label>
                            <select id='prouctCateg' class="form-control" wire:model='type' name='type_id'>
                                <option value="" selected>--Select-Type--</option>
                        
                                @foreach ($types as $type)
                                    {
                                    <option value="{{ $type->type_name }}">
                                        {{ $type->type_name }}</option>
                        
                                    }
                                @endforeach
                        
                            </select>
                        </div>
                        
                    @endIf
                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                        @error('type')
                            <span
                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
              
                {{-- <div class="col-md-6">
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

                </div> --}}
                <div class="col-md-6">
                    <div class="form-group mt-2">
                        <label for="ProductLocation">Prod.Location</label>
                        <input type="text" maxlength="250" id='ProductLocation' class="form-control"
                            placeholder="Product Location" value="{{ old('product_location') }}"
                        wire:model='product_location'    name='product_location'>
                    </div>
                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                        @error('product_location')
                            <span
                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                {{-- <div class="col-12">
                    @if (session('quantity_errors'))
                        <ul>
                            @foreach (session('quantity_errors') as $error)
                                <li style="color: red">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="color-size"style="border: 1px solid black; background-color:gray; padding:1rem 0.5rem">

                     
                        <livewire:add-product-color :colors="$colors" :sizes="$sizes" />

                    </div>
                </div> --}}

                <button class="btn btn-danger mt-5" id='form-submit' type="submit">submit</button>
            </div>

        </form>


    </div>
</div>

</section>

