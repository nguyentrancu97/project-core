<?php

use App\Http\Middleware\ApiAccessPermission;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;

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

Route::group(['prefix' => 'users'], function () {
    Route::post('login', 'UserController@login');
});

Route::group(['middleware' => [JwtMiddleware::class, ApiAccessPermission::class]], function () {

});
