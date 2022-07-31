<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Category;
use App\Models\Devision;
use Livewire\Component;

class Devisions extends Component
{
    public $devisions;
     public $devision;

    protected $listeners=['categoryChanged'];

    public function categoryChanged($category)
    {
       
        $id=Category::where('category_name',$category)->first()->id;
        $devisions=Devision::where('category_id',$id)->get();
        $this->devisions=$devisions;
    }

    public function mount($devisions)
    {
        $this->devisions=$devisions;
    }
    public function render()
    {
        return view('livewire.dashboard.devisions');
    }
}
