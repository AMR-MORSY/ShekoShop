<section id="add-product-color" style="display: {{ $display }}">
    <div class="color">

        @error('color')
            <p style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</p>
        @enderror
        @error('size')
            <p style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</p>
        @enderror

        @error('size.*')
            <p style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</p>
        @enderror
        @error('quantity')
            <p style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</p>
        @enderror
        @error('images.*')
            <p style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</p>
        @enderror
        @error('images')
            <p style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</p>
        @enderror
        @error('exist_color')
            <p style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</p>
        @enderror
        {{-- @error('quantity_error')
            <p style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</p>
        @enderror --}}

        @if (session()->has('quantity_error'))
            <p style="color: red; font-size:0.75rem; text-align:left;">
                {{ session('quantity_error') }}
            </p>
        @endif
        @if (session()->has('exist_color'))
        <p style="color: red; font-size:0.75rem; text-align:left;">
                {{ session('exist_color') }}
        </p>
        @endif


        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif


        <form wire:submit.prevent="add_prod_color">
            <div class="collection row" style="position: relative; ">

                <i class="fa-solid fa-xmark close"
                    style="position:absolute;  width:20%; text-align:right; top:0; right:0; z-index:200;"
                    wire:click.prevent="close"></i>


                <input type="hidden" wire:model="product_id">
                <div class="col-12 col-md-2">
                    <div class="form-group mt-2">
                        <label for="color">Color:</label>
                        <select wire:model="color" class="form-control">
                            <option value=""></option>

                            @foreach ($colors as $color)
                                <option value={{ $color->id }}>{{ $color->color_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-5 mt-3">
                    <div class="form-group ">
                        <div class="title d-flex justify-content-between align-items-center w-100 pt-3  ">
                            <p class=" text-center ">Sizes</p>
                            <p class=" w-50 text-center ">Quantites</p>
                        </div>


                    
                        @foreach ($sizes as $index => $size)
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center w-25">
                                    <label for=''
                                        style="display: inline-block">{{ $size->size_name }}</label>
                                    <input type="checkbox" class="size" wire:model="size.{{ $index }}"
                                        style="display: inline-block"value={{ $size->id }}
                                        wire:key="size.{{ $size->id }}">
                                </div>

                                <div class="quantity" style="margin-bottom: 3px">
                                
                                    <input type="number" min=0 wire:model="quantity.{{ $index }}"
                                        value="0" wire:key="{{ $index }}">

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group mt-2">
                        <label for="image-collection0">images:</label>
                        <input type="file" class="form-control image" wire:model="images" multiple>
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-group mt-2">
                        <button id='form-submit' type="submit" class="btn btn-danger">AddColor</button>
                    </div>
                </div>






            </div>
        </form>






    </div>

</section>
