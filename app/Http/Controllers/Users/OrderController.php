<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceOrderRequest;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlaceOrderRequest $request)
    {
        $validated = $request->validated();
        $validated=collect($validated);
       
        if (auth()->user()) {
           $validated=$validated->merge(['user_id'=>auth()->user()->id]);
        } 
      
        $order = Order::create($validated->except(['cart_products'])->toArray());
        foreach($validated['cart_products'] as $product)
        {
            OrderProduct::create([
                'order_id'=>$order->id,
                'product_id' => $product['product']['id'],
                'size_id' => $product['size']['id'],
                'quantity' => $product['quantity'],
                "size_price" => $product['size_price'],
                'options' => $product['options'],
                "product_final_price" => $product['product_final_price'],
                'extra_quantity_prices' => $product['extra_quantity_prices']

            ]);
        }

        if(auth()->user())
        {
           $user_cart_products= CartProduct::where("user_id",auth()->user()->id)->get();
           $user_cart_products->delete();
        }


        return response()->json([
            'order' => $order,
            'message'=>'success'
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
