<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login'])->name('api.users.login');
Route::post('/register', [AuthController::class, 'register'])->name('api.users.register');

Route::post('/categories', [ProductController::class, 'categories'])->name('api.categories');
Route::post('/products/{product}/purchase', [ProductController::class, 'categories'])->name('api.purchase');


Route::middleware(['auth:api'])->group(function () {
    Route::post('/products/{product}/purchase', [ProductController::class, 'purchase'])->name('api.purchase');
    Route::post('/my-order', [OrderController::class, 'my_order'])->name('api.user.my_order');

});
