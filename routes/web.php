<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
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
Route::get('/',[UsersProductController::class,'index']);
Route::get('/checkout',[OrderController::class,'index'])->name('checkout');
require __DIR__.'/admin.php';

require __DIR__.'/auth.php';


// ///////////////////////////Devisions Routes//////////////////////

Route::get('/{devision:slug}',[UsersDevisionController::class,'show'])->name('usersDevision.show');
Route::get('/{devision:slug}/{category:slug}',[UsersCategoryController::class,'show'])->name('usersCategory.show');
Route::get('{devision:slug}/{category:slug}/{product:slug}',[UsersProductController::class,'show'])->name('usersProduct.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

