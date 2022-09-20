<?php

namespace App\Http\Livewire\cart;

use App\Models\Cart;
use App\Models\Size;
use App\Models\User;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class SideCart extends Component
{
    public $products = [];
    public $colors = [];
    public $sizes = [];
    public $images = [];
    public $quantities = [];
    public $prices = [];
    public $Db_products;
    public $cookie_products;
    public $display = 'block';

    protected $listeners = ['productAdded',"cartCounterIncremented",'cartCounterDecremented',"hello"];

    public function hello()
    {
        $Db_products = Cart::where('user_id', Auth()->user()->id)->get();

        if (count($Db_products) > 0) {

            $this->Db_products = $Db_products;
            $this->display = 'block';

            $this->get_products($Db_products);
        } else {
            $this->products = [];

            $this->display = 'none';
        }

    }

    public function cartCounterIncremented($index,$counter)
    {
        // dd($this->sizes[$index]);
        if (Auth()->user() ) {

            if($this->sizes[$index]!=null and $this->colors[$index]!=null)
            {
                $Db_products = Cart::where('user_id', Auth()->user()->id)->where("product_id",$this->products[$index]["id"])->where("size_id",$this->sizes[$index]["id"])->where("color_id",$this->colors[$index]["id"])->first();

            }
            else
            {
                $Db_products = Cart::where('user_id', Auth()->user()->id)->where("product_id",$this->products[$index]["id"])->where("size_id",$this->sizes[$index])->where("color_id",$this->colors[$index])->first();

            }

            
            if($Db_products)
            {
                $Db_products->quantity=$counter;
                $Db_products->save();
            }
           
        }
        else
        {
            $cookie_products = Cookie::get('product');
            $cookie_products = json_decode($cookie_products, true);
            foreach($cookie_products as $product)
            {
                if($this->sizes[$index]!=null and $this->colors[$index]!=null)
                {
                    if($product["product_id"]==$this->products[$index]["id"] and $product["size_id"]==$this->sizes[$index]["id"] and $product["color_id"]==$this->colors[$index]["id"] )
                    {
                        $product["quantity"]=$counter;

                    }

                }
               else
                {
                    if($product["product_id"]==$this->products[$index]["id"] and $product["size_id"]==$this->sizes[$index] and $product["color_id"]==$this->colors[$index])
                    {
                        $product["quantity"]=$counter;

                    }
                
                }
            }
        }
        $this->quantities[$index]=$counter;
         $this->emit('CartShow');

    }

    public function cartCounterDecremented($index,$counter)
    {
        // dd($this->sizes[$index]);
        if (Auth()->user() ) {

            if($this->sizes[$index]!=null and $this->colors[$index]!=null)
            {
                $Db_products = Cart::where('user_id', Auth()->user()->id)->where("product_id",$this->products[$index]["id"])->where("size_id",$this->sizes[$index]["id"])->where("color_id",$this->colors[$index]["id"])->first();

            }
            else
            {
                $Db_products = Cart::where('user_id', Auth()->user()->id)->where("product_id",$this->products[$index]["id"])->where("size_id",$this->sizes[$index])->where("color_id",$this->colors[$index])->first();

            }

            
            if($Db_products)
            {
                $Db_products->quantity=$counter;
                $Db_products->save();
            }
           
        }
        else
        {
            $cookie_products = Cookie::get('product');
            $cookie_products = json_decode($cookie_products, true);
            foreach($cookie_products as $product)
            {
                if($this->sizes[$index]!=null and $this->colors[$index]!=null)
                {
                    if($product["product_id"]==$this->products[$index]["id"] and $product["size_id"]==$this->sizes[$index]["id"] and $product["color_id"]==$this->colors[$index]["id"] )
                    {
                        $product["quantity"]=$counter;

                    }

                }
               else
                {
                    if($product["product_id"]==$this->products[$index]["id"] and $product["size_id"]==$this->sizes[$index] and $product["color_id"]==$this->colors[$index])
                    {
                        $product["quantity"]=$counter;

                    }
                
                }
            }
        }
        $this->quantities[$index]=$counter;
        //  $this->emit('CartShow');

    }


    public function productAdded()
    {
        if (Auth()->user()) {
            $Db_products = Cart::where('user_id', Auth()->user()->id)->get();

            if (count($Db_products) > 0) {

                $this->Db_products = $Db_products;
                $this->display = 'block';
                $this->get_products($Db_products);
            } else {
                $this->products = [];
                $this->colors = [];
                $this->sizes = [];
                $this->images = [];
                $this->quantities = [];
                $this->prices = [];
                $this->display = 'none';
            }
        } else {
            $cookie_products = Cookie::get('product');
            $cookie_products = json_decode($cookie_products, true);

            if (count($cookie_products) > 0) {
                $this->display = 'block';


                $this->cookie_products = $cookie_products;
                $this->get_products($cookie_products);
            } else {
                $this->products = [];
                $this->colors = [];
                $this->sizes = [];
                $this->images = [];
                $this->quantities = [];
                $this->prices = [];
                $this->display = 'none';
            }
        }
        $this->emitTo('cart-total-price', 'update_total_price_add', $this->prices, $this->quantities);

        // $this->emit('CartShow');

    }

    public function deleteItem($index)
    {
        if (Auth()->user()) {
            $Db_product = Cart::find($this->Db_products[$index]->id);
            $Db_product->delete();

           
            // unset($this->Db_products[$index]);
            // unset($this->products[$index]);
            // $this->products = array_values($this->products);
            // if (count($this->products) == 0) {
            //     $this->display = 'none';
            // }
            // unset($this->colors[$index]);
            // $this->colors = array_values($this->colors);
            // unset($this->sizes[$index]);
            // $this->sizes = array_values($this->sizes);
            // unset($this->quantities[$index]);
            // $this->quantities = array_values($this->quantities);
            // unset($this->images[$index]);
            // $this->images = array_values($this->images);
            // unset($this->prices[$index]);
            // $this->prices = array_values($this->prices);

            $this->emitSelf("hello");

            $this->emit('productDeleted');
            $this->emitTo('cart-total-price', 'update_total_price_delete', $this->prices, $this->quantities);
          
            //  $this->emit('CartShow');
        } else {
            $Db_products = Cookie::get('product');
            $Db_products = json_decode($Db_products, true);

            unset($Db_products[$index]);
            $Db_products = array_values($Db_products);
            $minutes = 43200;

            Cookie::queue('product', json_encode($Db_products), $minutes);
            unset($this->products[$index]);
            $this->products = array_values($this->products);
            if (count($this->products) == 0) {
                $this->display = 'none';
            }
            unset($this->colors[$index]);
            $this->colors = array_values($this->colors);
            unset($this->sizes[$index]);
            $this->sizes = array_values($this->sizes);
            unset($this->quantities[$index]);
            $this->quantities = array_values($this->quantities);
            unset($this->images[$index]);
            $this->images = array_values($this->images);
            unset($this->prices[$index]);
            $this->prices = array_values($this->prices);

             $this->emit('productDeleted');
            $this->emitTo('cart-total-price', 'update_total_price_delete', $this->prices, $this->quantities);
           
            //  $this->emit('CartShow');
        }
    }




    public function submitOrder()
    {
        if (Auth()->user()) {
            $address = User::find(Auth()->user()->id)->address;

            if ($address != null) {
                return redirect()->route('checkout', ["user" => Auth()->user()->id]);
            } else {
                $this->emitTo("user.store-user-address-form", 'showStoreUserAddressForm', Auth()->user()->id);
               

            }

           


        } else {
            return redirect()->route('login');
        }
    }

    public function mount()
    {
        if (Auth()->user()) {
            $Db_products = Cart::where('user_id', Auth()->user()->id)->get();

            if (count($Db_products) > 0) {

                $this->Db_products = $Db_products;
                $this->display = 'block';

                $this->get_products($Db_products);
            } else {
                $this->products = [];

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
                $amazon_url = Storage::disk('s3')->url($image_url);
                array_push($this->images, $amazon_url);
            } else {
                array_push($this->colors, null);
                $face_image = $Db_product->facefront_image;
                $face_image_url = $face_image->url;
                $amazon_url = Storage::disk('s3')->url($face_image_url);
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


    public function render()
    {


        return view('livewire.cart.side-cart');
    }
}
