<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product_Catogory;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */



    private function handleCartProducts($id)
    {
        $cookie_products = [];

        $cookie_products = $this->checkCartCookie();

        $cookie_count = count($cookie_products);

        if ($cookie_count > 0) {
            $cart_products = Cart::where('user_id', $id)->get();

            $cart_count = count($cart_products);
            if ($cart_count > 0) {
                $this->compare_cart_cookie_products($cart_products, $cookie_products, $cart_count, $cookie_count, $id);
                $cookie_products = [];
                $minutes = 42300;

                Cookie::queue('product', json_encode($cookie_products), $minutes);
            } else {
                foreach ($cookie_products as $product) {
                    Cart::create([

                        'category_id' => $product['category_id'],
                        'product_id' => $product['product_id'],
                        'color_id' =>  $product["color_id"],
                        'size_id' => $product['size_id'],
                        'quantity' => $product['quantity'],
                        'user_id' => $id

                    ]);
                }

                $cookie_products = [];
                $minutes = 42300;

                Cookie::queue('product', json_encode($cookie_products), $minutes);
            }
        } else {
            $minutes = 42300;

            Cookie::queue('product', json_encode($cookie_products), $minutes);
        }
    }



    private function checkCartCookie()
    {

        $cookie_products = Cookie::get('product');
        $cookie_products = json_decode($cookie_products, true);

        return $cookie_products;
    }

    private function compare_cart_cookie_products($cart_products, $cookie_products, $cart_count, $cookie_count, $user_id)
    {
        $unmatched_products = [];

        for ($x = 0; $x < $cookie_count; $x++) {
            $cart_product = Cart::where('product_id', $cookie_products[$x]["product_id"])->where("size_id", $cookie_products[$x]["size_id"])->where('color_id', $cookie_products[$x]["color_id"])->where('category_id', $cookie_products[$x]["category_id"])->first();
         
            if ($cart_product) {
                $old_quantity = $cart_product->quantity;
                $new_quantity = $old_quantity + $cookie_products[$x]['quantity'];
                $cart_product->quantity = $new_quantity;
                $cart_product->save();
            } else {
                array_push($unmatched_products, $cookie_products[$x]);
            }
        }


        $count_unmatched = count($unmatched_products);

        if ($count_unmatched > 0) {



            foreach ($unmatched_products as $product) {
                Cart::create([

                    'category_id' => $product['category_id'],
                    'product_id' => $product['product_id'],
                    'color_id' =>  $product["color_id"],
                    'size_id' => $product['size_id'],
                    'quantity' => $product['quantity'],
                    'user_id' => $user_id

                ]);
            }
        }
    }



    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $id = Auth::user()->id;
        $user = User::find($id);

        $this->handleCartProducts($id);


        if ($user->hasRole('admin')) {
            return redirect('dashboard');;
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
