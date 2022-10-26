<?php

use App\Http\Controllers\ActivityApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::group(array('prefix' => 'auth' ),  function () {
    Route::post('register', [ActivityApiController::class, 'register']);
    Route::post('registerAdmin', [ActivityApiController::class, 'registerAdmin']);

    Route::post('login', [ActivityApiController::class, 'login']);
    // ->middleware('auth:sanctum');
});

Route::group(array('prefix' => 'activity' ),  function () {
    Route::post('user-activity', [ActivityApiController::class, 'getUserActivity']);
    // ->middleware('auth:sanctum');
});
