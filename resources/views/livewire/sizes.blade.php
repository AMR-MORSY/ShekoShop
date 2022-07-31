<div class="row w-25 mb-2">

    <select wire:model="size_id" class="form-control" wire:change="sizeIdChanged">
        {{-- <option value="select_size">--Select Size--</option> --}}
        @foreach ($filteredSizes as $size)
            <option value={{ $size['id'] }}>
             
              {{ $size['size_name'] }}
               
            </option>
        @endforeach

    </select>

    


</div>
