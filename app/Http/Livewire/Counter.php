<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $counter = 0;
    public $counter_index;
    
    public function increment()
    {
        $this->counter++;

        $this->emit('counterIncremented', $this->counter);
      
        // $this->emit('index', $index);





    }
    public function decrement()
    {
        if ($this->counter > 0) {
            $this->counter--;
            $this->emit('counterDecremented', $this->counter);
            // $this->emit('counter_index', $index);


        }
    }

   
    public function mount($counter_host = null, $counter_value = null, $counter_index = null)
    {
        if ($counter_host == 'product_details') {
            $this->counter = 1;
        }
        if ($counter_value != null) {
            $this->counter = $counter_value;
        }
        if ($counter_index != null) {
            $this->counter_index = $counter_index;
        }
    }
    public function render()
    {
        return view('livewire.counter');
    }
}
