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
use Illuminate\Support\Facades\Session;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {

        $products = Product::all();
        // if(Cookie::get('cartCount'))
        // {
        //       $cartCount=Cookie::get('cartCount');

        // }
        // else{
        //     $cartCount=0;
        // }

        return view('pages.admin.viewProducts')->with(["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view("pages.admin.createProduct", ["categories" => $categories]);
    }

    private function storeImage($request, $product)
    {
        foreach ($request->file('images') as $image) {
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs(
                'public/images',
                $imageName,
                'local'

            );

            $image = Image::create([
                "name" => $imageName,
                "path" => Config::get("app.url") . "/" . "storage/images/$imageName",
                "product_id" => $product->id,

            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {


        $validated = $request->safe()->except(['images']);
        $product = Product::create($validated);
        $this->storeImage($request, $product);

        return redirect()->route('product.show', ['product' => $product->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        return view('pages.admin.viewProduct')->with(["product" => $product]);
    }


    public function cart(Request $request)
    {
        Session::put('id',$request->input('id'));
        return back();
        // $data = [
        //     "name" => "amr",
        //     "age" => "40"
        // ];

        // $value = Cookie::get('cartCount');
        // if ($value) {
        //     json_decode($value);

            
        //     foreach ($data as $item) {
        //         array_push($value, $item);
        //     }
        //     $cookie =  Cookie::make('cartCount',json_encode( $value), time() * 360 * 60);
        // } else {
        //     $cookie =  Cookie::make('cartCount',json_encode($data) , time() * 360 * 60);
        // }



        // return back()->cookie($cookie);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('pages.admin.createProduct')->with(['product' => $product, "categories" => $categories]);
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
