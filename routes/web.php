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
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

// Profile
Route::get('/dashboard/profile', 'ProfileController@index')->name('profile.index');
Route::get('/dashboard/profile/edit', 'ProfileController@edit2')->name('profile.edit');
Route::patch('/dashboard/profile', 'ProfileController@update')->name('profile.update');
Route::get('/dashboard/profile/login/edit', 'ProfileController@editlogin')->name('profile.editlogin')->middleware(['password.confirm']);
Route::patch('/dashboard/profile/updatelogin', 'ProfileController@updatelogin')->name('profile.updatelogin');
Route::delete('/dashboard/profile', 'ProfileController@destroy')->name('profile.delete');

// Users
Route::get('/dashboard/users', 'UsersController@index')->name('users.index');
Route::get('/dashboard/user/{id}', 'UsersController@show')->name('users.show');
Route::get('/dashboard/user/{id}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/dashboard/user/{id}', 'UsersController@update')->name('users.update');
Route::delete('/dashboard/users/{id}', 'UsersController@destroy')->name('users.delete');

// Menus
Route::get('/dashboard/menus', 'MenusController@index')->name('menus.index');
Route::get('/dashboard/menu/{id}', 'MenusController@show')->name('menus.show');
Route::patch('/dashboard/menu/{id}', 'MenusController@update')->name('menus.update');
Route::get('/dashboard/menu/{id}/edit', 'MenusController@edit')->name('menus.edit');
Route::post('/dashboard/menus', 'MenusController@store')->name('menus.store');
Route::delete('/dashboard/menus/{id}', 'MenusController@destroy')->name('menus.destroy');

// Orders
Route::get('/dashboard/orders', 'OrdersController@index')->name('orders.index');
Route::post('/dashboard/orders', 'OrdersController@store')->name('orders.store');
Route::delete('/dashboard/orders', 'OrdersController@destroy')->name('orders.destroy');
Route::delete('/dashboard/orders/{id}', 'OrdersController@destroyOne')->name('orders.destroyOne');
Route::get('/dashboard/order/{id}/edit', 'OrdersController@edit')->name('orders.edit');
Route::patch('/dashboard/order/{id}', 'OrdersController@update')->name('orders.update');
Route::get('/dashboard/order/{id}', 'OrdersController@show')->name('orders.show');
Route::get('/dashboard/order', 'OrdersController@redirect')->name('orders.redirect');