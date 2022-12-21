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

Route::post('registerUser', 'Api\AuthController@registerUser');
Route::post('registerKurir', 'Api\AuthController@registerKurir');
Route::post('login', 'Api\AuthController@login');
Route::post('logoutUser', 'Api\AuthController@logoutUser');
Route::post('logoutKurir', 'Api\AuthController@logoutKurir');


// Route::get('droppoint', 'Api\DroppointController@index')->middleware('auth:api', 'auth:kurirs-api');
// Route::group(['middleware' => 'auth:kurirs-api'], function(){
//     Route::get('user', 'Api\AuthController@user');
//     Route::get('kurir', 'Api\AuthController@kurir');
//     Route::get('droppoint', 'Api\DroppointController@index');
//     Route::get('droppoint/{id}', 'Api\DroppointController@show');
//     Route::post('droppoint', 'Api\DroppointController@store');
//     Route::put('droppoint/{id}', 'Api\DroppointController@update');
//     Route::delete('droppoint/{id}', 'Api\DroppointController@destroy');
// });

Route::group(['middleware' => 'auth:kurirs-api'], function(){
    Route::get('user', 'Api\AuthController@user');
    Route::get('kurir', 'Api\AuthController@kurir');
    Route::get('droppoint', 'Api\DroppointController@index');
    Route::get('droppoint/{id}', 'Api\DroppointController@show');
    Route::post('droppoint', 'Api\DroppointController@store');
    Route::put('droppoint/{id}', 'Api\DroppointController@update');
    Route::delete('droppoint/{id}', 'Api\DroppointController@destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
