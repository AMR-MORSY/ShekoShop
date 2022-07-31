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
            $products=Cart::where('user_id',Auth()->user()->id)->get();
            if(count($products)>0)
            {
                $this->counter=count($products);

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

    protected $listeners=['productAdded'=>'productAdded'];

    public function productAdded()
    {
        if(Auth()->user())
        {
            $products=Cart::where('user_id',Auth()->user()->id)->get();
            if(count($products)>0)
            {
                $this->counter=count($products);

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
