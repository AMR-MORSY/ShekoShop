<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Type;
use App\Models\Color;
use App\Models\Product;

use App\Models\Category;
use App\Models\Devision;
use Illuminate\Http\Request;
use App\Models\ProductFacefrontImage;
use App\Http\Requests\Products\StoreProductRequest;

class DashboardController extends Controller
{
    public function index()

    {
        $categories=Category::all();
        $types=Type::all();
        $devisions=Devision::all();
        // $colors=Color::all();
        // $sizes=Size::all();
        return view('dashboard',['categories'=>$categories,'devisions'=>$devisions,'types'=>$types]);
    }
    
    private function add_facefront_image($product_id, $image)
    {
        $path = $image->store('Products', 's3');
        ProductFacefrontImage::create([
            'url' => $path,
            'product_id' => $product_id


        ]);
    }
    public function store(StoreProductRequest $request)
    {

        $validated = $request->validated();
        // dd($validated);
        $product = Product::create([
            // "product_SKU"=>$validated['product_SKU'],
            'product_name' => $validated['product_name'],
            'product_price' => $validated['product_price'],
            'product_weight' => $validated['product_weight'],
            'product_cartDesc' => $validated['product_cartDesc'],
            'product_shortDesc' => $validated['product_shortDesc'],
            'product_longDesc' => $validated['product_longDesc'],
            'product_thumb' => $validated['product_thumb'],
            'category_id' => $validated['category_id'],
            'devision_id' => $validated['devision_id'],
            'type_id' => $validated['type_id'],
            // 'product_stock' => $this->calculate_product_stock($validated['size'],$validated['quantity']),
            'product_live' => $validated['product_live'],
            'product_location' => $validated['product_location'],
        ]);
        // $color_prod_size = $this->fill_color_prod_size_table(null, null, $validated['size'], $validated['color'], $validated['quantity'], $product->id);
        // if (count($color_prod_size) > 0) {
        //     // dd($color_prod_size);
        //     return redirect()->back()->with(['quantity_errors' => $color_prod_size]);
        // } else {
            

            $this->add_facefront_image($product->id, $validated['facefront_image']);
            // $this->fill_color_product_pivot(null, $validated['color'], $product->id);
            // $this->fill_color_images_table(null, null, $validated['images'], $validated['color'], $product->id);
            return back()->with('product_status', 'product inserted successfully');
        // }
    }

}
