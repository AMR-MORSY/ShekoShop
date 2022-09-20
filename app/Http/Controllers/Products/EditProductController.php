<?php

namespace App\Http\Controllers\Products;

use App\Models\Cart;


use App\Models\Size;
use App\Models\User;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;

use App\Rules\UploadCount;
use App\Models\ProductSize;
use App\Models\ColorProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\countOf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EditProductController extends Controller
{
    public function images_rules()
    {
        return [
            'color' => 'required|exists:colors,id',
            'size' => 'required|exists:sizes,id',
            'quantity' => 'required|min:1',
            'product_id' => 'required|exists:products,id',
            'images.*' => 'mimes:jpg,bmp,png|max:2000',

        ];
    }
    private function fill_color_product_pivot($color, $product_id)
    {

        if ($color != null) {
            ColorProduct::create([
                'color_id' => $color,
                'product_id' => $product_id
            ]);
        }
    }

    private function check_if_size_exists($color, $product_id, $size)
    {

        $exist_size = ProductSize::where('color_id', $color)->where('product_id', $product_id)->where("size_id", $size)->first();

        if ($exist_size) {

            return $exist_size;
        } else {
            return false;
        }
    }

    private function check_if_color_exists($color_id, $product_id)
    {
        $color = ColorProduct::where('color_id', $color_id)->where('product_id', $product_id)->first();
        if ($color) {
            return true;
        } else {
            return false;
        }
    }

    protected $Add_Color_messages = [

        'color.required' => "please enter at least one color",
        'size.required' => "please enter at least one size",
        'quantity.required' => "quantity must be at least one",
        'images.min' => "please enter at least 5 images",
        'images.*.mimes' => "only jpg,bmp,pngs images",

    ];
    private function calculate_product_stock($quantity, $product_id)
    {


        $product = Product::find($product_id);
        $stock = $product->product_stock;
        if ($stock == null) {
            $count = 0;
        } else {
            $count = $stock;
        }


        $count = $count + $quantity;

        $product->product_stock = $count;
        $product->product_live = 1;
        $product->save();
    }
    private function fill_color_prod_size_table($size, $color, $quantity, $product_id)
    {
        //     $product = ProductSize::where('product_id', $product_id)->where('size_id', $size)->where('color_id', $color)->first();
        //     if ($product) {
        //         $product->quantity = $quantity;
        //         $product->save();
        //     } else {
        ProductSize::create([
            'color_id' => $color,
            'product_id' => $product_id,
            'size_id' => $size,
            'quantity' => $quantity
        ]);
        // }
    }
    private function fill_color_images_table($images, $color, $product_id)
    {
        if ($images != null && $color != null) {

            foreach ($images as $image) {

                $path =  Storage::disk('s3')->put('Products', $image);
                Image::create([
                    'url' => $path,
                    'product_id' => $product_id,
                    'color_id' => $color,
                ]);
            }
        }
    }

    private function update_images($color, $product_id, $images)
    {
        $images = Image::where('color_id', $color)->where('product_id', $product_id)->get();
        if (count($images) > 0) {
            foreach ($images as $image) {
                Storage::disk('s3')->delete($image->url);
                $image->delete();
            }
        }



        foreach ($images as $image) {

            $path =  Storage::disk('s3')->put('Products', $image);
            Image::create([
                'url' => $path,
                'product_id' => $product_id,
                'color_id' => $color,
            ]);
        }
    }

    private function update_Size_and_product_stock($exist_size, $new_quantity, $product_id)
    {
        function decrease_product_stock($updated_quantity, $product_id)
        {
            $product = Product::find($product_id);
            $product_old_stock = $product->product_stock;
            $product_new_stock = $product_old_stock - $updated_quantity;
            $product->product_stock = $product_new_stock;
            if ($product_new_stock == 0) {
                $product->product_live = 0;
                $product->save();
            } else {
                $product->save();
            }
        }
        $Size_old_quantity = $exist_size->quantity;
        $exist_size->quantity = $new_quantity;
        $exist_size->save();

        if ($new_quantity > $Size_old_quantity) {
            $updated_quantity = $new_quantity - $Size_old_quantity;
            $product = Product::find($product_id);
            $product_old_stock = $product->product_stock;
            $product_new_stock = $product_old_stock + $updated_quantity;
            $product->product_stock = $product_new_stock;
            if ($product_new_stock == 0) {
                $product->product_live = 0;
                $product->save();
            } else {
                $product->save();
            }
        } elseif ($new_quantity < $Size_old_quantity) {
            $updated_quantity = $Size_old_quantity - $new_quantity;
            decrease_product_stock($updated_quantity, $product_id);
        } elseif ($new_quantity == 0) {
            $updated_quantity = $Size_old_quantity - $new_quantity;
            $exist_size->size_live = 0;
            $exist_size->save();
            decrease_product_stock($updated_quantity, $product_id);
        }
    }
    public function add_prod_color(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($user->hasRole('admin')) {
            $validator = Validator::make($request->all(), $this->images_rules(), $this->Add_Color_messages);
            $validated = $validator->validated();
            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json(array(
                        'success' => false,
                        'message' => 'There are incorect values in the form!',
                        'errors' => $validator->getMessageBag()->toArray()
                    ), 422);
                }

                $this->throwValidationException(

                    $request,
                    $validator

                );
            } else {
                if ($validated) {
                    if (isset($validated["images"])) {
                        $count_images = count($validated["images"]);

                        if ($count_images != 5) {
                            if ($request->ajax()) {
                                return response()->json(array(
                                    'success' => false,

                                    'errors' => ["images" => ["five images are needed"]]
                                ), 422);
                            }
                        }
                    } else {

                        return response()->json(array(
                            'success' => false,

                            'errors' => ["images" => ["five images are needed"]]
                        ), 422);
                    }
                    $color_exists = $this->check_if_color_exists($validated['color'], $validated['product_id']);
                    if ($color_exists) {
                        return response()->json(array(
                            'success' => false,

                            'errors' => ["Color" => ["This color already exists"]]
                        ), 422);
                    }
                    // else
                    // {

                    // }
                    // $exist_size = $this->check_if_size_exists($validated['color'], $validated['product_id'], $validated['size']);
                    // if ($exist_size != false) {
                    //     $this->update_size_and_product_stock($exist_size,$validated['quantity'],$validated['product_id']);

                    //     $this->update_images($validated['color'], $validated['product_id'], $validated['images']);
                    //     return response()->json([
                    //         'success' => true,
                    //         'product_id' =>  $validated['product_id'],
                    //         'message' => 'color inserted successfully'
                    //     ]);
                    // }
                    else {
                        $this->fill_color_product_pivot($validated['color'], $validated['product_id']);
                        $this->calculate_product_stock($validated['quantity'], $validated['product_id']);
                        $this->fill_color_prod_size_table($validated['size'], $validated['color'], $validated['quantity'], $validated['product_id']);
                        $this->fill_color_images_table($validated['images'], $validated['color'], $validated['product_id']);
                        return response([
                            'success' => true,
                            'product_id' =>  $validated['product_id'],
                            'message' => 'color inserted successfully'
                        ]);
                    }
                }
            }
        } else {
            return response()->json(array(
                'success' => false,

                'errors' => ["message" => array('not allowed')]
            ), 404);
        }







        //   
        //    



        //    

        //     return redirect()->route('product_update',['product'=>$validated['product_id']]);
        // }
    }

    public function add_new_size(Request $request)
    {
      
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($user->hasRole('admin')) {
            $validator = Validator::make($request->all(),["product_id"=>'required|exists:products,id',"color_id"=>'required|exists:colors,id',"size_id"=>'required|exists:sizes,id',"quantity"=>["required","regex:/^([1-9][0-9]{0,2}|1000)$/"]],["quantity.regex"=>"Max quantity 1000"] );
            $validated = $validator->validated();
            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json(array(
                        'success' => false,
                        'message' => 'There are incorect values in the form!',
                        'errors' => $validator->getMessageBag()->toArray()
                    ), 422);
                }

                $this->throwValidationException(

                    $request,
                    $validator

                );
            } else {
                $product=ProductSize::where('product_id',$validated['product_id'])->where('color_id',$validated['color_id'])->where('size_id',$validated['size_id'])->first();
                if($product)
                {
                    $old_size_quantity=$product->quantity;
                    $db_product=Product::find($validated['product_id']);
                    $old_product_qunatity=$db_product->product_stock;
                    if($validated['quantity']>$old_size_quantity)
                    {
                        $new_size_quantity=$validated['quantity']-$old_size_quantity;
                        $new_product_quantity= $new_size_quantity+$old_product_qunatity;
                        $db_product->product_stock= $new_product_quantity;
                        $db_product->save();
                        $product->quantity=$validated['quantity'];
                        $product->save();
                    }
                    elseif($validated['quantity']<$old_size_quantity)
                    {
                        $new_size_quantity=$old_size_quantity-$validated['quantity'];
                        $new_product_quantity= $old_product_qunatity-$new_size_quantity;

                        $db_product->product_stock= $new_product_quantity;
                        $db_product->save();
                        $product->quantity=$validated['quantity'];
                        $product->save();

                    }
                    else
                    {
                        $product->quantity=$validated['quantity'];
                        $product->save();
                    }
                    return response([
                        'success' => true,
                        'message' =>  "Size quantity updated successfully",
                       
                      
                    ]);

                }
                else{
                    $db_product=Product::find($validated['product_id']);
                    $old_product_qunatity=$db_product->product_stock;
                    $new_product_quantity= $validated['quantity']+$old_product_qunatity;
                    $db_product->product_stock= $new_product_quantity;
                    $db_product->save();
                    ProductSize::create([
                        'product_id'=>$validated['product_id'],
                        'color_id'=>$validated['color_id'],
                        'size_id'=>$validated['size_id'],
                        'quantity'=>$validated['quantity']



                    ]);
                    return response([
                        'success' => true,
                        'message' =>  "New size inserted successfully",
                       
                      
                    ]);
                }
               
            }
        }
        else
        {
            return response()->json(array(
                'success' => false,

                'errors' => ["message" => array('not allowed')]
            ), 404);

        }

            
            
    }

    public function update_size_form(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($user->hasRole('admin')) {
            $validator = Validator::make($request->all(),["product_id"=>'required|exists:products,id',"color_id"=>'required|exists:colors,id'] );
            $validated = $validator->validated();
            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json(array(
                        'success' => false,
                        'message' => 'There are incorect values in the form!',
                        'errors' => $validator->getMessageBag()->toArray()
                    ), 422);
                }

                $this->throwValidationException(

                    $request,
                    $validator

                );
            } else {
                $products=ProductSize::where('product_id',$validated['product_id'])->where('color_id',$validated['color_id'])->get();
                $sizes=[];
                foreach($products as $product)
                {
                    $size_name=Size::find($product->size_id)->size_name;
                    array_push($sizes,$size_name);
                }
                
                return response([
                    'success' => true,
                    'products' =>  $products,
                    "sizes"=>$sizes
                  
                ]);
            }
        }
        else
        {
            return response()->json(array(
                'success' => false,

                'errors' => ["message" => array('not allowed')]
            ), 404);

        }

    }

    private function deactivate_cart_product($color_id,$product_id,$size_id=null)
    {
        if($size_id=null)
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
        else
        {
            $cartProducts=Cart::where('color_id',$color_id)->where('product_id',$product_id)->where("size_id",$size_id)->get();
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
      
    }

    private function update_product_stock($product_id,$new_quantity)
    {
        $product=Product::find($product_id);
        $product_old_stock=$product->product_stock;
        $product_new_stock=$product_old_stock-$new_quantity;
        if($product_new_stock<=0)
        {
           
            $product->product_live=0;
            
        }
        $product->product_stock=$product_new_stock;
        $product->save();

    }

    public function delete_size(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($user->hasRole('admin')) {
            $validator = Validator::make($request->all(),["product_id"=>'required|exists:products,id',"color_id"=>'required|exists:colors,id',"size_id"=>'required',"quantity"=>["required","regex:/^([1-9][0-9]{0,2}|1000)$/"]],["quantity.regex"=>"Max quantity 1000"] );
            $validated = $validator->validated();
            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json(array(
                        'success' => false,
                        'message' => 'There are incorect values in the form!',
                        'errors' => $validator->getMessageBag()->toArray()
                    ), 422);
                }

                $this->throwValidationException(

                    $request,
                    $validator

                );
            } else {
                $size_id=Size::where("size_name",$validated['size_id'])->first()->id;
                $product_size=ProductSize::where('product_id',$validated['product_id'])->where('color_id',$validated['color_id'])->where('size_id',$size_id)->first();
                $this->update_product_stock($validated['product_id'],$product_size->quantity);
                $this->deactivate_cart_product($validated["color_id"],$validated["product_id"],$size_id);
              
                $product_size->delete();
               
                return response([
                    'success' => true,
                    'message' =>  "Size deleted successfully",
                    
                  
                ]);
            }
        }
        else
        {
            return response()->json(array(
                'success' => false,

                'errors' => ["message" => array('not allowed')]
            ), 404);

        }


    }
}
