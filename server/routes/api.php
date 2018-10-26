<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/categories',\App\Categories\Actions\IndexCategoriesAction::class);
Route::get('/products',\App\Products\Actions\IndexProductsAction::class);
Route::get('/products/{product}',\App\Products\Actions\ShowProductAction::class);