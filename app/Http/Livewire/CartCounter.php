<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartCounter extends Component
{
    public $counter;
    public $counter_index;
    //   protected $listeners=['counterIncremented'];
    //  public function counterIncremented($index)
    //  {
    //     // $this->counter++;
    //     // $this->emit('cartCounterIncremented', $this->counter,$index);
    //     // // dd($index);
    //     // $this->dispatchBrowserEvent('hello');
    //     dd('hello');
    //  }
    public function increment($index)
    {
        $this->counter++;
        $this->emit('cartCounterIncremented', $index,$this->counter);



        // $this->emit('index', $index);





    }
    public function decrement($index)
    {
        if ($this->counter > 1) {
            $this->counter--;
            $this->emit('cartCounterDecremented', $index,$this->counter);
            // $this->emit('counter_index', $index);


        }
    }


    public function mount($counter_value = null, $counter_index = null)
    {

        if ($counter_value != null) {
            $this->counter = $counter_value;
        }
        if ($counter_index != null) {
            $this->counter_index = $counter_index;
        }
    }
    public function render()
    {
        return view('livewire.cart-counter');
    }
}
