<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MenuApiController;
use App\Http\Controllers\API\RoleApiController;
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\API\AccessApiController;
/*  contoh roles
        *roles:1,2... => 1 dan 2 adalah role id yang diperbolehkan untuk mengakses route ini.
        roles bisa diganti dengan super
*/

// Route menu
Route::group(['prefix' => 'resources', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('menus', MenuApiController::class);
    Route::apiResource('roles', RoleApiController::class);
    Route::apiResource('access', AccessApiController::class);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', [UserApiController::class, 'fetch']);
    Route::post('user', [UserApiController::class, 'update']);
    Route::post('logout', [UserApiController::class, 'logout']);
});

Route::post('register', [UserApiController::class, 'register']);
Route::post('login', [UserApiController::class, 'login']);
