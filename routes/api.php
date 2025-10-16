<?php

use App\Http\Controllers\APIController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('listHospital/{id?}',[APIController::class,'getData'])->middleware('guard');
Route::post('add',[APIController::class,'addHospital']);
Route::delete('delete/{id}',[APIController::class,'deleteHospital']);
Route::get('search/{hospital_name}',[APIController::class,'searchHospital']);
Route::put('update',[APIController::class,'updateHospital']);
