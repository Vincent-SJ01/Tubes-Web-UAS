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
Route::get('paket', 'Api\PaketController@index');

Route::post('registerUser', 'Api\AuthController@registerUser');
Route::post('registerKurir', 'Api\AuthController@registerKurir');
Route::post('login', 'Api\AuthController@login');
Route::post('logoutUser', 'Api\AuthController@logoutUser');
Route::post('logoutKurir', 'Api\AuthController@logoutKurir');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user', 'Api\AuthController@user');
    Route::get('kurir', 'Api\AuthController@kurir');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
