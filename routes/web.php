<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
})->name('home');
// 
// Route::get('/dashboard', function () {
    // return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
// 

Route::get('details/{product}',[ProductController::class,'show'])->name('product_details');

Route::middleware(['auth','role:admin'])->prefix('product')->group(function(){
    Route::get('/delete/{product}',[ProductController::class,'destroy'])->name('product_delete');
    Route::get('/update/{product}',[ProductController::class,'edit'])->name('product_update');
    Route::get('/deleteImage/{product_id}/{color_id}/{image_id}',[ProductController::class,'delete_product_image'])->name('delete_product_image');
    Route::get('/deleteColor/{product}/{color}',[ProductController::class,'delete_product_color'])->name('delete-product-color');

    Route::post('/addProduct',[ProductController::class,'store'] )->name('addProduct');
    Route::post('/updateFacefront',[ProductController::class,'update_facefront_image'] )->name('update_facefront_image');
    Route::post('/updateSize',[ProductController::class,'update_color_size'] )->name('update_color_size');
    Route::post('/addColor',[ProductController::class,'add_product_color'] )->name('add_product_color');


});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');


});



require __DIR__ . '/auth.php';
