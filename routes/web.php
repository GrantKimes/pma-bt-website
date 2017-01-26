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


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/sv', function () {
    return view('sv');
})->name('sv');

Route::get('/botb', function () {
    return view('botb');
})->name('botb');



Route::get('/', function () {
    return view('home');
})->name('home');



// If route functions become large, use Controllers (app/Http/Controllers)

/* For anything requiring login:
Route::group(['middleware' => 'auth'], function() { 
	Route::get(...)
}); */