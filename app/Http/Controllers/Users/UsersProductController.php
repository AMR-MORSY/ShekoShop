<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Devision;
use App\Models\Option;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class UsersProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devisions=Devision::all();
        $categories=Category::All();
       
        return view("welcome",['categories'=>$categories,'devisions'=>$devisions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Devision $devision ,Category $category,Product $product)
    {
        $sizes=Size::all();
        $options=Option::all();
       
        return view('pages.users.Product',['product'=>$product,'sizes'=>$sizes,'options'=>$options]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
