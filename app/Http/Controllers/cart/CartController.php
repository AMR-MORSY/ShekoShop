<?php

namespace App\Http\Controllers\cart;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\cart\deleteCart;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller

{
    public function add_product(Request $request)
    {
        $size = $request->input('size');
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $color = $request->input('color');

        $product_category = Product::find($product_id)->category_id;
        $category_id = Category::where('category_name', $product_category)->first()->id;


        if (Auth()->user()) {

            $cart_products = Cart::where('user_id', Auth()->user()->id)->where('product_id', $product_id)->where('color_id', $color)->where('size_id', $size)->first();
            if ($cart_products) {
                $product_quantity = $cart_products->quantity;
                $new_quantity = $product_quantity + $quantity;
                $cart_products->quantity = $new_quantity;
                $cart_products->save();

                return response(["success" => true]);
            } else {
                Cart::create([

                    'category_id' => $category_id,
                    'product_id' => $product_id,
                    'color_id' => $color,
                    'size_id' => $size,
                    'quantity' => $quantity,
                    'user_id' => Auth()->user()->id

                ]);
                return response(["success" => true]);
            }
        } else {
            $product = [];
            $product['category_id'] =  $category_id;
            $product['product_id'] = $product_id;
            $product['color_id'] = $color;
            $product['size_id'] = $size;
            $product['quantity'] = $quantity;
            $cookie_products = Cookie::get('product');
            $cookie_products = json_decode($cookie_products, true);

            $count = count($cookie_products);

            if ($count == 0) {
                array_push($cookie_products, $product);
                $minutes = 42300;

                Cookie::queue('product', json_encode($cookie_products), $minutes);
                return response([
                    "success" => true,
                    "product" => $cookie_products
                ]);
            } else {
                $found=false;
                
                foreach ($cookie_products as $key=> $cookie) {
                    
                    if ($cookie['category_id'] == $product['category_id'] and $cookie['product_id'] == $product['product_id'] and $cookie['color_id'] == $product['color_id'] and $cookie['size_id'] == $product['size_id']) {
                        $old_quantity=$cookie_products[$key]['quantity'];
                        $cookie_products[$key]['quantity'] = $product['quantity'] +$old_quantity;
                        $found=true;
                    }
                }
                if($found)
                {
                    $minutes = 42300;

                    Cookie::queue('product', json_encode($cookie_products), $minutes);
                    return response([
                        "success" => true,
                       
                    ]);

                }
                else
                {
                    array_push($cookie_products, $product);
                    $minutes = 42300;

                    Cookie::queue('product', json_encode($cookie_products), $minutes);
                    return response([
                        "success" => true,
                        
                    ]);

                }
              
            }
        }
    }
    public function submitOrder()
    {
        if (Auth()->user()) {
            $address = User::find(Auth()->user()->id)->address;

            if ($address != null) {

                return response([
                    "route" => 'checkout',
                    "user_id" => Auth()->user()->id

                ]);

                // return redirect()->route('checkout', ["user" => Auth()->user()->id]);
            } else {

                return response([
                    "route" => 'store-user-address-form',
                    "user_id" => Auth()->user()->id

                ]);
                // $this->emitTo("user.store-user-address-form", 'showStoreUserAddressForm', Auth()->user()->id);


            }
        } else {
            return response([
                "route" => 'login',


            ]);
            // return redirect()->route('login');
        }
    }

    public function delete_product(deleteCart $request)
    {
        $validated = $request->validated();

        if (Auth()->user()) {
            $Db_product = Cart::where('user_id', Auth()->user()->id)->where('color_id', $validated['color'])->where('product_id', $validated['product_id'])->where('size_id', $validated['size'])->where('quantity', $validated['quantity'])->first();

            if ($Db_product) {
                $Db_product->delete();

                $Db_products = Cart::where('user_id', Auth()->user()->id)->get();

                $count_Db_products = $Db_products->count();

                return response([
                    "message" => "success",
                    "CountDBProducts" => $count_Db_products
                ]);
            }
        } else {
            $category_name = Product::find($validated['product_id'])->category_id;
            $category_id = Category::where('category_name', $category_name)->first()->id;

            $product = [];
            $product['category_id'] =  $category_id;
            $product['product_id'] = $validated['product_id'];
            $product['color_id'] = $validated['color'];
            $product['size_id'] = $validated['size'];
            $product['quantity'] = $validated['quantity'];
            $cookie_products = Cookie::get('product');
            $cookie_products = json_decode($cookie_products, true);

            $filtered_products = array_filter($cookie_products, function ($element, $key) use ($product) {
                return $element != $product;
            }, ARRAY_FILTER_USE_BOTH);

            $minutes = 42300;

            Cookie::queue('product', json_encode($filtered_products), $minutes);

            $count_Cookie_products = count($filtered_products);

            return response([
                "message" => "success",
                "CountDBProducts" => $count_Cookie_products
            ]);
        }
    }
}
