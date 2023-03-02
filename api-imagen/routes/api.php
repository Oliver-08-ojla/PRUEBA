<?php

use App\Http\Controllers\ImageController;
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



//Route::resource('images', ImageController::class);




Route::get('/imagenes',[ImageController::class,'index']);
Route::get('/imagenes/{id}',[ImageController::class,'show']);
Route::post('/imagenes',[ImageController::class,'store']);
Route::post('/imagenes/{id}',[ImageController::class,'update']);
Route::delete('/imagenes/{id}',[ImageController::class,'destroy']); 

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
