<?php

namespace App\View\Components;

use App\Models\Cart;
use App\Models\Size;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class SideCart extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     * 
     * 
     */

    public $products = [];
    public $colors = [];
    public $sizes = [];

    public $deactivated_products = [];
    public $deactivated_colors = [];
    public $deactivated_sizes = [];

    public $images = [];
    public $quantities = [];
    public $prices = [];
   
   
    public $display = 'block';
    
    public function __construct()
    {
       
        $deactivated_products=[];
        $dataBase_products=[];
        if (Auth()->user()) {
            $Db_products = Cart::where('user_id', Auth()->user()->id)->get();

            $count=count($Db_products);

            if ($count > 0) {

                foreach($Db_products as $product)
                {
                    if($product->product_live==0)
                    {
                        array_push($deactivated_products,$product);
                    }
                    else{
                        array_push($dataBase_products ,$product);
                    }
                }

                $count_db_products=count($dataBase_products);
                if($count_db_products>0)
                {
                    $this->get_products($dataBase_products);
                    $this->display = 'block';

                }
                if(count($deactivated_products)>0)
                {
                    $this->get_deactivated_products($deactivated_products);
                    $this->display = 'none';
                }
                else
                {
                  

                    $this->display = 'none';

                }
               
            } else {
               

                $this->display = 'none';
            }
        } else {
            $cookie_products = Cookie::get('product');
            $cookie_products = json_decode($cookie_products, true);

            if (count($cookie_products) > 0) {
                $this->display = 'block';
                // $cookie_products = collect($cookie_products);
                $this->cookie_products = $cookie_products;
                $this->get_products($cookie_products);
            } else {
                $this->products = [];
                $this->display = 'none';
            }
        }
       
    }

    private function get_deactivated_products($deactivated_products)
    {
        foreach ($deactivated_products as $product) {
            $Db_product = Product::find($product['product_id']);
            array_push($this->deactivated_products, $Db_product);
          
            $Db_color = Color::find($product['color_id']);
            if ($Db_color) {
                array_push($this->deactivated_colors, $Db_color);
              
            } else {
                array_push($this->deactivated_colors, null);
             
            }
            $Db_size = Size::find($product['size_id']);
            if ($Db_size) {
                array_push($this->deactivated_sizes, $Db_size);
            } else {
                array_push($this->sizes, null);
            }
          
        }

    }
    
    private function get_products($Db_products)
    {
        $this->products = [];
        $this->colors = [];
        $this->sizes = [];
        $this->images = [];
        $this->quantities = [];
        $this->prices = [];
        foreach ($Db_products as $product) {
            $Db_product = Product::find($product['product_id']);
            array_push($this->products, $Db_product);
            array_push($this->prices, $Db_product['product_price']);
            $Db_color = Color::find($product['color_id']);
            if ($Db_color) {
                array_push($this->colors, $Db_color);
                $color_image = Image::where([['product_id', $product['product_id']], ['color_id', $product['color_id']]])->first();
                $image_url = $color_image->url;
                $amazon_url = Storage::url($image_url);
                array_push($this->images, $amazon_url);
            } else {
                array_push($this->colors, null);
                $face_image = $Db_product->facefront_image;
                $face_image_url = $face_image->url;
                $amazon_url = Storage::url($face_image_url);
                array_push($this->images, $amazon_url);
            }
            $Db_size = Size::find($product['size_id']);
            if ($Db_size) {
                array_push($this->sizes, $Db_size);
            } else {
                array_push($this->sizes, null);
            }
            array_push($this->quantities, $product['quantity']);
        }
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.side-cart');
    }
}
