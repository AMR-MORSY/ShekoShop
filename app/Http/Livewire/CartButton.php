<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartButton extends Component
{
    public $product_id;

    public $color_id;

    public $size_id ;

    public $counter;



    protected $listeners = ['colorSeletcted' => 'selectedColor', 'selectedSizeId' => 'selectedSizeId', 'counterIncremented' => 'get_incremented_counter', 'counterDecremented' => 'get_decremented_counter'];


   
    public function selectedSizeId($size_id)
    {
        $this->size_id = $size_id;
    }


    public function get_incremented_counter($counter)
    {
        $this->counter = $counter;
    }
    public function get_decremented_counter($counter)
    {
        $this->counter = $counter;
    }

    public function selectProduct()
    {

      
        $product_category = Product::find($this->product_id)->category_id;
        $category_id = Category::where('category_name', $product_category)->first()->id;


        if (Auth()->user()) {
            // $cart_product=Cart::where('user_id',Auth()->user()->id)
            // ->where('category_id',$product['category_id'])
            // ->where('product_id',$product['product_id'])
            // ->where('color_id',$product["color_id"])
            // ->where('size_id',$product['size_id'])->first();
            // if($cart_product)
            // {
            //     $this->emit('notification', 'already in the cart');

            // }
            // else{
            Cart::create([

                'category_id' => $category_id,
                'product_id' => $this->product_id,
                'color_id' => $this->color_id,
                'size_id' =>$this->size_id,
                'quantity' => $this->counter,
                'user_id' => Auth()->user()->id

            ]);
            $this->emit('productAdded');


            //  }

        } else {
            $product = [];
            $product['category_id'] =  $category_id;
            $product['product_id'] = $this->product_id;
            $product['color_id'] = $this->color_id;
            $product['size_id'] = $this->size_id;
            $product['quantity'] = $this->counter;
            $cookie_product = Cookie::get('product');
            $cookie_product = json_decode($cookie_product, true);
            // $filtered = array_filter($cookie_product, function ($val, $key) use ($product) {
            //     return $val == $product;
            // }, ARRAY_FILTER_USE_BOTH);

            // if (count($filtered) > 0) {
            //     $this->emit('notification', 'already in the cart');
            // } else {
            array_push($cookie_product, $product);

            $minutes = 42300;

            Cookie::queue('product', json_encode($cookie_product), $minutes);
            $this->emit('productAdded');
            // }

        }
    }

    public function selectedColor($color_id)
    {
        $this->color_id = $color_id;
    }
    public function mount($product, $colors = null,$sizes=null)
    {
      
        
        $this->product_id = $product;
        if ($colors == null) {
            $this->color_id = null;
        } else {
            $this->color_id = $colors[0]->id;
            if ($sizes == null) {
                $this->size_id = null;
            } else {
                $this->size_id = $sizes[$this->color_id][0]->id;
            }
           
        }

       
        $this->counter = 1;
      
    }
    public function render()
    {
        return view('livewire.cart-button');
    }
}
