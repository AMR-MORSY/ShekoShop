<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CartController;

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDevisionController;
use App\Http\Controllers\Admin\ManipulatingProductCreationFormController;

///////////////////products routes///////////////////////////////

Route::middleware(['auth'])->group(function () {

    Route::middleware('permission:store_product')->get('/products/create',[AdminProductController::class,'create'])->name('product.create');
    Route::middleware('permission:view_product')->get('/products',[AdminProductController::class,'index'])->name('product.index');
    Route::middleware('permission:view_product')->get('/products/{product}',[AdminProductController::class,'show'])->name('product.show');
    Route::middleware('permission:update_product')->get('/products/{product}/edit',[AdminProductController::class,'edit'])->name('product.edit');
    Route::middleware('permission:update_product')->post('/products/{product}',[AdminProductController::class,'update'])->name('product.update');
    Route::middleware('permission:store_product')->post('/products',[AdminProductController::class,'store'])->name('product.store');
    Route::middleware('permission:delete_product')->delete('/products/{product}',[AdminProductController::class,'destroy'])->name('product.destroy');
     Route::middleware('permission:update_product')->post('/product/formManipulate',[ManipulatingProductCreationFormController::class,'manipulateForm'])->name('product.manipulateForm');
})->prefix('admin'); 

///////////////////Roles and Permissions///////////////////////

Route::prefix('admin')->middleware(['auth','role:Super-Admin'])->group(function () {

    Route::get('/roles/create',[RoleController::class,'create'])->name('role.create');

    Route::get('/roles',[RoleController::class,'index'])->name('role.index');
    Route::get('/roles/{role}',[RoleController::class,'show'])->name('role.show');
    Route::post('/roles/{role}',[RoleController::class,'update'])->name('role.update');
    Route::get('/roles/{role}/edit',[RoleController::class,'edit'])->name('role.edit');

    Route::post('/roles',[RoleController::class,'store'])->name('role.store');
    Route::delete('/roles/{role}',[RoleController::class,'destroy'])->name('role.destroy');

///////////////////////permission routes////////////////////////////////////////////

    Route::get('/permissions/create',[PermissionController::class,'create'])->name('Permission.create');

    Route::get('/Permissions',[PermissionController::class,'index'])->name('Permission.index');

    Route::post('/Permissions',[PermissionController::class,'store'])->name('Permission.store');
    Route::delete('/Permissions/{Permission}',[PermissionController::class,'destroy'])->name('Permission.destroy');
   
////////////////////////Categories routes///////////////////////////////////////////////////////////

Route::middleware(['auth'])->group(function () {

    Route::middleware('permission:store_category')->get('/categories/create',[AdminCategoryController::class,'create'])->name('category.create');
    Route::middleware('permission:view_category')->get('/categories',[AdminCategoryController::class,'index'])->name('category.index');
    Route::middleware('permission:view_category')->get('/categories/{category}',[AdminCategoryController::class,'show'])->name('category.show');
    Route::middleware('permission:update_category')->get('/categories/{category}/edit',[AdminCategoryController::class,'edit'])->name('category.edit');
    Route::middleware('permission:update_category')->post('/categories/{category}',[AdminCategoryController::class,'update'])->name('category.update');
    Route::middleware('permission:store_category')->post('/categories',[AdminCategoryController::class,'store'])->name('category.store');
    Route::middleware('permission:delete_category')->delete('/categories/{category}',[AdminCategoryController::class,'destroy'])->name('category.destroy');
    Route::middleware('permission:update_category')->post('/categories/images/{category}',[AdminCategoryController::class,'images'])->name('category.images');
   
})->prefix('admin'); 

////////////////////////Devisions routes///////////////////////////////////////////////////////////

Route::middleware(['auth'])->group(function () {

    Route::middleware('permission:store_devision')->get('/devisions/create',[AdminDevisionController::class,'create'])->name('devision.create');
    Route::middleware('permission:view_devision')->get('/devisions',[AdminDevisionController::class,'index'])->name('devision.index');
    Route::middleware('permission:view_devision')->get('/devisions/{devision}',[AdminDevisionController::class,'show'])->name('devision.show');
    Route::middleware('permission:update_devision')->get('/devisions/{devision}/edit',[AdminDevisionController::class,'edit'])->name('devision.edit');
    Route::middleware('permission:update_devision')->post('/devisions/{devision}',[AdminDevisionController::class,'update'])->name('devision.update');
    Route::middleware('permission:store_devision')->post('/devisions',[AdminDevisionController::class,'store'])->name('devision.store');
    Route::middleware('permission:delete_devision')->delete('/devisions/{devision}',[AdminDevisionController::class,'destroy'])->name('devision.destroy');
    Route::middleware('permission:update_devision')->post('/devisions/images/{devision}',[AdminDevisionController::class,'images'])->name('devision.images');
   
})->prefix('admin'); 







//////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/dashboard',function(){
        return view('pages.admin.dashboard');

    })->name('admin.dashboard');
    
}); 
