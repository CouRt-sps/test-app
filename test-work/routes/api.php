<?php

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PasswordGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

//Route::group(['namespace' => 'PasswordGroup', 'prefix' => 'group'], function () {
//    Route::post('/', [StoreController::class]);
//});
Route::post('/group', [PasswordGroupController::class, 'addGroup'])->name('add.group');
Route::get('/group', [PasswordGroupController::class, 'listGroup']);
Route::get('/passwords', [PasswordController::class, 'listPassword']);
Route::post('/passwords', [PasswordController::class, 'addPassword'])->name('add.password');
Route::get('/generation', [PasswordController::class, 'generationPassword']);
Route::get('/users', [UserController::class, 'listUser']);
Route::post('/users', [UserController::class, 'addUser']);
Route::patch('/users/{user}', [UserController::class, 'updateUser']);
Route::delete('/users/{user}', [UserController::class, 'deleteUser']);
