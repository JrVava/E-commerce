<?php

use App\Http\Controllers\ProductCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('/');
Route::get('category-tree-view',[CategoryController::class,'manageCategory'])->name('category');
Route::post('add-category',[CategoryController::class,'addCategory'])->name('add.category');
Route::post('category/delete',[CategoryController::class,'delete'])->name('category.delete');

Route::get('category/edit/{id}',[CategoryController::class,'edit']);

Route::get('product',[ProductController::class,'index'])->name('product');
Route::get('product/create',[ProductController::class,'create'])->name('product.create');
Route::post('add-product',[ProductController::class,'store'])->name('add.product');
Route::get('product/edit/{uuid}',[ProductController::class,'edit'])->name('product.edit');
Route::delete('product/delete/{uuid}',[ProductController::class,'delete'])->name('delete.product');

Route::post('upload-product-images',[ProductImageController::class,'store'])->name('upload.product.images');
Route::delete('delete/product/image/{uuid}/{productUUID}',[ProductImageController::class,'delete'])->name('delete.product.image');
Route::post('add/product/category',[ProductCategoryController::class,"addUpdateCategory"])->name('add.product.category');