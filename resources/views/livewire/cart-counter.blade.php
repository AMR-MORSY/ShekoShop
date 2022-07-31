
    <div class="d-flex justify-content-start align-items-center">
        <button style="display:flex; border:0px !important; justify-content:center ;align-items:center; width:30px;height:30px; background-color:red;color:white;" type="button" wire:click.prevent="increment({{$counter_index}})">+</button>
        <div style="height:30px; width:30px;display:flex; justify-content:center;align-items:center ; background-color:white" class="counter" >{{$counter}}</div>
        <button  style="display:flex; justify-content:center;border:0px !important ;align-items:center; width:30px;height:30px; background-color:red;;color:white;" type="button" wire:click.prevent="decrement({{$counter_index}})">-</button>
     </div>
     
