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
Route::get('/dashboard/profile/password/edit', 'ProfileController@editpassword')->name('profile.editpassword')->middleware(['password.confirm']);
Route::patch('/dashboard/profile/password', 'ProfileController@updatepassword')->name('profile.updatepassword');
Route::delete('/dashboard/profile', 'ProfileController@destroy')->name('profile.delete');