<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCartProductRequest;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view("pages.users.Cart");
    }


    public function addCartProduct(AddCartProductRequest $request)
    {
        return response()->json(
            $request
        );

    }
}
