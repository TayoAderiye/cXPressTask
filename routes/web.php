<?php

use App\Http\Controllers\ActivityController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index2']);
Route::post('/auth', [AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register'] );








Route::group(['middleware' => ['customAuth']] , function () {
    Route::get('/home',[ActivityController::class, 'index']);
    Route::post('/createActivity',[ActivityController::class, 'store']);
    Route::get('/deleteActivity/{id}',[ActivityController::class, 'delete']);
    Route::get('/editActivity/{id}',[ActivityController::class, 'getById']);
    Route::post('/updateActivity',[ActivityController::class, 'updateActivity']);
    Route::post('/assignActivity',[ActivityController::class, 'assignActivity']);
    Route::post('/getUserActivities',[ActivityController::class, 'getUserActivities']);
    // Route::post('/createActivity',[ActivityController::class, 'store']);
});
