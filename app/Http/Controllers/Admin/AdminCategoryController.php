<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Devision;
use App\Services\StoreImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('images')->get();

     
        return view('pages.admin.RolesOrPermissions', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $devisions=Devision::all();
        return view('pages.admin.createDevisionCategoryForm',['devisions'=>$devisions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->safe()->except(['images']);

        $category =Category::create($validated);



        $storeImage=new StoreImage($request,$category,'App\Models\Category');
        $storeImage->storeImage();
      

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('pages.admin.viewDevision')->with(["category" => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $devisions=Devision::all();
        return view('pages.admin.createDevisionCategoryForm',['category'=>$category,'devisions'=>$devisions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $validated=$request->validated();
        $category->update($validated);
        $category->save();
        return redirect()->route('category.show', ["category" => $category->id])->with('status', 'Updated Succefully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'redirect' => route('category.index')
        ], 200);
        
    }
}
