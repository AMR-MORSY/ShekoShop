<div class="row">
    @for ($i = 0; $i < count($color_sets); $i++)


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
        <div class="col-12 col-md-5 mt-3">
            <div class="form-group ">
                <div class="title d-flex justify-content-between align-items-center w-100 pt-3  ">
                    <p class=" text-center ">Sizes</p>
                    <p class=" w-50 text-center ">Quantites</p>
                </div>

                @if (isset($sizes))
                    <input type="hidden" class="size-collection{{ $color_sets[$i] }}" name="size[]">
                    <input type="hidden" class="quantity-collection{{ $color_sets[$i] }}" name="quantity[]">
                    @foreach ($sizes as $size)
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center w-25">
                                <label for='' style="display: inline-block">{{ $size->size_name }}</label>
                                <input type="checkbox" class="size{{ $color_sets[$i] }}" style="display: inline-block"
                                    value={{ $size->id }}>
                            </div>
                            <div class="quantity{{ $color_sets[$i] }}" style="margin-bottom: 3px">
                                <livewire:counter :wire:key= {{$color_sets[$i] }} />
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="form-group mt-2">
                <label for="image-collection0">images:</label>


                <input type="file" class="form-control image{{ $color_sets[$i] }}" value=""
                    multiple='multiple' name="images[{{ $color_sets[$i] }}][]">
            </div>
        </div>


    @endfor

    <div class="col-12">
        <div class="input-group mt-2">
            <button id="addColor" type="button" wire:click="addColor" class="btn btn-danger">AddColor</button>
        </div>
    </div>
</div>
