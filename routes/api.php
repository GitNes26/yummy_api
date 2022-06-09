<?php

use App\Http\Controllers;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login',[UserController::class,'login']);

Route::middleware('auth:sanctum')->controller(UserController::class)->group(function () {
    Route::get('/users','index');           //mostrar lista
    Route::get('/users/{id}','show');       //mostrar objeto
    Route::post('/users','store');          //crear objeto
    Route::put('/users','update');          //actualizar objeto
    Route::delete('/users/{id}','destroy'); //eliminar (cambiar activo=false)
});

Route::middleware('auth:sanctum')->controller(RoleController::class)->group(function () {
    Route::get('/roles','index');
    Route::get('/roles/{id}','show');
    Route::post('/roles','store');
    Route::put('/roles','update');
    Route::delete('/roles/{id}','destroy');
});

Route::middleware('auth:sanctum')->controller(ProductController::class)->group(function () {
    Route::get('/products','index');
    Route::get('/products/{id}','show');
    Route::post('products','store');
    Route::put('products','update');
    Route::delete('products/{id}','destroy');
});
Route::middleware('auth:sanctum')->controller(RecipeController::class)->group(function () {
    Route::get('/recipes','index');
    Route::get('/recipes/{id}','show');
    Route::post('/recipes','store');
    Route::put('/recipes','update');
    Route::delete('/recipes/{id}','destroy');
});

Route::middleware('auth:sanctum')->controller(CategoryController::class)->group(function (){
    Route::get('/categories','index');
    Route::get('/categories/{id}','show');
    Route::post('/categories','store');
    Route::put('/categories','update');
    Route::delete('/categories/{id}','destroy');
});

/*Route::middleware('auth:sanctum')->controller(OrderController::class)->group(function (){
    Route::get('/orders','index');
    Route::get('/orders/{id}','show');
    Route::delete('/orders/{id}','destroy');
});*/

Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);