<?php

use App\Http\Controllers;
use App\Http\Controllers\BranchOfficeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Models\Order_details;
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

    Route::delete('/logout/{id}','logout'); //cerrar sesión (eliminar los tokens creados)
});

Route::middleware('auth:sanctum')->controller(RoleController::class)->group(function () {
    Route::get('/roles','index');
    Route::get('/roles/{id}','show');
    Route::post('/roles','store');
    Route::put('/roles','update');
    Route::delete('/roles/{id}','destroy');
});

Route::middleware('auth:sanctum')->controller(BranchOfficeController::class)->group(function () {
    Route::get('/branch_offices','index');
    Route::get('/branch_offices/{id}','show');
    Route::post('/branch_offices','store');
    Route::put('/branch_offices','update');
    Route::delete('/branch_offices/{id}','destroy');
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

Route::middleware('auth:sanctum')->controller(OrderController::class)->group(function (){
    Route::get('/orders','index');
    Route::get('/orders/{id}','show');
    Route::post('/orders','store');
    Route::put('/orders','update');
    Route::delete('/orders/{id}','destroy');

    Route::put('/orders/statusUpdate','statusUpdate');

});

Route::middleware('auth:sanctum')->controller(RecipeController:: class)->group(function (){
    Route::get('/recipes','index');
    Route::get('/recipes/{id}','show');
    Route::post('/recipes','store');
    Route::put('/recipes','update');
    Route::delete('/recipes/{id}','destroy');
});

Route::middleware('auth:sanctum')->controller(OrderDetailsController:: class)->group(function (){
    Route::get('/orderD','index');
    Route::get('/orderD/{id}','show');
    Route::post('/orderD','store');
    Route::put('/orderD','update');
    Route::delete('/orderD/{id}','destroy');
});
