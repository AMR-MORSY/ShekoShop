<?php

namespace App\Http\Controllers\Users;

use App\Models\Size;
use App\Models\Option;
use App\Models\Product;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddCartProductRequest;
use App\Http\Requests\DeleteCartPrductRequest;
use App\Http\Requests\UpdatCartProductRequest;
use App\Http\Requests\getAuthUserCartProductsRequest;

use function PHPUnit\Framework\returnSelf;

class CartController extends Controller
{
    public function index()
    {
        return view("pages.users.Cart");
    }


    public function addCartProduct(AddCartProductRequest $request)
    {
        $validated = $request->validated();

        CartProduct::create([
            'user_id'=>Auth::user()->id,
            'product_id'=>$validated['product']['id'],
            'size_id'=>$validated['size']['id'],
            'quantity'=>$validated['quantity'],
            "product_price"=>$validated['price'],
            'options'=>$validated['options']

        ]);
        return response()->json(
            [
                "message"=>'success'
            ]
        );

    }

    public function getAuthUserCartProducts(getAuthUserCartProductsRequest $request)
    {
        $cartProducts=CartProduct::where('user_id',Auth::user()->id)->get();
        $products=[];
        if(count($cartProducts)>0)
        {
            foreach($cartProducts as $product)
            {
                $newProd=[];
                $newProd['id']=$product->id;
                $newProd['price']=$product->product_price;
                $newProd['product']=Product::find($product->product_id);
                $newProd['product']['images']=Product::find($product->product_id)->images;
                $newProd['size']=Size::find($product->size_id);
                $newProd['quantity']=$product->quantity;
                $newProd['options']=$product->options;
                array_push($products,$newProd);
            }

        }
        return response()->json([
            "products"=>$products
        ]);

    }
    public function updateCartProduct(UpdatCartProductRequest $request, CartProduct $cartProduct)
    {
        $validated=$request->validated();
        $cartProduct->update(
            [
                'product_id'=>$validated['product']['id'],
                'size_id'=>$validated['size']['id'],
                'quantity'=>$validated['quantity'],
                "product_price"=>$validated['price'],
                'options'=>$validated['options']
            ]);
        return response()->json([
            "message"=>"success"

        ]);

    }

    public function delete(DeleteCartPrductRequest $request,CartProduct $cartProduct)
    {
        $cartProduct->delete();
        return response()->json([
            "message"=>"success"
        ]);
    }
}
