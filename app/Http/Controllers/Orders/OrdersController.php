<?php

namespace App\Http\Controllers\Orders;

use App\Models\Cart;
use App\Models\Size;
use App\Models\User;
use App\Models\Color;
use App\Models\Order;
use App\Models\State;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\order\submitOrder;

class OrdersController extends Controller
{
    public function checkout($user_id)
    {
        $products = [];
        $CartProducts = Cart::where("user_id", $user_id)->get();
        foreach ($CartProducts as $cart_product) {
            $product = Product::find($cart_product->product_id);
            $product_cart['product_name'] = $product->product_name;
            $product_cart['id'] = $cart_product->product_id;
            $product_cart['product_price'] = $product->product_price;
            $product_cart['quantity'] = $cart_product->quantity;
            if ($cart_product->color_id != null) {
                $product_color = Color::find($cart_product->color_id);
                $product_cart['color'] = $product_color->color_name;
            } else {
                $product_cart['color'] = $cart_product->color_id;
            }
            if ($cart_product->size_id != null) {
                $product_size = Size::find($cart_product->size_id);
                $product_cart['size'] = $product_size->size_name;
            } else {
                $product_cart['size'] = $cart_product->size_id;
            }
            array_push($products, $product_cart);
        }
        $user = User::find($user_id);
        $user_address = $user->address;



        return view('orders.checkout', ["cart_products" => $products, "user" => $user, "user_address" => $user_address]);
    }

    public function shipping(Request $request)
    {
        $state_id = $request->input('state_id');
        $shipping = $request->input('shipping');
        $shipping_rate = State::find($state_id)->shipping_rate;

        if ($shipping == "delivery") {

            return response([
                "message" => "success",

                "shipping_rate" => $shipping_rate
            ]);
        } else {
            return response([
                "message" => "failed",

                "shipping_rate" => $shipping_rate
            ]);
        }
    }

    private function fill_orders_table($validated)
    {
        $order = Order::create([
            "user_id" => $validated['user_id'],
            "payment_method" => $validated['payment_method'],
            "state_id" => $validated["state_id"],
            "subtotal" => $validated["subtotal"],
            "total_price" => $validated["total_price"],
            "shipping_method" => $validated["shipping_method"]


        ]);
        return $order;
    }

    private function check_quantity($quantity, $new_quantity, $i)
    {
        $error = [];
        if ($new_quantity < 0) {
            $error['index'] = $i;
            $error["message"] = "only $quantity item available.";

            return $error;
        } else {
            return $error;
        }
    }

    private function check_product_color_size_quantity($color_id, $size_id, $product_id, $product_quantity, $i)
    {
        $error = [];
        $product_size = ProductSize::where('product_id', $product_id)->where('size_id', $size_id)->where('color_id', $color_id)->first();
        $quantity = $product_size->quantity;
        $new_quantity = $quantity - $product_quantity;
        $error = $this->check_quantity($quantity, $new_quantity, $i);
        return $error;
    }

    private function check_product_quantity($product_quantity, $i, $dB_product)
    {
        $error = [];
        $product_stock = $dB_product->product_stock;
        $new_product_stock = $product_stock - $product_quantity;
        $error = $this->check_quantity($product_stock, $new_product_stock, $i);
        return $error;
    }

    // private function check_update_color_size_quantity($color_id, $size_id, $product_id, $dB_product, $product_quantity, $i,$order_id,$price)
    // {
    //     $error = [];

    //     if (count($this->check_product_qunatity($quantity, $new_quantity, $i, $dB_product)) > 0) {
    //         $error = $this->check_product_color_size_qunatity($quantity, $new_quantity, $i, $dB_product);
    //         return $error;
    //     } else {
    //         $dB_product->orders()->attach($order_id, ["quantity" =>$product_quantity, "price" => $price, "color_id" => $color_id, "size_id" => $size_id]);
    //         $product_size->quantity = $new_quantity;
    //         $product_size->save();
    //         $product_stock = $dB_product->product_stock;
    //         $new_product_stock = $product_stock - $product_quantity;
    //         $dB_product->product_stock = $new_product_stock;
    //         $dB_product->save();

    //         return $error;
    //     }
    // }

    // private function get_color_size_ids($products,$order_id)
    // {
    //     $error = [];
    //     for ($i = 0; $i < count($products); $i++) {

    //         if ($products[$i]["color"] != null and $products[$i]["size"] != null) {
    //             $color_id = Color::where("color_name", $products[$i]["color"])->first()->id;
    //             $size_id = Size::where("size_name", $products[$i]["size"])->first()->id;
    //             array_push($error, $this->update_color_size_quantity($color_id, $size_id, $products[$i]["product_id"], $dB_product, $products[$i]["quantity"], $i,$order_id,$products[$i]["price"]));
    //         } else {

    //             $product_stock = $dB_product->product_stock;
    //             $new_product_stock = $product_stock - $products[$i]['quantity'];
    //             if (count($this->check_product_qunatity($product_stock, $new_product_stock, $i, $dB_product)) > 0) {
    //              array_push($error, $this->check_product_qunatity($product_stock, $new_product_stock, $i, $dB_product));
    //             } else {
    //                 $dB_product->product_stock = $new_product_stock;
    //                 $dB_product->save();
    //             }
    //         }

    //     }
    //     return $error;
    // }

    public function order(submitOrder $request)
    {
        $errors = [];
        $validated = $request->validated();
        // return response([
        //     "data"=>$validated
        // ]);
        $products = $validated['products'];


        for ($i = 0; $i < count($products); $i++) {
            $dB_product = Product::find($products[$i]["product_id"]);

            if ($products[$i]["color"] != null && $products[$i]["size"] != null) {
                $color_id = Color::where("color_name", $products[$i]["color"])->first()->id;
                $size_id = Size::where("size_name", $products[$i]["size"])->first()->id;
                if (count($this->check_product_color_size_quantity($color_id, $size_id, $products[$i]["product_id"], $products[$i]["quantity"], $i)) > 0) {
                    array_push($errors, $this->check_product_color_size_quantity($color_id, $size_id, $products[$i]["product_id"], $products[$i]["quantity"], $i));
                }
            } else {
                if (count($this->check_product_quantity($products[$i]["quantity"], $i, $dB_product)) > 0) {
                    array_push($errors, $this->check_product_quantity($products[$i]["quantity"], $i, $dB_product));
                }
            }
        }
        if(count($errors)>0)
        {
            return response([
                "message"=>"failed",
                "errors" =>  $errors

            ]);

        }
        else
        {
        $order=$this->fill_orders_table($validated);
        return response([
            "order" => $errors,
            "message" => "success"


        ]);

         }

        // $order = $this->fill_orders_table($validated);

        // $error=$this->get_color_size_ids($validated["products"],$order->id);


    }
}
