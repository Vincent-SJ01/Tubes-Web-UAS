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
// Route::get('/email/verify/need-verfication', 'Api\EmailRegisterLoginController@notice')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', 'Api\EmailRegisterLoginController@verify')->name('verification.verify');
Route::post('registerKurir', 'Api\AuthController@registerKurir');
Route::post('registerAdmin', 'Api\AuthController@registerAdmin');
Route::post('login', 'Api\AuthController@login');
Route::post('logout', 'Api\AuthController@logout')->middleware(['auth:admins-api,kurirs-api,api']);

Route::get('droppoint', 'Api\DropPointController@index')->middleware(['auth:admins-api,kurirs-api,api']);
Route::get('droppoint/{id}', 'Api\DropPointController@show')->middleware(['auth:admins-api,kurirs-api,api']);
Route::post('droppoint', 'Api\DropPointController@store')->middleware(['auth:admins-api']);
Route::put('droppoint/{id}', 'Api\DropPointController@update')->middleware(['auth:admins-api']);
Route::delete('droppoint/{id}', 'Api\DropPointController@destroy')->middleware(['auth:admins-api']);

Route::get('user', 'Api\UserController@index')->middleware(['auth:admins-api']);
Route::get('userprofile', 'Api\UserController@show')->middleware(['auth:admins-api,api']);
Route::put('user', 'Api\UserController@update')->middleware(['auth:admins-api,api']);
Route::delete('user/{id}', 'Api\UserController@destroy')->middleware(['auth:admins-api,api']);
Route::put('userpassword', 'Api\UserController@updatePassword')->middleware(['auth:admins-api,api']);

Route::get('admin', 'Api\AdminController@index')->middleware(['auth:admins-api']);
Route::get('admin/{id}', 'Api\AdminController@show')->middleware(['auth:admins-api']);
Route::put('admin/{id}', 'Api\AdminController@update')->middleware(['auth:admins-api']);
Route::delete('admin/{id}', 'Api\AdminController@destroy')->middleware(['auth:admins-api']);

Route::get('kurir', 'Api\KurirController@index')->middleware(['auth:admins-api']);
Route::get('kurirprofile', 'Api\KurirController@show')->middleware(['auth:admins-api,kurirs-api']);
Route::put('kurir/{id}', 'Api\KurirController@update')->middleware(['auth:admins-api,kurirs-api']);
Route::delete('kurir/{id}', 'Api\KurirController@destroy')->middleware(['auth:admins-api,kurirs-api']);

Route::get('pengantaran', 'Api\PengantaranController@index')->middleware(['auth:admins-api,kurirs-api,api']);
Route::get('pengantaranbykurir', 'Api\PengantaranController@showbykurir')->middleware(['auth:admins-api,kurirs-api']);
Route::get('pengantaran/{id}', 'Api\PengantaranController@show')->middleware(['auth:admins-api,kurirs-api,api']);
Route::put('updatestatuspengantaran/{noresi}_{date}', 'Api\PengantaranController@updateStatus')->middleware(['auth:admins-api,kurirs-api']);
Route::post('pengantaran', 'Api\PengantaranController@store')->middleware(['auth:admins-api,kurirs-api,api']);

Route::get('paket', 'Api\PaketController@index')->middleware(['auth:admins-api,kurirs-api,api']);
Route::get('paket/{id}', 'Api\PaketController@show')->middleware(['auth:admins-api,kurirs-api,api']);
Route::get('paketbyuser', 'Api\PaketController@showbyUser')->middleware(['auth:admins-api,kurirs-api,api']);
Route::post('paket', 'Api\PaketController@store')->middleware(['auth:admins-api,api']);
Route::put('paket/{id}', 'Api\PaketController@update')->middleware(['auth:admins-api,kurirs-api,api']);
Route::put('updatestatuspaket/{id}', 'Api\PaketController@updateStatus')->middleware(['auth:admins-api,kurirs-api']);
Route::delete('paket/{id}', 'Api\PaketController@destroy')->middleware(['auth:admins-api,api']);

Route::get('kota', 'Api\KotaController@index')->middleware(['auth:admins-api,kurirs-api,api']);
Route::get('kota/{id}', 'Api\KotaController@show')->middleware(['auth:admins-api,kurirs-api,api']);
Route::post('kota', 'Api\KotaController@store')->middleware(['auth:admins-api']);
Route::put('kota/{id}', 'Api\KotaController@update')->middleware(['auth:admins-api']);
Route::delete('kota/{id}', 'Api\KotaController@destroy')->middleware(['auth:admins-api']);

Route::get('service', 'Api\ServiceController@index')->middleware(['auth:admins-api,kurirs-api,api']);

Route::get('role', 'Api\RoleController@index')->middleware(['auth:admins-api,kurirs-api,api']);

Route::get('gender', 'Api\GenderController@index')->middleware(['auth:admins-api,kurirs-api,api']);

Route::get('status', 'Api\StatusController@index')->middleware(['auth:admins-api,kurirs-api,api']);

Route::get('statuspengantaran', 'Api\StatusPengantaranController@index')->middleware(['auth:admins-api,kurirs-api']);

Route::get('statuspaket', 'Api\StatusPaketController@index')->middleware(['auth:admins-api,kurirs-api']);

Route::get('jenispaket', 'Api\JenisPaketController@index')->middleware(['auth:admins-api,kurirs-api,api']);

Route::get('printresi/{id}', 'Api\PdfController@resiPaket')->middleware(['auth:admins-api,api']);

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

