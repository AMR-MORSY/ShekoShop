<?php

namespace App\Http\Controllers\Products;

use App\Http\Requests\Products\AddProductColor;
use App\Models\Size;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\OptionGroup;
use App\Models\ProductSize;
use App\Models\ColorProduct;
use App\Http\Controllers\Controller;

use App\Models\ProductFacefrontImage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateColorSize;
use App\Http\Requests\Products\UpdateFacefrontImage;
use App\Models\Devision;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $product_Stock = 0;
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
    // private function calculate_product_stock($sizes, $quantities)
    // {
    //     $count = 0;

    //     for ($i = 0; $i < count($sizes); $i++) {
    //         $arr = explode(',', $sizes[$i], 200);
    //         foreach ($arr as $arry) {
    //             if ($quantities[$i][$arry - 1] > 0) {
    //                 $count = $count + $quantities[$i][$arry - 1];
    //             }
    //         }
    //     }
    //     return $count;
    // }
    /** @var \Illuminate\Filesystem\FilesystemManager $disk */
    /**
     * filling color-product pivot table
     * 
     */

    /**
     * filling color-product-size table
     * 
     */

    /**
     * filling color images table
     * 
     */



    // public function add_product_color(AddProductColor $request)
    // {
    //     $validated = $request->validated();

    //     if (!$request->file('images')) {
    //         return back()->withErrors(['images' => 'please upload images']);
    //     } else {

    //         for ($i = 0; $i < count($validated['color']); $i++) {
    //             $exist_color = $this->check_if_color_in_pivote_table($validated['color'][$i], $validated['product_id']);
    //             if ($exist_color != null) {
    //                 return back()->withErrors(['exist_color' => $exist_color . " color already exists"]);
    //             } else {
    //                 // dd($validated['color'][$i]);
    //                 $this->fill_color_product_pivot($validated['color'][$i], null, $validated['product_id']);
    //                 $this->fill_color_prod_size_table($validated['color'][$i], $validated['size'][$i], null, null, null, $validated['product_id']);

    //                 $this->fill_color_images_table($validated['images'][$i], $validated['color'][$i], null, null, $validated['product_id']);
    //                 session()->flash('message', 'color addedd');
    //                 return back();
    //             }
    //         }
    //     }
    // }


    /**
     * Adding facefront image inside facefront image table
     * 
     */



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function update_color_size(UpdateColorSize $request)
    // {
    //     $validated = $request->validated();

    //     $arr = explode(',', $validated['size'], 200);

    //     $sizes = ProductSize::where('product_id', $validated['product'])->where('color_id', $validated['color'])->get();
    //     foreach ($sizes as $size) {
    //         $size->delete();
    //     }

    //     for ($i = 0; $i < count($arr); $i++) {
    //         ProductSize::create([
    //             'color_id' => $validated['color'],
    //             'product_id' => $validated['product'],
    //             'size_id' => $arr[$i]
    //         ]);
    //     }
    //     return back()->with('sizes_updated', 'Sizes Updated Successfully');
    // }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */


    private function get_prod_associated_colors($product)
    {
        $colors = $product->colors;
        if (count($colors) > 0) {
            return $colors;
        } else {
            return null;
        }
    }

    private function get_colors_associated_quantities($colors, $product_id)
    {
        $color_quantities_bag = [];
        foreach ($colors as $color) {
            $color_quantities = ProductSize::where('product_id', $product_id)->where('color_id', $color->id)->get();


            $quantities = [];
            foreach ($color_quantities as $color_quantity) {
                $quantity = $color_quantity->quantity;

                array_push($quantities,  $quantity);
            }


            $color_quantities_bag[$color->id] = $quantities;
        }



        return  $color_quantities_bag;
    }

    private function get_colors_asscociated_sizes($colors, $product_id)
    {


        $color_sizes_bag = [];
        foreach ($colors as $color) {
            $color_sizes = ProductSize::where('product_id', $product_id)->where('color_id', $color->id)->get();


            $size_ids = [];
            foreach ($color_sizes as $color_size) {
                $size = Size::find($color_size->size_id);

                array_push($size_ids, $size);
            }


            $color_sizes_bag[$color->id] = $size_ids;
        }



        return $color_sizes_bag;
    }
    private function get_colors_associated_images($colors, $product_id)
    {
        $color_images_urls_bag = [];
        $color_images_ids_bag = [];
        $color_images = [];

        foreach ($colors as $color) {
            $color_images = Image::where([['product_id', $product_id], ['color_id', $color->id]])->get();
            $image_urls = [];
            $images_id = [];
            foreach ($color_images as $color_image) {
                $image_url = $color_image->url;
                $amazon_url = Storage::disk('s3')->url($image_url);
                array_push($image_urls, $amazon_url);
                array_push($images_id, $color_image->id);
            }
            $color_images_urls_bag[$color->id] = $image_urls;
            $color_images_ids_bag[$color->id] = $images_id;
        }
        $color_images['urls'] = $color_images_urls_bag;
        $color_images['ids'] = $color_images_ids_bag;


        return  $color_images;
    }
    private function get_prod_facefront_image($product)
    {

        $face_image = $product->facefront_image;
        $face_image_url = $face_image->url;
        $amazon_url = Storage::disk('s3')->url($face_image_url);


        return $amazon_url;
    }
    public function show(Product $product)
    {


        if ($product) {
            $face_front_url = $this->get_prod_facefront_image($product);
            $prod_assciated_colors = $this->get_prod_associated_colors($product);
            if ($prod_assciated_colors != null) {
                $colors_asscociated_sizes = $this->get_colors_asscociated_sizes($prod_assciated_colors, $product->id);
                // dd($colors_asscociated_sizes);
                $colors_associated_images = $this->get_colors_associated_images($prod_assciated_colors, $product->id);
                return view('productDetails', ['images' => $colors_associated_images['urls'], 'colors' => $prod_assciated_colors, 'sizes' => $colors_asscociated_sizes, 'product' => $product]);
            } else {
                return view('productDetails', ['facefrontImage' => $face_front_url, 'product' => $product]);
            }
        } else {
            return response('Not Found', 404);
        }











        // }
    }

    public function delete_product_image(Image $image)
    {

        if ($image) {
            Storage::disk('s3')->delete($image->url);

            $image->delete();

            return back()->with('image_delete_success', 'image deleted successfully');
        } else {
            return response('Not Found', 404);
        }
        // $image = [
        //     'product_id' => $product_id,
        //     'color_id' => $color_id,
        //     'image_id' => $image_id
        // ];
        // $validator = Validator::make($image, [
        //     'product_id' => 'required|exists:images,product_id',
        //     'color_id' => 'required|exists:images,color_id',
        //     'image_id' => 'required|exists:images,id'
        // ]);
        // if ($validator->fails()) {
        //     return back()->withErrors($validator);
        // } else {
        //     $validated = $validator->validated();

        //     $filtered_images = Image::where('product_id', $validated['product_id'])->where('color_id', $validated['color_id'])->get();
        //     // dd($filtered_images->count());

        //     if ($filtered_images->count() > 1) {
        //         $selected_image = Image::find($validated['image_id']);

        //         Storage::disk('s3')->delete($selected_image->url);

        //         $selected_image->delete();

        //         return back()->with('image_delete_success', 'image deleted successfully');
        //     } else {
        //         return back()->withErrors(['last_image' => 'color last image cannot be deleted']);
        //     }
        // }
    }

    public function delete_product_color(Product $product, Color $color)
    {
        if ($product && $color) {
            $color_product = ColorProduct::where('color_id', $color->id)->where('product_id', $product->id)->first();
            $color_product->delete();

            $product_sizes = ProductSize::where('color_id', $color->id)->where('product_id', $product->id)->get();
            foreach ($product_sizes as $size) {
                $size->delete();
            }
            $images = Image::where('color_id', $color->id)->where('product_id', $product->id)->get();
            foreach ($images as $image) {

                Storage::disk('s3')->delete($image->url);
                $image->delete();
            }

            return back()->with('delete_product_color', 'color deleted successfully');
        } else {
            return response('Not found', 404);
        }
    }

    public function update_facefront_image(UpdateFacefrontImage $request)
    {

        $validated = $request->validated();

        $product = Product::find($validated['product']);
        //  

        Storage::disk('s3')->delete($product->facefront_image->url);
        $product->facefront_image->delete();

        $this->add_facefront_image($product->id, $validated['facefront_image']);

        return back()->with('facefront_image_update', 'Facefront image updated successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

     
    public function edit(Product $product)
    {

        if ($product) {
            $colors = Color::all();

            $categories = Category::all();
            $devisions = Devision::all();
            $types = Type::all();
            $face_front_url = $this->get_prod_facefront_image($product);
            $category_id = Category::where('category_name', $product->category_id)->first()->id;
            
            $sizes = Category::find($category_id)->sizes;

            $product_colors = $product->colors;
            if (count($product_colors) > 0) {
                $prod_assciated_colors = $product_colors;
                $colors_asscociated_sizes = $this->get_colors_asscociated_sizes($prod_assciated_colors, $product->id);
                $colors_associated_images = $this->get_colors_associated_images($prod_assciated_colors, $product->id);
                $colors_associated_quantities=$this->get_colors_associated_quantities( $prod_assciated_colors,$product->id);

                return view('product.editProduct', ['product' => $product, 'product_colors' => $prod_assciated_colors, 'colors' => $colors, 'product_sizes' => $colors_asscociated_sizes, 'sizes' => $sizes, 'categories' => $categories, 'types' => $types, 'devisions' => $devisions, 'product_images_urls' => $colors_associated_images['urls'], 'product_images_ids' => $colors_associated_images['ids'], 'facefront_image' => $face_front_url,'quantities'=>$colors_associated_quantities]);
            } else {
                return view('product.editProduct', ['product' => $product, 'colors' => $colors, 'sizes' => $sizes, 'categories' => $categories, 'types' => $types, 'devisions' => $devisions, 'facefront_image' => $face_front_url]);
            }
        } else {
            return response('Not found', 404);
        }
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


        if ($product) {


            $product->delete();

            return view('dashboard');
        } else {
            return response('Product does not exist', 404);
        }
        // }
    }
}
