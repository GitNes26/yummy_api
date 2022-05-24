<?php

use App\Http\Controllers;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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