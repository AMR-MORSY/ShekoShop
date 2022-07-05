<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class AddProductColor extends Component
{



    public $sizes, $colors;

    public $color_sets = [0];

    public $set = 0;

    protected $listeners = ['addColor' => 'addColor'];

    public function mount($sizes, $colors)
    {
        $this->sizes = $sizes;
        $this->colors = $colors;
    }

   
   
   
   
   

    public function addColor()
    {
        $this->set++;
        array_push($this->color_sets, $this->set);
    }



    public function render()
    {
        return view('livewire.add-product-color');
    }
}
