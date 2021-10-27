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
    Route::get('get_blood_types', [UserController::class, 'get_blood_types'])->name('api:get_blood_types');
    Route::get('get_cities', [UserController::class, 'get_cities'])->name('api:get_cities');
    Route::post('get_hospitals', [UserController::class, 'get_hospitals'])->name('api:get_hospitals');
    Route::get('get_notifications', [UserController::class, 'get_notifications'])->name('api:get_notifications');
    Route::get('get_user_donations', [UserController::class, 'get_user_donations'])->name('api:get_user_donations');
    Route::post('get_all_requests', [UserController::class, 'get_all_requests'])->name('api:get_all_requests');
    Route::get('get_user_requests', [UserController::class, 'get_user_requests'])->name('api:get_user_requests');
    Route::get('get_user_requests_fulfilled', [UserController::class, 'get_user_requests_fulfilled'])->name('api:get_user_requests_fulfilled');
    Route::post('get_request_donations', [UserController::class, 'get_request_donations'])->name('api:get_request_donations');
    Route::get('get_user_info', [UserController::class, 'get_user_info'])->name('api:get_user_info');
    Route::post('make_request', [UserController::class, 'make_request'])->name('api:make_request');
    Route::post('close_request', [UserController::class, 'close_request'])->name('api:close_request');
    Route::post('reopen_request', [UserController::class, 'reopen_request'])->name('api:reopen_request');
    Route::post('make_donation', [UserController::class, 'make_donation'])->name('api:make_donation');
    Route::post('accept_donation_request', [UserController::class, 'accept_donation_request'])->name('api:accept_donation_request');
    Route::post('decline_donation_request', [UserController::class, 'decline_donation_request'])->name('api:decline_donation_request');
    Route::post('edit_user_info', [UserController::class, 'edit_user_info'])->name('api:edit_user_info');
    Route::post('fill_health_record', [UserController::class, 'fill_health_record'])->name('api:fill_health_record');
    Route::post('visit_profile', [UserController::class, 'visit_profile'])->name('api:visit_profile');
    Route::get('set_available', [UserController::class, 'set_available'])->name('api:set_available');
    Route::get('set_unavailable', [UserController::class, 'set_unavailable'])->name('api:set_unavailable');
    Route::get('get_chats', [UserController::class, 'get_chats'])->name('api:get_chats');
    Route::post('send_message', [UserController::class, 'send_message'])->name('api:send_message');
    Route::post('upload_image', [UserController::class, 'upload_image'])->name('api:upload_image');
    Route::post('get_request_data', [UserController::class, 'get_request_data'])->name('api:get_request_data');
});