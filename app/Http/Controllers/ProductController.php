<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ColorProduct;
use App\Models\Image;
use App\Models\OptionGroup;
use App\Models\ProductFacefrontImage;
use App\Models\ProductSize;
use App\Models\Size;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
    /*
     calculating product stock
     */
    private function calculate_product_stock($sizes)
    {
        $count = 0;
        for ($i = 0; $i < count($sizes); $i++) {
            $arr = explode(',', $sizes[$i][0], 200);
            $count = $count + count($arr);
        }
        return $count;
    }
    /**
     * filling color-product pivot table
     * 
     */
    private function fill_color_product_pivot($colors, $product_id)
    {
        foreach ($colors as $color) {
            ColorProduct::create([
                'color_id' => $color,
                'product_id' => $product_id
            ]);
        }
    }
    /**
     * filling color-product-size table
     * 
     */
    private function fill_color_prod_size_table($sizes, $colors, $product_id)
    {
        for ($i = 0; $i < count($sizes); $i++) {
            $arr = explode(',', $sizes[$i][0], 200);
            foreach ($arr as $arry) {
                ProductSize::create([
                    'color_id' => $colors[$i],
                    'product_id' => $product_id,
                    'size_id' => $arry
                ]);
            }
        }
    }
    /**
     * filling color images table
     * 
     */
    private function fill_color_images_table($images, $colors, $product_id)
    {
        for ($i = 0; $i < count($images); $i++) {
            $first_array = $images[$i];
            foreach ($first_array as $second_array) {
                foreach ($second_array as $arry) {
                    $path = $arry->store('Products', 's3');
                    Image::create([
                        'url' => $path,
                        'product_id' => $product_id,
                        'color_id' => $colors[$i],
                    ]);
                }
            }
        }
    }


    /**
     * Adding facefront image inside facefront image table
     * 
     */

    private function add_facefront_image($product_id, $image)
    {
        $path = $image->store('Products', 's3');
        ProductFacefrontImage::create([
            'url' => $path,
            'product_id' => $product_id


        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {



        $validated = $request->validated();
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
            'product_stock' => $this->calculate_product_stock($validated['size']),
            'product_live' => $validated['product_live'],
            'product_location' => $validated['product_location'],



        ]);

        $this->add_facefront_image($product->id, $validated['facefront_image']);
        $this->fill_color_product_pivot($validated['color'], $product->id);
        $this->fill_color_prod_size_table($validated['size'], $validated['color'], $product->id);
        $this->fill_color_images_table($validated['images'], $validated['color'], $product->id);


        return back()->with('product_status', 'product inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    private function get_product($id)
    {
        $product = Product::find($id);
        return $product;
    }
    private function get_prod_associated_colors($product)
    {
        $colors = $product->colors;
        return $colors;
    }

    private function get_colors_asscociated_sizes($colors, $product_id)
    {
        $sizes = [];
        $color_sizes_bag = [];

        foreach ($colors as $color) {
            $color_sizes = ProductSize::where([['product_id', $product_id], ['color_id', $color->id]])->get();
            $size_names = [];
            foreach ($color_sizes as $color_size) {
                $size_name = Size::find($color_size->id)->size_name;

                array_push($size_names, $size_name);
            }
            $color_sizes_bag[$color->color_name] = $size_names;
        }
        array_push($sizes, $color_sizes_bag);

        return $sizes;
    }
    private function get_colors_associated_images($colors, $product_id)
    {
        $color_images_bag=[];
        $images=[];
        foreach ($colors as $color) {
            $color_images = Image::where([['product_id', $product_id], ['color_id', $color->id]])->get();
            $image_urls = [];
            foreach ($color_images as $color_image) {
                $image_url = $color_image->url;
                $amazon_url = Storage::url($image_url);
                array_push($image_urls, $amazon_url);
            }
            $color_images_bag[$color->color_name] = $image_urls;
        }
        array_push($images, $color_images_bag);

        return $images;

    }
    private function get_prod_facefront_image($product)
    {
        $face_image = $product->facefront_image;
        $face_image_url = $face_image->url;
        $amazon_url = Storage::url($face_image_url);
        return $amazon_url;
    }
    public function show(Request $request, $product_id)
    {

        $id = ['product_id' => $product_id];
        $validator = Validator::make($id, ['product_id' => 'required|exists:products,id']);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $validated = $validator->validated();

            $product = $this->get_product($validated['product_id']);
            $face_front_url = $this->get_prod_facefront_image($product);

            $prod_assciated_colors = $this->get_prod_associated_colors($product);
            $colors_asscociated_sizes = $this->get_colors_asscociated_sizes($prod_assciated_colors, $product->id);
            $colors_associated_images=$this->get_colors_associated_images($prod_assciated_colors,$product->id);

            dd($colors_associated_images);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
