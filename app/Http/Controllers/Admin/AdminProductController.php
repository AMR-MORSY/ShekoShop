<?php

namespace App\Http\Controllers\Admin;


use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use App\Http\Resources\ProductResource;
use App\Models\Devision;
use App\Services\StoreImage;
use Illuminate\Support\Facades\Session;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {

        $products = Product::all();
      

        return view('pages.admin.viewProducts')->with(["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        $displayAttribute=true;

        return view("pages.admin.createProduct", ["displayAttribute"=>$displayAttribute]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {


        $validated = $request->safe()->except(['images']);
        $product = Product::create($validated);
      $storeImage=new StoreImage($request,$product,'App\Models\Product');
      $storeImage->storeImage();
        return redirect()->route('product.show', ['product' => $product->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        return view('pages.admin.viewProduct')->with(["product" => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
       $devisions=Devision::all();
       $displayAttribute=false;
       if($product->category->devision->id==1)
       {
        $displayAttribute=true;
       }

        return view('pages.admin.createProduct')->with(["displayAttribute"=>$displayAttribute,'product' => $product, "categories" => $categories,'devisions'=>$devisions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();


        $product->update($validated);
        $product->save();

        return redirect()->route('product.show', ["product" => $product->id])->with('status', 'Updated Succefully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
