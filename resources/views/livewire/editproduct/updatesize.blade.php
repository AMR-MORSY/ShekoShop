<section id="update-size" style="display: {{ $display }}">
    <div class="size">


        @error('size')
            <p style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</p>
        @enderror

        @error('size.*')
            <p style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</p>
        @enderror
        @error('quantity')
            <p style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</p>
        @enderror


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


        @if (session()->has('size_updated'))
            <div class="alert alert-success">
                {{ session('size_updated') }}
            </div>
        @endif


        <form wire:submit.prevent="submit_update">
            <div class="collection row" style="position: relative; ">

                <i class="fa-solid fa-xmark close"
                    style="position:absolute;  width:20%; text-align:right; top:0; right:0; z-index:200;"
                    wire:click.prevent="close"></i>


                {{-- <input type="hidden" wire:model="product_id"> --}}

                <div class="col-12">
                    <div class="m-auto">
                        <div class="title d-flex justify-content-between align-items-center w-100 pt-3  ">
                            <p class=" text-center ">Sizes</p>
                            <p class=" w-50 text-center ">Quantites</p>
                        </div>


                        {{-- <input type="hidden" class="size-collection" wire:model="size" >
                        <input type="hidden" class="quantity-collection" wire:model="quantity" > --}}
                        @foreach ($sizes as $index => $size)
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center ">
                                    <label for='' style="display: inline-block">{{ $size->size_name }}</label>

                                    <input type="checkbox" wire:model="size.{{ $index }}"
                                        style="display: inline-block"value={{ $size->id }}
                                        {{-- @foreach ($filtered_sizes as $item) @if ($item->size_name == $size->size_name)
                                        {{ 'checked' }} @endif
                                        @endforeach --}}
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

                <div class="col-12">
                    <div class="input-group mt-2">
                        <button id='form-submit' type="submit" class="btn btn-danger">Update</button>
                    </div>
                </div>





            </div>
        </form>






    </div>

</section>
