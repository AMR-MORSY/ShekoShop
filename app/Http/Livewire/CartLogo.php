<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class CartLogo extends Component
{
    public $counter;
    public function mount()
    {
        if(Auth()->user())
        {
            $products=Cart::where('user_id',Auth()->user()->id)->where('product_live',1)->get();

            $count=count($products);
            if($count>0)
            {
                $this->counter=$count;

            }
            else
            {
                $this->counter=0;

            }
        }
        else{
            $product=Cookie::get('product');
            if($product)
            {
                $product=json_decode($product,true);
                $this->counter=count($product);
    
            }
            else
            {
                $this->counter=0;
            }

        }
      

    }

    protected $listeners=['productAdded'=>'productAdded','productDeleted'];

    // public function CartShow()
    // {
    //     $this->emit('CartShow');
    // }

    public function productDeleted()
    {
        $this->productAdded();
    }
    public function productAdded()
    {
        if(Auth()->user())
        {
            $products=Cart::where('user_id',Auth()->user()->id)->where('product_live',1)->get();

            $count=count($products);
            if($count>0)
            {
                $this->counter=$count;

            }
            else
            {
                $this->counter=0;

            }
        }
        else{
            $product=Cookie::get('product');
            if($product)
            {
                $product=json_decode($product,true);
                $this->counter=count($product);
    
            }
            else
            {
                $this->counter=0;
            }

        }
        
      

    }
    public function render()
    {
        return view('livewire.cart-logo');
    }
}
