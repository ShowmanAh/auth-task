<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', \Api\User\RegisterUserController::class);
Route::post('login', \Api\User\LoginUserController::class);
Route::group(['prefix' => 'auth',  'middleware' => 'auth:api'], function()
{
    Route::post('createUser', \Api\User\CreateUserController::class);
   Route::post('/{user}/{slug}', \Api\User\ChangeRoleController::class);
   Route::post('logout', \Api\User\LogoutUserController::class);
});


