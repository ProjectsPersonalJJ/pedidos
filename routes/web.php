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

Route::middleware('guest')->group(function(){

	Route::get('/', 'LoginController@index');

	Route::post('/', 'LoginController@authenticate');

	Route::get('/signin', 'LoginController@signIn');

	Route::post('/signin', 'LoginController@store');

});

Route::middleware('auth')->group(function(){

	Route::get('/home', function(){
		return view('modules.home', ['module'=>0, 'authorize'=>true]);
	});

	Route::resource('/users', 'UserController');

	Route::get('/permissions', 'UserController@getPermissions');

	Route::get('/logout', function(){
		Auth::logout();
		return view('layout.login');
	});
});



Route::get('/orders', function(){
	return view('modules.orders');
});


Route::resource('/config_orders', 'ConfigOrderController');

//Products model
Route::resource('/products', 'ProductController');


Route::resource('/suppliers', 'SupplierController');




