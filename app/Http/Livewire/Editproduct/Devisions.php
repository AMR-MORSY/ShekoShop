<?php

namespace App\Http\Livewire\Editproduct;

use Livewire\Component;
use App\Models\Category;
use App\Models\Devision;

class Devisions extends Component
{
    public $devisions;
    public $product;

    protected $listeners=['categoryChanged'];

    public function categoryChanged($category)
    {
       
        $id=Category::where('category_name',$category)->first()->id;
        $devisions=Devision::where('category_id',$id)->get();
        $this->devisions=$devisions;
    }


    public function mount($product)
    {
      
        $this->product=$product;

        $category=Category::where('category_name',$product->category_id)->first();
        $this->devisions=$category->devisions;

    }
    public function render()
    {
        return view('livewire.editproduct.devisions');
    }
}
