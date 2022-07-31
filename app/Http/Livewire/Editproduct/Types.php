<?php

namespace App\Http\Livewire\Editproduct;

use Livewire\Component;

class Types extends Component
{
    public $types;
    public $product;
    public function mount($types,$product)
    {
        $this->types=$types;
        $this->product=$product;

    }
    public function render()
    {
        return view('livewire.editproduct.types');
    }
}
