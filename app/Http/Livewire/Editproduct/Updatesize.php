<?php

namespace App\Http\Livewire\Editproduct;

use App\Models\Product;
use Livewire\Component;
use App\Models\ProductSize;

class Updatesize extends Component
{

    public $sizes, $product_id, $color_id;

    public $display = 'none';

    public $size = [];
    public $quantity = [];
    public $filtered_sizes;
    public $color_quantities = [];

   
    protected function rules()
    {
        $this->size = array_filter($this->size, function ($value, $key) {
            return $value != false;
        }, ARRAY_FILTER_USE_BOTH);
      
        return [
            'size' => 'array',
            'size.*' => 'exists:sizes,id',
            'quantity' => 'array',
            'quantity.*' => 'numeric',

        ];
    }

    protected $messages = [


        'size.min' => "please enter at least one size",


    ];




    protected $listeners = ['update_size'];

    public function update_size($color_id, $filtered_sizes, $color_quantities)
    {

        $this->display = 'block';
        $this->color_id = $color_id;
        $this->filtered_sizes = $filtered_sizes;


        for ($i = 0; $i < count($filtered_sizes); $i++) {
            $this->size[$filtered_sizes[$i]['id'] - 1] = $filtered_sizes[$i]['id'];
            $this->quantity[$filtered_sizes[$i]['id'] - 1] = $color_quantities[$i];
        }
    }
    public function close()
    {

        $this->display = 'none';

        $this->size = [];
        $this->quantity = [];
        // return redirect()->route('product_update', ['product' => $this->product_id]);
    }

    private function increment_product_stock($quantity, $product_id)
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
        $product->save();


      
    }
    private function decrement_product_stock($quantity, $product_id)
    {
        $product = Product::find($product_id);
        $stock = $product->product_stock;
        if ($stock == null) {
            $count = 0;
        } else {
            $count = $stock;
        }

        if($count!=0)
        {
            $count = $count - $quantity;

        }

      


        $product->product_stock = $count;
        $product->save();

        if( $product->product_stock==0)
        {
            $product->product_live=0;
            $product->save();
        }


      
    }

    public function submit_update()
    {
        $validated = $this->validate();
      
        if(count($validated['size'])>0)
        {
            foreach ($this->filtered_sizes as $key => $value) {
                $size = ProductSize::where('size_id', $this->filtered_sizes[$key])->where('product_id', $this->product_id)->where('color_id', $this->color_id)->first();
                if ($size) {
                    $this->decrement_product_stock($size->quantity,$this->product_id);
                    $size->delete();
                }
            }
    
            foreach ($validated['size'] as $key => $value) {
                if (isset($validated['quantity'][$key])) {
                    if ($validated['quantity'][$key] != '' && $validated['quantity'][$key] > 0) {
    
                        ProductSize::create([
                            'color_id' => $this->color_id,
                            'product_id' => $this->product_id,
                            'size_id' => $validated['size'][$key],
                            'quantity' => $validated['quantity'][$key]
    
                        ]);
                     $this->increment_product_stock($validated['quantity'][$key], $this->product_id);
                    }
                }
            }

        }
        else
        {
            foreach ($this->filtered_sizes as $key => $value) {
                $size = ProductSize::where('size_id', $this->filtered_sizes[$key])->where('product_id', $this->product_id)->where('color_id', $this->color_id)->first();
                if ($size) {
                    $this->decrement_product_stock($size->quantity,$this->product_id);
                    $size->delete();
                }
            }

        }
        
       

        $size = ProductSize::where('product_id', $this->product_id)->where('color_id', $this->color_id)->first();
        if($size)
        {
            return redirect()->route('product_update', ['product' => $this->product_id]);

        }
        else
        {
            $this->emitTo('editproduct.color-delete-confirmation','display_color_delete_confirmation',$this->product_id,$this->color_id);
        }


       
    }

    public function mount($sizes, $product_id)
    {
        $this->sizes = $sizes;
        $this->product_id = $product_id;
    }
    public function render()
    {
        return view('livewire.editproduct.updatesize');
    }
}
