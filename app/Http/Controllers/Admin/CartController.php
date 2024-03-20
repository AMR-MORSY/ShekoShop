<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function cart(Request $request)
    {
        dd('hello');
        $id=$request->input('id');
      
        // $this->cartCount=40;
        // return redirect()->route('product.show',["product"=>$id,'cartCount'=>$this->cartCount]);
        
    }

}
