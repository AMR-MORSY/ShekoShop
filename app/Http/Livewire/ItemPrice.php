<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ItemPrice extends Component
{
    public $price;

    public $index;

    public $initial_price;

    protected $listeners=['cartCounterIncremented','cartCounterDecremented'];

    public function cartCounterIncremented($index)
    {
       if($index==$this->index)
       {
        $this->price= ($this->price) + ($this->initial_price);
       }
    }
    public function cartCounterDecremented($index)
    {
       if($index==$this->index)
       {
        $this->price= ($this->price) - ($this->initial_price);
       }
    }



    public function mount($price,$index,$quantity)
    {
        $this->initial_price=$price;
        $this->price=$price*$quantity;
        $this->index=$index;
    }
    public function render()
    {
        return view('livewire.item-price');
    }
}
