<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Categories extends Component
{
    public $categories;

    public $category;

    public function categoryChanged()

    {
        if($this->category!="")
        {
            //  dd($this->category);

             $this->emitTo('dashboard.devisions','categoryChanged',$this->category);
        }
     
    }

    public function mount($categories)
    {
        $this->categories=$categories;
    }
    public function render()
    {
        return view('livewire.dashboard.categories');
    }
}
