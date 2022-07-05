<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartButton extends Component
{
    public $product_id;

    public $color_name;

    public $size_name;

    

    protected $listeners=['colorSeletcted'=>'selectedColor','selectedSizeName'=>'selectedSizeName'];

    public function selectedSizeName($size_name)
    {
        $this->size_name=$size_name;
       
    }

    public function selectProduct()
    {
        if($this->size_name==null)
        {
            $this->emit('notification','please select size');

        }
        else
        {
            $this->emit('notification');
            $product=[];
            $product['product_id']=$this->product_id;
            $product['color_name']= $this->color_name;
            $product['size_name']=$this->size_name;
            $this->emit('product',$product);

        }
      

      
      
      

      


    }

    public function selectedColor($color_name)
    {
        $this->color_name=$color_name;

    }
    public function mount($product, $colors)
    {
        $this->product_id=$product;
        $this->color_name=$colors->color_name;
       
    }
    public function render()
    {
        return view('livewire.cart-button');
    }
}
