<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Devision;
use App\Models\Option;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;

class UsersProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
       
       
        return view("welcome");
    }

    public function search(Request $request)
    {
        if ($request->input('search')) {
            return view('pages.admin.viewProducts',['products'=>Product::filter($request->input('search'))->get()]);
         }

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Devision $devision, Category $category, Product $product)
    {
        $sizes = Size::all();
        $options = Option::all();

        return view('pages.users.Product', ['product' => $product, 'sizes' => $sizes, 'options' => $options]);
    }
    private function slug($string)
    {
        if (is_null($string)) {
            return "";
        }

        $string = trim($string);

        $string = mb_strtolower($string, "UTF-8");;

        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

        $string = preg_replace("/[\s-]+/", " ", $string);



        return $string;
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $index) //// this route is used to show the cart product in localstorage that is need to be eideted
    {

        //   $prodOptions = json_decode($prodOptions); ///////as the product options comes from json.stringfy so i decode it to chnage it to an array of objects
        $sizes = Size::all();
        $options = Option::all();


        // return view('pages.users.Product', ['product' => $product, 'sizes' => $sizes, 'options' => $options, 'size' => $size, "quantity" => $quntity, "price"=>$price,"prodOptions" => $prodOptions,"index"=>$index,"target"=>$target]);
        return view('pages.users.Product', ['product' => $product, 'sizes' => $sizes, 'options' => $options, "index" => $index, 'target' => 'cart']);
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
