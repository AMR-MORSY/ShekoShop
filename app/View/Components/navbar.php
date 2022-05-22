<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $items=Session('item');
        return view('components.navbar',["item"=>$items]);
    }
}
