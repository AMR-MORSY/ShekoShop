<?php

namespace App\Http\Livewire\Editproduct;

use App\Models\Size;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use Livewire\Component;
use App\Models\ProductSize;
use App\Models\ColorProduct;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AddProductColor extends Component
{

    use WithFileUploads;

    public $sizes, $colors;
    public $size = [];
    public $quantity = [];
    public $color;
    public $images = [];
    public $product_id;



    public $display = 'none';

    protected $listeners = ['addColor'];

    // protected $errorBag = 'add_color';


    protected $rules = [
        'color' => 'required|exists:colors,id',
        'size' => 'array|min:1',
        'size.*' => 'exists:sizes,id',
        'quantity' => 'array',
        'quantity.*' => 'numeric',
        'images' => 'array|min:5',
        'images.*' => 'mimes:jpg,bmp,png',
        "product_id" => 'required|exists:products,id',

    ];

    protected $messages = [

        'color.required' => "please enter at least one color",
        'size.min' => "please enter at least one size",
        'images.min' => "please enter at least 5 images",
        'images.*.mimes' => "only jpg,bmp,pngs images",

    ];

    public function addColor()
    {
        $this->display = 'block';
    }

    public function mount($sizes, $colors, $product_id)
    {
        $this->sizes = $sizes;
        $this->colors = $colors;
      
        $this->product_id = $product_id;
    }

    public function display()
    {
        $this->emit('display');
        // $this->dispatchBrowserEvent('getFormValues');
    }

    private function fill_color_prod_size_table($sizes, $color, $quantities, $product_id)
    {


        foreach ($sizes as $key=>$value) { 

          




            ProductSize::create([
                'color_id' => $color,
                'product_id' => $product_id,
                'size_id' => $sizes[$key],
                'quantity' => $quantities[$key]
            ]);
        }




        // if ($selected_size != null && $selected_color != null) {
        //     // dd($selected_size);
        //     $arr = explode(',', $selected_size, 200);
        //     foreach ($arr as $arry) {
        //         ProductSize::create([
        //             'color_id' => $selected_color,
        //             'product_id' => $product_id,
        //             'size_id' => $arry
        //         ]);
        //     }
        // }
    }

    private function check_if_color_in_pivote_table($color, $product_id)
    {

        $exist_color = ColorProduct::where('color_id', $color)->where('product_id', $product_id)->first();
        $color_name = null;
        if ($exist_color) {
            $name = Color::find($exist_color->color_id)->color_name;
            $color_name = $name;
        }
        return $color_name;
    }

    private function fill_color_product_pivot($color, $product_id)
    {
        // if ($colors != null) {
        //     foreach ($colors as $color) {
        //         ColorProduct::create([
        //             'color_id' => $color,
        //             'product_id' => $product_id
        //         ]);
        //     }
        // }

        if ($color != null) {
            ColorProduct::create([
                'color_id' => $color,
                'product_id' => $product_id
            ]);
        }
    }

    private function fill_color_images_table($selected_image, $selected_color, $images, $color, $product_id)
    {
        if ($images != null && $color != null) {

            foreach ($images as $image) {
           
              $path=  Storage::disk('s3')->put('Products', $image);
                Image::create([
                    'url' => $path,
                    'product_id' => $product_id,
                    'color_id' => $color,
                ]);
            }
        }
        // if ($selected_image != null && $selected_color != null) {


        //     foreach ($selected_image as $image) {
        //         $path = $image->store('Products', 's3');
        //         Image::create([
        //             'url' => $path,
        //             'product_id' => $product_id,
        //             'color_id' => $selected_color,
        //         ]);
        //     }
        // }
    }
    private function check_sizes_quantities($sizes, $quantities)
    {

        $errors = [];
        foreach ($sizes as $key=>$value) {

            if(isset($quantities[$key]))
            {
                if ($quantities[$key] <= 0) {


                    $size_name =Size::find( $sizes[$key])->size_name;
    
                    $error = "size:'$size_name'->quantity is missing";
                    array_push($errors, $error);
                }

            }
            else
            {
                $error='quantity is missing';

                array_push($errors, $error);

            }


           
        }

        return $errors;
    }

    private function calculate_product_stock($sizes, $quantities,$product_id)
    {
       
       
        $product=Product::find($product_id) ;
        $stock=$product->product_stock;
        if($stock==null)
        {
            $count=0;
        }
        else
        {
            $count=$stock;
        }

        foreach ($sizes as $key=>$value) {


            if ($quantities[$key] > 0) {
                $count = $count + $quantities[$key];
            }
        }
        $product->product_stock=$count;
        $product->product_live=1;
        $product->save();

       
    }

    public function add_prod_color()
    {

        $validated = $this->validate();
        //   dd($validated);

        $exist_color = $this->check_if_color_in_pivote_table($validated['color'], $validated['product_id']);
        if ($exist_color != null) {
            return back()->with(['exist_color' => $exist_color . " color already exists"]);
        }
        $quantitiy_error = $this->check_sizes_quantities($validated['size'], $validated['quantity']);

        if (count($quantitiy_error) > 0) {
            return back()->with(['quantity_error' => "some sizes are missing quantities"]);
        } else {

            $this->fill_color_product_pivot($validated['color'], $validated['product_id']);
            $this->calculate_product_stock($validated['size'], $validated['quantity'],$validated['product_id']);
           
            $this->fill_color_prod_size_table($validated['size'], $validated['color'], $validated['quantity'], $validated['product_id']);

            $this->fill_color_images_table(null, null, $validated['images'], $validated['color'], $validated['product_id']);
           
            return redirect()->route('product_update',['product'=>$validated['product_id']]);
        }
    }



    public function close()
    {
      
        $this->display = 'none';
        $this->quantity = [];
        $this->size = [];
        $this->images = [];
        $this->color = '';


        // return redirect()->route('product_update', ['product' => $this->product->id]);

    }



    public function render()
    {

        return view('livewire.editproduct.add-product-color');
    }
}
