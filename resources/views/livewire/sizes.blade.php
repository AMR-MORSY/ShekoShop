<div class="row">

    <select wire:model="size_name" wire:change="sizeNameChanged">
        <option ></option>
        @foreach ($filteredSizes as $size)

       <option value="{{$size}}">{{$size}}</option>

        @endforeach

    </select>
  
    {{-- <div class="col-1"> --}}
        {{-- <p>{{$size}}</p> --}}
    {{-- </div> --}}
        
   

</div>
