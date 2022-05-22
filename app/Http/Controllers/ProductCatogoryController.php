<?php

namespace App\Http\Controllers;

use App\Models\Product_Catogory;
use App\Http\Requests\StoreProduct_CatogoryRequest;
use App\Http\Requests\UpdateProduct_CatogoryRequest;
use Illuminate\Support\Facades\Session;

class ProductCatogoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProduct_CatogoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct_CatogoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product_Catogory  $product_Catogory
     * @return \Illuminate\Http\Response
     */
    public function show(Product_Catogory $product_Catogory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_Catogory  $product_Catogory
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_Catogory $product_Catogory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProduct_CatogoryRequest  $request
     * @param  \App\Models\Product_Catogory  $product_Catogory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduct_CatogoryRequest $request, Product_Catogory $product_Catogory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_Catogory  $product_Catogory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_Catogory $product_Catogory)
    {
        //
    }
}
