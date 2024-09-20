<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Users\CartController ;
use App\Http\Controllers\Users\CheckoutController;
use App\Http\Controllers\Users\CheckProductAvailabiltyController;
use App\Http\Controllers\Users\OrderController;
use App\Http\Controllers\Users\UsersProductController;
use App\Http\Controllers\Users\UsersCategoryController;
use App\Http\Controllers\Users\UsersDevisionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
// */



require __DIR__.'/admin.php';

require __DIR__.'/auth.php';



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/',[UsersProductController::class,'index'])->name('home');


    
Route::get('search/{search?}',[UsersProductController::class,'search'])->name('products.search');



    /////////////////////////////////////////checkout controller ///////////////////
Route::get ('checkout',[CheckoutController::class,'index'])->name('checkout.index');
Route::get('checkout/{government}',[CheckoutController::class,'getStatesAndShipping']);
Route::get('{product:slug}/{index}/edit',[UsersProductController::class,'edit'])->name('usersProduct.edit');////////this route is used to show the cart product in localstorage that is need to be eideted


/////////////////////////////Cart Controller/////////////////////////////

Route::get ('cart',[CartController::class,'index']);
Route::post('addCartProduct',[CartController::class,'addCartProduct']);
Route::post('addCartProducts',[CartController::class,'addCartProducts']);
Route::get('getAuthUserCartProducts',[CartController::class,'getAuthUserCartProducts']);

Route::delete('deleteCartProduct/{cartProduct}',[CartController::class,'delete']);////////this route is used to show the cart product in database that is need to be eideted
Route::put('updateCartProduct/{cartProduct}',[CartController::class,'updateCartProduct']);
// ///////////////////////////Devisions Routes//////////////////////


Route::get('{devision:slug}/{category:slug}',[UsersCategoryController::class,'show'])->name('usersCategory.show');
Route::get('{devision:slug}/{category:slug}/{product:slug}',[UsersProductController::class,'show'])->name('usersProduct.show');


Route::get('{devision:slug}',[UsersDevisionController::class,'show'])->name('usersDevision.show');

//////////////////////////////checking product availability//////////////////

Route::post('checkProductAvailability',[CheckProductAvailabiltyController::class,'checkProductAvailability']);
Route::post('checkProductsAvailability',[CheckProductAvailabiltyController::class,'checkProductsAvailability']);





