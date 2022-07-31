<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Types extends Component
{
    public $types;
     public $type;

    public function mount($types)
    {
        $this->types=$types;
    }
    public function render()
    {
        return view('livewire.dashboard.types');
    }
}
