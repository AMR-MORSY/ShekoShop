<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Government;
use App\Models\Payment;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartController $cart)
    {
        $payments = Payment::all();
        $states = State::all();
        $governments = Government::all();

        if (!isset($_COOKIE['products']) and !Auth()->user()) {
            return redirect()->route('cart.index');
        } elseif (auth()->user()) {
            $user = Auth()->user();


            if (count($user->cart_products) > 0 or isset($_COOKIE['products'])) {

                return view('pages.users.Checkout', ["user" => $user, "payment_methods" => $payments, "governments" => $governments, "states" => $states]);
            } else {
                return redirect()->route('cart.index');
            }
        } elseif (isset($_COOKIE['products']) and !Auth()->user()) {
            return view('pages.users.Checkout', [ "payment_methods" => $payments, "governments" => $governments, "states" => $states]);
        }
    }


    public function getStatesAndShipping(Government $government)
    {
        $states = $government->states;
        return response()->json([
            'states' => $states
        ]);
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
    public function show(string $id)
    {
        //
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
