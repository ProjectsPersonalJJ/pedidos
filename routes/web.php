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

Route::get('/', function () {
    return view('layout.login');
});

Route::get('/home', function(){
	return view('modules.home');
});

Route::get('/users', function(){
	return view('modules.users');
});

Route::get('/orders', function(){
	return view('modules.orders');
});


Route::get('/config_orders', function(){
	return view('modules.config_orders');
});


Route::get('/products', function(){
	return view('modules.products');
});


Route::get('/suppliers', function(){
	return view('modules.suppliers');
});
