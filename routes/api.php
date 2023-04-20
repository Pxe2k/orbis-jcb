<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    MainController,
    ShopController,
    CartController,
    ApplicationController,
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
    Route::get('/product/{product}',[ShopController::class, 'getProduct']);
    Route::get('/companies', [ShopController::class, 'allCompanies']);
    Route::get('/categories', [ShopController::class, 'getAllCategoriesWithSubcategories']);
    Route::get('/filter', [ShopController::class, 'filterProducts']);
    Route::get('/products/{ids}', [ShopController::class, 'getProductsByIds']);
});

Route::group(['prefix' => 'cart'], function () {
    Route::post('/store', [CartController::class, 'store']);
});

Route::group(['prefix' => 'application'], function () {
    Route::post('/service', [ApplicationController::class, 'serviceApplicationCreate']);
    Route::post('/career', [ApplicationController::class, 'careerApplicationCreate']);
    Route::post('/price', [ApplicationController::class, 'priceApplicationCreate']);
});
