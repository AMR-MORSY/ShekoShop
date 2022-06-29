<?php

namespace App\View\Components;

use Illuminate\View\Component;

class sellection extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $categories;
    public $product;
    public function __construct($categories,$product)
    {
    
            $this->categories=$categories;
            $this->product=$product;
    }

    public function isSelected($value)
    {
        if($value == $this->product->category_id)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sellection');
    }
}
