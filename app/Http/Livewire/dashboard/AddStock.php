<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Product;
use Livewire\Component;

class AddStock extends Component
{
    public $display = 'none', $product_id;

    public $product_stock;

    protected $listeners = ['display_add_stock_form'];


    public function display_add_stock_form($product_id)
    {
        $this->product_id = $product_id;
        $this->display = 'block';
    }

    public function rules()
    {
        return ['product_stock' => 'required|numeric'];
    }
    public function close()
    {
        $this->display='none';
    }

    public function addStock()
    {
        $validated=$this->validate();
        $product=Product::find($this->product_id);
        $product->product_stock=$validated['product_stock'];
        $product->product_live=1;
        $product->save();
        $this->display='none';
        return redirect()->route('product_details',['product'=>$this->product_id]);
    }

    public function render()
    {
        return view('livewire.dashboard.add-stock');
    }
}
