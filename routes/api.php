<?php

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

Route::resource('leads', 'LeadController');
Route::post('leads/{id}', 'LeadController@update');

Route::resource('user', 'UseController');

Route::resource('doctor', 'DoctorController');
Route::post('doctor/{id}', 'DoctorController@update');

Route::get('/pictures/{path}/{image}', 'StorageController@getImage');
