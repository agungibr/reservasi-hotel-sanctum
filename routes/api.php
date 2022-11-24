<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\TransaksiController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/hotel', [HotelController::class, 'index']);
    Route::get('/hotel/{id}', [HotelController::class, 'show']);
    Route::resource('hotel', HotelController::class)->except('create', 'edit', 'show', 'index');

    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show']);
    Route::resource('transaksi', TransaksiController::class)->except('create', 'edit', 'show', 'index');
    
    Route::post('/logout', [AuthController::class, 'logout']);
});
