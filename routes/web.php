<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dashboard',[AuthController::Class,'dashboard']);
Route::get('/',[AuthController::class,'index']);
Route::post('signin',[AuthController::class,'login']);
Route::get('signup', [AuthController::class, 'register']);
Route::post('registation', [AuthController::class, 'reg']);
Route::get('signout',[AuthController::Class,'signout']);

