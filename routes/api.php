<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    MainController,
    ShopController,
    CartController,    
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'pages'], function () {
    Route::get('/index',[MainController::class, 'index']);
    Route::get('/location', [MainController::class, 'location']);
});

Route::group(['prefix' => 'catalog'], function () {
    Route::get('/type/{catalogType}', [ShopController::class, 'getCatalogType']);
    Route::get('/category/{category}',[ShopController::class, 'getCategory']);
    Route::get('/subcategory/{subcategory}',[ShopController::class, 'getSubcategory']);
    Route::get('/product/{product}',[ShopController::class, 'getProduct']);
});

Route::group(['prefix' => 'cart'], function () {
    Route::post('/store', [CartController::class, 'store']);
});