<?php

namespace App\Http\Controllers\Users;

use App\Models\Size;
use App\Models\User;
use App\Models\Option;
use App\Models\Product;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnSelf;
use App\Http\Requests\AddCartProductRequest;
use App\Http\Requests\AddCartProductsRequest;
use App\Http\Requests\DeleteCartPrductRequest;

use App\Http\Requests\UpdatCartProductRequest;
use App\Http\Requests\getAuthUserCartProductsRequest;

class CartController extends Controller
{
    public function index()
    {
        return view("pages.users.Cart");
    }

    public function addCartProducts(AddCartProductsRequest $request)
    {
        $products = $request->validated();
        foreach ($products['products'] as $product) {
            CartProduct::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product['product']['id'],
                'size_id' => $product['size']['id'],
                'quantity' => $product['quantity'],
                "size_price" => $product['size_price'],
                'options' => $product['options'],
                'extra_quantity_prices' => $product['extra_quantity_prices'],
                'product_final_price' => $product['product_final_price']

            ]);
        }

        return response()->json([
            "message" => "success"
        ]);
    }

    public function addCartProduct(AddCartProductRequest $request)
    {
        $validated = $request->validated();
        CartProduct::create([
            'user_id' => Auth::user()->id,
            'product_id' => $validated['product']['id'],
            'size_id' => $validated['size']['id'],
            'quantity' => $validated['quantity'],
            "size_price" => $validated['size_price'],
            'options' => $validated['options'],
            "product_final_price" => $validated['product_final_price'],
            'extra_quantity_prices' => $validated['extra_quantity_prices']

        ]);
        return response()->json(
            [
                "message" => 'success'
            ]
        );
    }

    public function authUserCartProducts()
    {
       
        

        $cartProducts = CartProduct::relations(auth()->user()->id)->get();
        return  $cartProducts;
     


    }

    public function getAuthUserCartProducts(getAuthUserCartProductsRequest $request)
    {
        

        $products = $this->authUserCartProducts();

        return response()->json([
            "products" => $products
        ]);
    }
    public function updateCartProduct(UpdatCartProductRequest $request, CartProduct $cartProduct)
    {
        $validated = $request->validated();
        $cartProduct->update(
            [
                'product_id' => $validated['product']['id'],
                'size_id' => $validated['size']['id'],
                'quantity' => $validated['quantity'],
                "size_price" => $validated['size_price'],
                'options' => $validated['options'],
                "product_final_price" => $validated['product_final_price'],
                'extra_quantity_prices' => $validated['extra_quantity_prices']
            ]
        );
        return response()->json([
            "message" => "success"

        ]);
    }

    public function delete(DeleteCartPrductRequest $request, CartProduct $cartProduct)
    {
        $cartProduct->delete();
        return response()->json([
            "message" => "success"
        ]);
    }
}
