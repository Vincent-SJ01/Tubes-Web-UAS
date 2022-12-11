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
Route::post('registerAdmin', 'Api\AuthController@registerAdmin');
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

Route::get('droppoint', 'Api\DroppointController@index')->middleware(['auth:admins-api,kurirs-api,api']);
Route::get('droppoint/{id}', 'Api\DroppointController@show')->middleware(['auth:admins-api,kurirs-api,api']);
Route::post('droppoint', 'Api\DroppointController@store')->middleware(['auth:admins-api']);
Route::put('droppoint/{id}', 'Api\DroppointController@update')->middleware(['auth:admins-api']);
Route::delete('droppoint/{id}', 'Api\DroppointController@destroy')->middleware(['auth:admins-api']);

Route::get('user', 'Api\UserController@index')->middleware(['auth:admins-api,kurirs-api,api']);
Route::get('user/{id}', 'Api\UserController@show')->middleware(['auth:admins-api']);
Route::post('user', 'Api\UserController@store')->middleware(['auth:admins-api']);
Route::put('user/{id}', 'Api\UserController@update')->middleware(['auth:admins-api']);
Route::delete('user/{id}', 'Api\UserController@destroy')->middleware(['auth:admins-api']);

Route::get('admin', 'Api\AdminController@index')->middleware(['auth:admins-api']);
Route::get('admin/{id}', 'Api\AdminController@show')->middleware(['auth:admins-api']);
Route::post('admin', 'Api\AdminController@store')->middleware(['auth:admins-api']);
Route::put('admin/{id}', 'Api\AdminController@update')->middleware(['auth:admins-api']);
Route::delete('admin/{id}', 'Api\AdminController@destroy')->middleware(['auth:admins-api']);

Route::get('kurir', 'Api\KurirController@index')->middleware(['auth:admins-api, kurirs-api']);
Route::get('kurir/{id}', 'Api\KurirController@show')->middleware(['auth:admins-api']);
Route::post('kurir', 'Api\KurirController@store')->middleware(['auth:admins-api']);
Route::put('kurir/{id}', 'Api\KurirController@update')->middleware(['auth:admins-api']);
Route::delete('kurir/{id}', 'Api\KurirController@destroy')->middleware(['auth:admins-api']);

Route::get('penghantaran', 'Api\PenghantaranController@index')->middleware(['auth:admins-api,kurirs-api,api']);
Route::get('penghantaran/{id}', 'Api\PenghantaranController@show')->middleware(['auth:admins-api,kurirs-api,api']);
Route::post('penghantaran', 'Api\PenghantaranController@store')->middleware(['auth:admins-api,kurirs-api,api']);
Route::put('penghantaran/{id}', 'Api\PenghantaranController@update')->middleware(['auth:admins-api,kurirs-api,api']);
Route::delete('penghantaran/{id}', 'Api\PenghantaranController@destroy')->middleware(['auth:admins-api,kurirs-api,api']);

Route::get('paket', 'Api\PaketController@index')->middleware(['auth:admins-api,kurirs-api,api']);
Route::get('paket/{id}', 'Api\PaketController@show')->middleware(['auth:admins-api,kurirs-api,api']);
Route::post('paket', 'Api\PaketController@store')->middleware(['auth:admins-api,kurirs-api,api']);
Route::put('paket/{id}', 'Api\PaketController@update')->middleware(['auth:admins-api,kurirs-api,api']);
Route::delete('paket/{id}', 'Api\PaketController@destroy')->middleware(['auth:admins-api,kurirs-api,api']);

Route::get('kota', 'Api\KotaController@index')->middleware(['auth:admins-api,kurirs-api,api']);
Route::get('kota/{id}', 'Api\KotaController@show')->middleware(['auth:admins-api,kurirs-api,api']);
Route::post('kota', 'Api\KotaController@store')->middleware(['auth:admins-api']);
Route::put('kota/{id}', 'Api\KotaController@update')->middleware(['auth:admins-api']);
Route::delete('kota/{id}', 'Api\KotaController@destroy')->middleware(['auth:admins-api']);

Route::get('service', 'Api\ServiceController@index')->middleware(['auth:admins-api,kurirs-api,api']);

Route::get('role', 'Api\RoleController@index')->middleware(['auth:admins-api']);

Route::get('gender', 'Api\GenderController@index')->middleware(['auth:admins-api,kurirs-api,api']);

Route::get('status', 'Api\StatusController@index')->middleware(['auth:admins-api,kurirs-api,api']);

Route::get('statuspaket', 'Api\StatusPaketController@index')->middleware(['auth:admins-api,kurirs-api']);

Route::get('jenispaket', 'Api\JenisPaketController@index')->middleware(['auth:admins-api,kurirs-api']);

// Route::group(['middleware' => ['auth:api']], function(){
//     Route::get('user', 'Api\AuthController@user');
//     Route::get('kurir', 'Api\AuthController@kurir');
//     Route::get('droppoint', 'Api\DroppointController@index');
//     Route::get('droppoint/{id}', 'Api\DroppointController@show');
//     Route::post('droppoint', 'Api\DroppointController@store');
//     Route::put('droppoint/{id}', 'Api\DroppointController@update');
//     Route::delete('droppoint/{id}', 'Api\DroppointController@destroy');
// });

// Route::group(['middleware' => ['auth:kurirs-api']], function(){
//     Route::get('user', 'Api\AuthController@user');
//     Route::get('kurir', 'Api\AuthController@kurir');
//     Route::get('droppoint', 'Api\DroppointController@index');
//     Route::get('droppoint/{id}', 'Api\DroppointController@show');
//     Route::post('droppoint', 'Api\DroppointController@store');
//     Route::put('droppoint/{id}', 'Api\DroppointController@update');
//     Route::delete('droppoint/{id}', 'Api\DroppointController@destroy');
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

