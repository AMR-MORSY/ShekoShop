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
use App\Models\Cart;
use App\Models\CategorySize;
use App\Models\Devision;
use App\Models\Type;
use Dotenv\Validator as DotenvValidator;
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

        // $colors = [];

        // foreach ($products_colors as $key=>$product) {
        //     $color = Color::find($key);
        //     array_push($colors, $color);
        // }
        return $colors;
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

    private function get_colors_asscociated_sizes($products, $color_id)
    {

        $color_sizes = [];

        // $color_sizes = ProductSize::where('product_id', $product_id)->where('color_id', $color->id)->get();
        foreach ($products as  $product) {
            if ($product->color_id == $color_id) {
                $size = Size::find($product->size_id);
                array_push($color_sizes, $size);
            }
        }









        return $color_sizes;
    }
    // private function get_colors_asscociated_sizes( $products,$colors)
    // {


    //     $color_sizes_bag = [];
    //     foreach ($colors as $color) {
    //         // $color_sizes = ProductSize::where('product_id', $product_id)->where('color_id', $color->id)->get();
    //         foreach($products as $product)
    //         {
    //             if($product->color_id==$color->id)
    //             {
    //                 $size = Size::find($product->size_id);
    //                 $color_sizes_bag[$color->id] = $size;

    //             }

    //         }



    //     }



    //     return $color_sizes_bag;
    // }
    private function get_colors_associated_images($color, $product_id)
    {
        // $color_images_urls_bag = [];
        // // $color_images_ids_bag = [];
        // $color_images = [];


        $color_images = Image::where([['product_id', $product_id], ['color_id', $color]])->get();
        $image_urls = [];
        // $images_id = [];
        foreach ($color_images as $color_image) {
            $image_url = $color_image->url;
            $amazon_url = Storage::url($image_url);
            array_push($image_urls, $amazon_url);
            // array_push($images_id, $color_image->id);
        }
        // $color_images_urls_bag[$color] = $image_urls;
        // $color_images_ids_bag[$color->id] = $images_id;

        // $color_images['urls'] = $color_images_urls_bag;
        // $color_images['ids'] = $color_images_ids_bag;

        // dd($image_urls);


        return  $image_urls;
    }



    // private function get_colors_associated_images($colors, $product_id)
    // {
    //     $color_images_urls_bag = [];
    //     $color_images_ids_bag = [];
    //     $color_images = [];

    //     foreach ($colors as $color) {
    //         $color_images = Image::where([['product_id', $product_id], ['color_id', $color->id]])->get();
    //         $image_urls = [];
    //         $images_id = [];
    //         foreach ($color_images as $color_image) {
    //             $image_url = $color_image->url;
    //             $amazon_url = Storage::disk('s3')->url($image_url);
    //             array_push($image_urls, $amazon_url);
    //             array_push($images_id, $color_image->id);
    //         }
    //         $color_images_urls_bag[$color->id] = $image_urls;
    //         $color_images_ids_bag[$color->id] = $images_id;
    //     }
    //     $color_images['urls'] = $color_images_urls_bag;
    //     $color_images['ids'] = $color_images_ids_bag;


    //     return  $color_images;
    // }
    private function get_prod_facefront_image($product)
    {

        $face_image = $product->facefront_image;
        $face_image_url = $face_image->url;
        $amazon_url = Storage::url($face_image_url);



        return $amazon_url;
    }
    // public function show(Product $product)
    // {


    //     if ($product) {





    //         $category_id = Category::where('category_name', $product->category_id)->first()->id;

    //         if ($category_id == "1" or $category_id == "2" or $category_id == "3") {
    //             $product_colors_sizes = ProductSize::where('product_id', $product->id)->where("size_live", '1')->get();
    //             if (count($product_colors_sizes) > 0) {
    //                 $prod_assciated_colors=[];
    //                 $prod_assciated_colors = $this->get_prod_associated_colors($product_colors_sizes);
    //                 $colors_associated_images = $this->get_colors_associated_images($prod_assciated_colors, $product->id);
    //                 $colors_asscociated_sizes=$this->get_colors_asscociated_sizes($product_colors_sizes,$prod_assciated_colors);
    //                 return view('productDetails', ['images' => $colors_associated_images['urls'], 'colors' => $prod_assciated_colors, 'sizes' => $colors_asscociated_sizes, 'product' => $product]);
    //             }




    //         } else {

    //             $face_front_url = $this->get_prod_facefront_image($product);
    //             return view('productDetails', ['facefrontImage' => $face_front_url, 'product' => $product]);
    //         }



    //     } else {
    //         return response('Not Found', 404);
    //     }












    // }

    public function get_color_details(Request $request)
    {
        $color_id = $request->input('color_id');
        $product_id = $request->input('product_id');

        $product_colors_sizes = ProductSize::where('product_id', $product_id)->where("size_live", '1')->get();
        $colors_associated_images = $this->get_colors_associated_images($color_id, $product_id);
        $colors_asscociated_sizes = $this->get_colors_asscociated_sizes($product_colors_sizes,  $color_id);
        return response([
            "success" => true,
            "images" => $colors_associated_images,
            "sizes" => $colors_asscociated_sizes,

        ]);
    }
    public function show(Product $product)
    {


        if ($product) {

            $category_id = Category::where('category_name', $product->category_id)->first()->id;
            $prod_assciated_colors = $this->get_prod_associated_colors($product);

            if ($category_id == "1" or $category_id == "2" or $category_id == "3") {
                $product_colors_sizes = ProductSize::where('product_id', $product->id)->where("size_live", '1')->get();
                // $product_colors_sizes_grouped=  $product_colors_sizes->groupBy('color_id');
                $count = count($product_colors_sizes);

                if ($count > 0) {
                    $color_id = $prod_assciated_colors[0]->id;

                    //     $prod_assciated_colors = [];
                    //     $prod_assciated_colors = $this->get_prod_associated_colors($product_colors_sizes_grouped);

                    //     for ($i = 0; $i < count($prod_assciated_colors); $i++) {
                    //         $color = $prod_assciated_colors[0];
                    $colors_associated_images = $this->get_colors_associated_images($color_id, $product->id);
                    $colors_asscociated_sizes = $this->get_colors_asscociated_sizes($product_colors_sizes,  $color_id);
                    return view('productDetails', ['images' => $colors_associated_images, 'colors' => $prod_assciated_colors, 'sizes' => $colors_asscociated_sizes, 'product' => $product]);
                }
                else{
                    $face_front_url = $this->get_prod_facefront_image($product);
                    return view('productDetails', ['facefrontImage' => $face_front_url, 'product' => $product]);
                    
                }





                // }
            } else {

                $face_front_url = $this->get_prod_facefront_image($product);
                return view('productDetails', ['facefrontImage' => $face_front_url, 'product' => $product]);
            }
        } else {
            return response('Not Found', 404);
        }
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

            if ($category_id == "1" or $category_id == "2" or $category_id == "3") {
                $categorySizes = CategorySize::where('category_id', $category_id)->get();
                $sizes = [];
                foreach ($categorySizes as $categorySize) {
                    $size = Size::find($categorySize->size_id);
                    array_push($sizes, $size);
                }
            } else {
                $sizes = [];
            }

            $product_colors = $product->colors;
            if (count($product_colors) > 0) {
                $product_color_size = ProductSize::where('product_id', $product->id)->get();
                $product_color_size = $product_color_size->groupBy('color_id');
                // $prod_assciated_colors = $product_colors;
                // $colors_asscociated_sizes = $this->get_colors_asscociated_sizes($prod_assciated_colors, $product->id);
                // $colors_associated_images = $this->get_colors_associated_images($prod_assciated_colors, $product->id);
                // $colors_associated_quantities=$this->get_colors_associated_quantities( $prod_assciated_colors,$product->id);

                // return view('product.editProduct', ['product' => $product, 'product_colors' => $prod_assciated_colors, 'colors' => $colors, 'product_sizes' => $colors_asscociated_sizes, 'sizes' => $sizes, 'categories' => $categories, 'types' => $types, 'devisions' => $devisions, 'product_images_urls' => $colors_associated_images['urls'], 'product_images_ids' => $colors_associated_images['ids'], 'facefront_image' => $face_front_url,'quantities'=>$colors_associated_quantities]);
                return view('product.editProduct', ['product' => $product, 'colors' => $colors, 'sizes' => $sizes, 'categories' => $categories, 'types' => $types, 'devisions' => $devisions, 'facefront_image' => $face_front_url, "product_color_size" => $product_color_size]);
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

    private function deactivate_cart_product($color_id,$product_id)
    {
        $cartProducts=Cart::where('color_id',$color_id)->where('product_id',$product_id)->get();
        $count=count($cartProducts);
        if($count>0)
        {
            foreach($cartProducts as $product)
            {
                $product->product_live=0;
                $product->save();
            }
        }
    }

    private function calculate_product_stock($quantity, $product_id)
    {


        $product = Product::find($product_id);
        $stock = $product->product_stock;
       


        $stock = $stock - $quantity;

        $product->product_stock = $stock;
        

        if($stock==0)
        {
            $product->product_live = 0;
         

        }
        $product->save();

       
      
    }
    public function delete_color(Request $request)
    {
        $validator = validator::make($request->all(), ['product_id' => 'required|exists:products,id', "color_id" => 'required|exists:colors,id']);
        $validated = $validator->validated();
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }

            $this->throwValidationException(

                $request,
                $validator

            );
        } else {

            $this->deactivate_cart_product($validated['color_id'],$validated['product_id']);
            

            $color_product = ColorProduct::where('color_id', $validated['color_id'])->where('product_id', $validated['product_id'])->first();
            $color_product->delete();

            $product_sizes = ProductSize::where('color_id',  $validated['color_id'])->where('product_id', $validated['product_id'])->get();
            foreach ($product_sizes as $size) {
                $this->calculate_product_stock($size->quantity,$size->product_id);
                $size->delete();
            }
            $images = Image::where('color_id',  $validated['color_id'])->where('product_id', $validated['product_id'])->get();
            foreach ($images as $image) {

                Storage::disk('s3')->delete($image->url);
                $image->delete();
            }
            return response([
                "success" => true,

            ]);
        }
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
