<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Devision;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductFacefrontImage;
use Illuminate\Support\Facades\Storage;

class Addproductform extends Component
{
    use WithFileUploads;

    public $categories, $types, $devisions;
    public $product_longDesc, $product_shortDesc, $facefront_image, $product_name, $product_location, $product_thumb, $product_cartDesc, $product_weight, $product_price, $category, $type, $devision;



    protected $listeners = ['categoryChanged'];

    public function changeCategory()

    {
        if ($this->category != "") {
            //  dd($this->category);

            $this->emitSelf('categoryChanged', $this->category);
        }
    }
    public function categoryChanged($category)
    {

        $id = Category::where('category_name', $category)->first()->id;
        $devisions = Devision::where('category_id', $id)->get();
        $this->devisions = $devisions;
    }

    public function authorize()
    {

        $id = Auth::user()->id;
        $user = User::find($id);
        if ($user->hasRole('admin')) {
            return true;
        } else {
            return false;
        }
    }

    private function add_facefront_image($product_id, $image)
    {

        $path = Storage::disk('s3')->put('Products', $image);
        ProductFacefrontImage::create([
            'url' => $path,
            'product_id' => $product_id


        ]);
    }
    public function rules()
    {
        return [

            'product_name' => 'required|string|max:100',
            'product_price' => 'required|numeric',
            'product_weight' => 'nullable|numeric',
            'product_cartDesc' => 'required|string|max:250',
            'product_shortDesc' => 'required|string|max:1000',
            'product_longDesc' => 'required|string',
            'product_thumb' => 'nullable|string|max:100',
            'category' => 'required|string|exists:categories,category_name',
            'devision' => 'required|string|exists:devisions,devision_name',
            'type' => 'required|string|exists:types,type_name',
            'product_location' => 'nullable|string|max:50',
            'facefront_image' => 'required|image'
        ];
    }
    public function mount($categories, $types, $devisions)
    {
        $this->devisions = $devisions;
        $this->types = $types;
        $this->categories = $categories;
    }

    public function addproduct()
    {
        $validated = $this->validate();

        $authorize = $this->authorize();
        if ($authorize) {
            $product = Product::create([

                'product_name' => $validated['product_name'],
                'product_price' => $validated['product_price'],
                'product_weight' => $validated['product_weight'],
                'product_cartDesc' => $validated['product_cartDesc'],
                'product_shortDesc' => $validated['product_shortDesc'],
                'product_longDesc' => $validated['product_longDesc'],
                'product_thumb' => $validated['product_thumb'],
                'category_id' => $validated['category'],
                'devision_id' => $validated['devision'],
                'type_id' => $validated['type'],
                'product_location' => $validated['product_location'],
            ]);
            $this->add_facefront_image($product->id, $validated['facefront_image']);

            $category = $validated['category'];
        
            if ($category == 'Cloth' || $category == 'Bags' || $category == 'Shoes') {
              
                $product->product_stock = 0;
                $product->save();
                $product->product_live = 0;
                $product->save();

                $this->emitTo('dashboard.add-color-notification', 'display_add_color_notification', $product->id);
            } else {
                $this->emitTo('dashboard.add-stock', 'display_add_stock_form', $product->id);
            }
        } else {
            return response('Not authorized', 402);
        }
    }
    public function render()
    {
        return view('livewire.dashboard.addproductform');
    }
}
