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