<?php

use App\Http\Livewire\Cart;
use App\Http\Livewire\UserCart;
use App\Http\Livewire\UsersCart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\cart\CartController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Orders\OrdersController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\EditProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $cookie = Cookie::get('product');

    if (!$cookie) {
        $product = [];
        $minutes = 43200;

        Cookie::queue('product', json_encode($product), $minutes);
    }

    return view('home');
})->name('home');





Route::get('details/{product}', [ProductController::class, 'show'])->name('product_details');
Route::post('/details', [ProductController::class, 'get_color_details'])->name('get_color_details');
Route::post('/cart', [CartController::class,'delete_product'])->name('delete_cart_product');
Route::post('/addcart', [CartController::class,'add_product'])->name('add_cart_product');
Route::get('/submitOrder', [CartController::class,'submitOrder'])->name('submitOrder');


Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/{user}', [OrdersController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrdersController::class, 'shipping'])->name('shipping');
    Route::post('/order', [OrdersController::class, 'order'])->name('order');
    

});

Route::middleware(['auth', 'role:admin'])->prefix('product')->group(function () {
    Route::get('/delete/{product}', [ProductController::class, 'destroy'])->name('product_delete');
    Route::get('/update/{product}', [ProductController::class, 'edit'])->name('product_update');
    Route::get('/deleteImage/{image}', [ProductController::class, 'delete_product_image'])->name('delete_product_image');
    Route::post('/deleteColor', [ProductController::class, 'delete_color'])->name('delete-product-color');
    Route::post('/addColor', [EditProductController::class, 'add_prod_color'])->name('addColor');
    Route::post('/addProduct', [DashboardController::class, 'store'])->name('addProduct');
    Route::post('/addStock', [DashboardController::class, 'addStock'])->name('addStock');
    Route::post('/updateFacefront', [ProductController::class, 'update_facefront_image'])->name('update_facefront_image');
    Route::post('/updateSizeform', [EditProductController::class, 'update_size_form'])->name('update_size_form');
    Route::post('/addNewSize', [EditProductController::class, 'add_new_size'])->name('add_new_size');
    Route::post('/deleteSize', [EditProductController::class, 'delete_size'])->name('delete_size');
    // Route::post('/addColor', [ProductController::class, 'add_product_color'])->name('add_product_color');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



require __DIR__ . '/auth.php';
