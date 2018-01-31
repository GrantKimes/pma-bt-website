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

Route::get('/singing-valentines', function () {
    return view('singingValentines');
})->name('singingValentines');

Route::get('/botb', function () {
    return view('botb');
})->name('botb');


// Singing valentines system is a little bit weird: it's build with React JS framework, so the 
// logic for each page is contained within the same Javascript file.
// React JS files are at /public/singing-valentines/src/. Run /deploy-react-js.sh script to output js bundle file to /public_html/js/main.js

Route::get('/sv', function() {
	return view('sv.index', ['current_page' => 'index']);
})->middleware('auth');

Route::get('/sv/order', function() {
	return view('sv.index', ['current_page' => 'order']);
})->middleware('auth')->name('create_order');

Route::get('/sv/view', function() {
	return view('sv.index', ['current_page' => 'view']);
})->middleware('auth')->name('view_orders');

Route::get('/sv/edit', function() {
	return view('sv.index', ['current_page' => 'edit']);
})->middleware('auth')->name('edit_orders');

// Controllers are app/Http/Controllers
// Route::get('/sv/order', 'SVController@createPage')->name('create_order')->middleware('auth');
// Route::get('/sv/view', 'SVController@viewOrders')->name('view_orders')->middleware('auth');
// Route::get('/sv/edit', 'SVController@editOrders')->name('edit_orders')->middleware('auth');
// Route::get('/sv/login', 'SVController@login')->name('sv_login');



// Post method for form submission
// Route::post('/sv', 'SVController@store')->name('store_order');




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
// Route::get('/home', 'HomeController@index');
