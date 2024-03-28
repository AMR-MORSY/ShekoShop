<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormCreationManipulationRequest;
use App\Models\Devision;
use Illuminate\Http\Request;

class ManipulatingProductCreationFormController extends Controller
{
    public function manipulateForm(ProductFormCreationManipulationRequest $request)
    {
       
        $validated=$request->validated();
        $devision=Devision::find($validated["devision_id"]);
        $displayAttribute=false;
        if($devision->id==1)
        {
            $displayAttribute=true;
        }
        $categories=$devision->categories;

        return back()->with(['displayAttribute'=>$displayAttribute,"categories"=>$categories,"devision"=>$devision]);

    }
}
