<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{
    protected $listeners = ['product' => 'getProduct'];

    public function getProduct($product)
    {
        dd($product);
       

    }
 
 
 
 
 
 
 
 
 
 
    public function render()
    {
        return view('livewire.cart');
    }
}
