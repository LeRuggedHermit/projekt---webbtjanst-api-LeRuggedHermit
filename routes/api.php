<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Product_Controller;
use App\Http\Controllers\StaffController;
use Illuminate\Auth\Events\Logout;
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

//Sanctumskyddade route till produkt-kategorierna - kräver token.
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('products', Product_Controller::class);
});
Route::resource('staff', StaffController::class)->middleware('auth:sanctum');
Route::post('/logout', [Authcontroller::class, 'logout'])->middleware('auth:sanctum') ;

//public Routes
Route::post('/login', [Authcontroller::class, 'login']);
Route::post('/register', [Authcontroller::class, 'register']);



//Route för Sanctum
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
