<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Type;
use App\Models\User;
use App\Models\Color;

use App\Models\Product;
use App\Models\Category;
use App\Models\Devision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductFacefrontImage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Products\StoreProductRequest;

class DashboardController extends Controller
{
    public function index()

    {
        $categories = Category::all();
        $types = Type::all();
        $devisions = Devision::all();
        // $colors=Color::all();
        // $sizes=Size::all();
        return view('dashboard', ['categories' => $categories, 'devisions' => $devisions, 'types' => $types]);
    }



    public function addStock(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($user->hasRole('admin')) {
            $validator = Validator::make($request->all(), ['product_stock' => 'required|numeric', 'product_id' => 'required|exists:products,id']);
            $validated = $validator->validated();
            if ($validated) {
                $product = Product::find($validated['product_id']);
                $product->product_stock = $validated['product_stock'];
                $product->product_live = 1;
                $product->save();
                return response([
                    'success' => true,
                    'product_id' => $product->id,
                    'message' => 'product stock inserted successfully'
                ]);
            } else {
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
            }
        } else {
            return response()->json(array(
                'success' => false,

                'errors' => ["message" => array('not allowed')]
            ), 404);
        }
    }

    private function add_facefront_image($product_id, $image)
    {
        $path = $image->store('Products', 's3');
        ProductFacefrontImage::create([
            'url' => $path,
            'product_id' => $product_id


        ]);
    }
    protected $rules = [
        // "product_SKU" => 'nullable|string|max:50',
        'product_name' => 'required|string|max:100',
        'product_price' => 'required|numeric',
        'product_weight' => 'nullable|numeric',
        'product_cartDesc' => 'required|string|max:250',
        'product_shortDesc' => 'required|string|max:1000',
        'product_longDesc' => 'required|string',
        'product_thumb' => 'nullable|string|max:100',
        'category_id' => 'required|string|exists:categories,category_name',
        'devision_id' => 'required|string|exists:devisions,devision_name',
        'type_id' => 'required|string|exists:types,type_name',
        // 'product_live' => 'required|boolean',
        'product_location' => 'nullable|string|max:50',
        'facefront_image' => 'required|image'


    ];




    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($user->hasRole('admin')) {
            $validator = Validator::make($request->all(), $this->rules);

            $validated = $validator->validated();

            if ($validated) {

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
                    // 'product_live' => $validated['product_live'],
                    'product_location' => $validated['product_location'],
                ]);



                $this->add_facefront_image($product->id, $validated['facefront_image']);
                $category = $validated['category_id'];

                if ($category == 'Cloth' || $category == 'Bags' || $category == 'Shoes') {

                    $product->product_stock = 0;
                    $product->save();
                    $product->product_live = 0;
                    $product->save();
                }




                return response([
                    'success' => true,
                    'category_type' => $category,
                    'product_id' => $product->id,
                    'message' => 'product inserted successfully'
                ]);
            } else {
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
            }
        } else {
            return response()->json(array(
                'success' => false,

                'errors' => ["message" => array('not allowed')]
            ), 404);
        }
    }
}
