<?php

namespace App\Http\Livewire\Editproduct;

use Livewire\Component;

class Categories extends Component
{
    public $categories;
    public $product;
    public $product_category;


    public function categoryChanged()

    {
        if ($this->product_category != "") {

            $this->emitTo('editproduct.devisions', 'categoryChanged', $this->product_category);
        }
    }

    public function mount($categories, $product)
    {
        $this->categories = $categories;
        $this->product = $product;
        foreach($categories as $category)
        {
            if ($category->category_name==$product->category_id)
            {
                $this->product_category=$category->category_name;
              
            }
        }
    }
    public function render()
    {
        return view('livewire.editproduct.categories');
    }
}
