<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;

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


/**
 * Productos
 * 
 */
Route::controller(ProductoController::class)->group(function () {
    Route::get('productos', 'index');
    Route::get('productos/{id}', 'show');
    Route::post('productos', 'store');
    Route::put('productos/{id}', 'update');
    Route::delete('productos/{id}', 'destroy');
});