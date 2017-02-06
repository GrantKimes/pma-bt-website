<?php

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

use App\SV_Order;


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/concerts', function () {
    return view('concerts');
})->name('concerts');

Route::get('/sv', function () {
    return view('sv');
})->name('sv');

Route::get('/botb', function () {
    return view('botb');
})->name('botb');


// Controllers are app/Http/Controllers
Route::get('/sv/order', 'SVController@create')->name('create_order')->middleware('auth');
Route::get('/sv/view', 'SVController@viewOrders')->name('view_orders')->middleware('auth');
Route::get('/sv/login', 'SVController@login')->name('sv_login');



// Post method for form submission
Route::post('/sv', 'SVController@store')->name('store_order');




Route::get('/', function () {
    return view('homepage');
})->name('home');



// If route functions become large, use Controllers (app/Http/Controllers)

/* For anything requiring login:
Route::group(['middleware' => 'auth'], function() { 
	Route::get(...)
}); */


// Auto generated auth routing
Auth::routes();
Route::get('/home', 'HomeController@index');
