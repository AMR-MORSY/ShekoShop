<div class="row">
    
    
    @foreach ($colors as $color)
    <div class="col-1" >
        <div class="colors" style="background-color: {{$color->color_code}};cursor:pointer;" wire:click="$emit('colorSeletcted','{{$color->id}}')"></div>
    </div>
        
    @endforeach
   

   
   
</div>
