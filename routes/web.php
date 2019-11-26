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

Route::post('/', 'LoginPedidosController@authenticate');

Route::get('/home', function(){
	return view('modules.home');
})->middleware('auth');  

Route::get('/users', function(){
	return view('modules.users',[
		"module"=>2
	]);
});

Route::get('/orders', function(){
	return view('modules.orders');
});


Route::resource('/config_orders', 'ConfigOrderController');

//Products model
Route::resource('/products', 'ProductController');


Route::resource('/suppliers', 'SupplierController');


Route::get('/logout', function(){
	Auth::logout();
	return view('layout.login');
});

