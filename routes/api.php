<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

Route::post('login', [AuthController::class, 'login'])->name('api:login');
Route::post('register', [AuthController::class, 'register'])->name('api:register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('api:logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('api:refresh');
    Route::get('user-profile', [AuthController::class, 'userProfile'])->name('api:user-profile');
    Route::get('test', [UserController::class, 'test'])->name('api:test');
    Route::get('get_cities', [UserController::class, 'get_cities'])->name('api:get_cities');
    Route::get('get_user_donations', [UserController::class, 'get_user_donations'])->name('api:get_user_donations');
    Route::post('get_all_requests', [UserController::class, 'get_all_requests'])->name('api:get_all_requests');
    Route::get('get_user_requests', [UserController::class, 'get_user_requests'])->name('api:get_user_requests');
    Route::post('get_request_donations', [UserController::class, 'get_request_donations'])->name('api:get_request_donations');
});