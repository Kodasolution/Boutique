<?php

use App\Http\Controllers\api\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::group(['prefix'=>'v1','middleware' => ['auth:sanctum']], function () {
Route::group(['prefix' => 'v1'], function () {
    //.........Product..................
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductApiController::class, 'index']);
        Route::get('/{product}', [ProductApiController::class, 'show']);
    });
});
