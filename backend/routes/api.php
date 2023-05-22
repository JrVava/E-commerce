<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login',[LoginController::class,'login']);

Route::middleware('auth.api')->group(function () {
    // Protected routes here
    Route::get('products',[ProductController::class,'index']);
    Route::get('category-list',[CategoryController::class,'list']);
    Route::get('categories',[CategoryController::class,'index']);
    Route::get('category/{uuid}',[CategoryController::class,'categoryWithslug']);
});
// Route::get('protected-route', 'ApiController@protectedMethod')->middleware('auth:api');
