<?php

namespace App\Http\Controllers\Admin;

use App\Models\Devision;
use App\Services\StoreImage;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Http\Requests\DevisionRequest;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\ImagesUploadRequest;

class AdminDevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devisions = Devision::with('images')->get();

     

        return view('pages.admin.RolesOrPermissions', ['devisions' => $devisions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.createDevisionCategoryForm');
    }

    
    public function store(DevisionRequest $request)
    {
        $validated = $request->safe()->except(['images']);

        $devision = Devision::create($validated);



        $storeImage=new StoreImage($request,$devision,'App\Models\Devision');
        $storeImage->storeImage();
      

        return redirect()->route('devision.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Devision $devision)
    {
      
        return view('pages.admin.viewDevision')->with(["devision" => $devision]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Devision $devision)
    {
        return view('pages.admin.createDevisionCategoryForm',['devision'=>$devision]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DevisionRequest $request, Devision $devision)
    {
        $validated=$request->validated();
       $devision->update($validated);
       $devision->save();
        return redirect()->route('devision.show', ["devision" =>$devision->id])->with('status', 'Updated Succefully');
    }
    public function images(ImagesUploadRequest $request, Devision $devision)
    {
        $devision->images()->delete();
        $storeImage= new StoreImage($request,$devision,'App\Models\Devision');
        $storeImage->storeImage();

        return response()->json([
            'redirect'=>route('devision.show',["devision" => $devision])
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Devision $devision)
    {
       $devision->delete();
        return response()->json([
            'redirect' => route('devision.index')
        ], 200);
    }
}
