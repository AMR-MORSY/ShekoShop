<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Request;

use function JmesPath\search;

class SearchProduct extends Component
{
    public $search;
    public $categories;
    public $category;
    public $searched_products;

    public function mount()
    {
        $product_categ = Category::all();

        $this->categories = $product_categ;

        $this->search = null;
        $this->searched_products=[];
    }
    protected $errorBag = 'search_error';
    protected $rules = [
        'search' => 'required|min:2',
        'category' => 'nullable|exists:categories,category_name'

    ];

    public function updated($search)
    {
        $this->validateOnly($search);
    }
    public function submit_search()
    {
        // $this->validate(['search'=>'required']);
        $validated = $this->validate();

        if ($validated['category'] == null) {
            $searched = $validated["search"];
            $products = Product::where('product_name', 'like', "%$searched%")->get();
          
            if (count($products) > 0) {
                $this->searched_products = $products;
            } else {
                $this->searched_products = [];
            }
           
        } else {
            $searched = $validated["search"];
            $categ_id = Category::where('category_name', $validated['category'])->first()->id;
            $products = Product::where([['category_id','=',$categ_id],["product_name","like","%$searched%"]])->get();
            if (count($products) > 0) {
                $this->searched_products = $products;
            } else {
                $this->searched_products = [];
            }
          
        }
    }
    public function render()
    {


        return view('livewire.search-product',['searched_products'=>$this->searched_products]);
    }
}
