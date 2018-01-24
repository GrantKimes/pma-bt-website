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

// Route::middleware('auth:api')->get('/orders', function(Request $request) {
// 	return array('name'=>"something", "something"=>123);
// });

Route::get('orders', 'OrderController@index')->middleware('cors');
Route::get('orders/{order}', 'OrderController@show');
Route::post('orders', 'OrderController@store');
Route::post('orders/{order}/update', 'OrderController@update');

Route::get('songs', 'SongController@index');
Route::get('songs/{song}', 'SongController@show');
Route::post('songs', 'SongController@store');

Route::get('timeslots', 'TimeslotController@index')->middleware('cors');
Route::get('timeslots/{timeslot}', 'TimeslotController@show');
Route::post('timeslots', 'TimeslotController@store');

