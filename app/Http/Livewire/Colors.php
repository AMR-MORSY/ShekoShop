<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Colors extends Component
{
    public $colors;

   
   

    public function mount($colors)
    {
        $this->colors=$colors;
       

    }
    public function render()
    {
        return view('livewire.colors');
    }
}
