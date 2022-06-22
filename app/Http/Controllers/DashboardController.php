<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;

use Illuminate\Http\Request;

use App\Models\Size;

class DashboardController extends Controller
{
    public function index()

    {
        $product_categories=Category::all();
        $colors=Color::all();
        $sizes=Size::all();
        return view('dashboard',['product_categories'=>$product_categories,'colors'=>$colors,'sizes'=>$sizes]);
    }
}
