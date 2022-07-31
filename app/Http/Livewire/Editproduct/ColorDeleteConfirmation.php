<?php

namespace App\Http\Livewire\Editproduct;

use App\Models\Image;
use Livewire\Component;
use App\Models\ColorProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ColorDeleteConfirmation extends Component
{
    public $display='none',$product_id,$color_id;

    protected $listeners=['display_color_delete_confirmation'];

    public function display_color_delete_confirmation($product_id,$color_id)
    {
        $this->display='block';
        // dd($product_id);
        $this->color_id=$color_id;
        $this->product_id=$product_id;

    }

    public function close()
    {
        $this->display='none';
        return redirect()->route('product_update', ['product' => $this->product_id]);
    }

    public function delete_color()
    {
       
           

        $product_color=ColorProduct::where('color_id',$this->color_id)->where('product_id',$this->product_id)->first();
        if($product_color)
        {
            $product_color->delete();
            $product=ColorProduct::where('product_id',$this->product_id)->first();
            if(!$product)
            {
                $product=Product::find($this->product_id);
                $product->product_live=0;
                $product->save();
            }
        }

        $images=Image::where('color_id',$this->color_id)->where('product_id',$this->product_id)->get();
        if(count($images)>0)
        {
            foreach($images as $image)
            {
                Storage::disk('s3')->delete($image->url);
                $image->delete();

            }
        }
     

        return redirect()->route('product_update', ['product' => $this->product_id]);


    }
    public function render()
    {
        return view('livewire.editproduct.color-delete-confirmation');
    }
}
