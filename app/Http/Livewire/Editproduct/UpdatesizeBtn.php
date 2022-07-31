<?php

namespace App\Http\Livewire\Editproduct;

use Livewire\Component;

class UpdatesizeBtn extends Component
{
    public $color_id,$color_quantities,$filtered_sizes;

    public function mount($color_id,$color_quantities,$filtered_sizes)
    {
        $this->color_id=$color_id;
        $this->filtered_sizes=$filtered_sizes;
        $this->color_quantities=$color_quantities;
       

    }

    public function update_size()
    {
        $this->emitTo('editproduct.updatesize','update_size',$this->color_id, $this->filtered_sizes, $this->color_quantities);
    }
    public function render()
    {
        return view('livewire.editproduct.updatesize-btn');
    }
}
