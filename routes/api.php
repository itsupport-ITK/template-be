<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SettingAPIController;
use App\Http\Controllers\Api\UserAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register']);

});

Route::middleware('auth:api', 'set_locale')->group(function () {

    Route::group(['prefix' => 'auth'], function () {

        Route::get('profile', [AuthController::class, 'profile'])->middleware('auth:api');
        Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::middleware('can:admin')->group(function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('list', [UserAPIController::class, 'list']);
            Route::post('store', [UserAPIController::class, 'store']);
            Route::put('update/{user}', [UserAPIController::class, 'update']);
            Route::delete('delete/{user}', [UserAPIController::class, 'delete']);
        });
    });

    // Route::group(['prefix' => 'setting'], function () {
    Route::group(['prefix' => 'setting'], function () {
        Route::get('list', [SettingAPIController::class, 'list']);
        Route::get('language/list', [SettingAPIController::class, 'languages']);
        Route::put('update/{settings}', [SettingAPIController::class, 'update']);
    });
});