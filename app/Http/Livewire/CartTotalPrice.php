<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartTotalPrice extends Component
{
    public $price;
   
    public $prices;

    protected $listeners=['cartCounterIncremented','cartCounterDecremented','update_total_price_add','update_total_price_delete'];

    public function cartCounterIncremented($index)
    {
      $this->price=$this->price+$this->prices[$index];
      return $this->price;
    }
    public function cartCounterDecremented($index)
    {
        $this->price=$this->price-$this->prices[$index];
        return $this->price;
    }

    public function update_total_price_add($prices,$quantities)
    {
        $this->price=0;

        $this->prices=$prices;

       for($i=0;$i<count($prices);$i++)
        {
            $quant_price=$prices[$i]*$quantities[$i];
            $this->price=$this->price+$quant_price;

        }

        return $this->price;
      

    }

    public function update_total_price_delete($prices,$quantities)
    {
        $this->price=0;

        $this->prices=$prices;

       for($i=0;$i<count($prices);$i++)
        {
            $quant_price=$prices[$i]*$quantities[$i];
            $this->price=$this->price+$quant_price;

        }

        return $this->price;
      

    }

    public function mount($prices,$quantities)
    {
        $this->price=0;

        $this->prices=$prices;

       for($i=0;$i<count($prices);$i++)
        {
            $quant_price=$prices[$i]*$quantities[$i];
            $this->price=$this->price+$quant_price;

        }

        return $this->price;
      

    }
    public function render()
    {
        return view('livewire.cart-total-price');
    }
}
