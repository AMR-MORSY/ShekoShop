<?php

namespace App\View\Components;

use Illuminate\View\Component;

class categorysellection extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     * 
     * 
     */
    public $categories,$product;

    public function __construct($categories,$product)
    {
        $this->categories=$categories;
        $this->product=$product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category-sellection');
    }
}
