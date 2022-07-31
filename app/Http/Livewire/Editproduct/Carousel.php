<?php

namespace App\Http\Livewire\Editproduct;

use Livewire\Component;

class Carousel extends Component
{
    public $product_id,$color_id,$images_ids,$images_urls;

    public function mount($product_id,$color_id,$images_ids,$images_urls)
    {
        $this->product_id=$product_id;
        $this->color_id=$color_id;
        $this->images_ids=$images_ids;
        $this->images_urls=$images_urls;

    }
    public function render()
    {
        return view('livewire.editproduct.carousel');
    }
}
