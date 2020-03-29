<?php
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;

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
// Route::get('tes/{name?}', function ($name = null) {
//     return $name;
// })->name('tes');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
// Route::get('/getbrowser', 'HomeController@getBrowser')->name('getBrowser');

// Profile
Route::get('/dashboard/profile', 'ProfileController@index')->name('profile.index');
Route::get('/dashboard/profile/edit', 'ProfileController@edit2')->name('profile.edit');
Route::patch('/dashboard/profile', 'ProfileController@update')->name('profile.update');
Route::get('/dashboard/profile/login/edit', 'ProfileController@editlogin')->name('profile.editlogin')->middleware(['auth', 'password.confirm']);
Route::patch('/dashboard/profile/updatelogin', 'ProfileController@updatelogin')->name('profile.updatelogin');
Route::delete('/dashboard/profile', 'ProfileController@destroy')->name('profile.delete');
Route::get('/dashboard/profile/avatar/edit', 'ProfileController@editAvatar')->name('profile.editAvatar');
Route::post('/dashboard/profile/avatar/update', 'ProfileController@updateAvatar')->name('profile.updateAvatar');
Route::post('/dashboard/profile/avatar/delete', 'ProfileController@deleteAvatar')->name('profile.deleteAvatar');

// Users
Route::get('/dashboard/users', 'UsersController@index')->middleware('admin')->name('users.index');
Route::get('/dashboard/user/{user:username}', 'UsersController@show')->middleware('admin')->name('users.show');
Route::get('/dashboard/user/{user:username}/edit', 'UsersController@edit')->middleware('admin')->name('users.edit');
Route::patch('/dashboard/user/{id}', 'UsersController@update')->middleware('admin')->name('users.update');
Route::delete('/dashboard/users/{id}', 'UsersController@destroy')->middleware('admin')->name('users.delete');

// Search
Route::get('/dashboard/search', 'UsersController@search')->name('users.search');
// Route::get('/dashboard/user/search/username/{username}', 'UsersController@search2')->name('users.search2');
Route::get('/dashboard/{user:username}/payment', 'UsersController@payment')->middleware('admin')->name('users.payment');

// Menus
Route::get('/dashboard/menus', 'MenusController@index')->name('menus.index');
Route::get('/dashboard/menus/deleted', 'MenusController@deleted')->middleware('admin')->name('menus.deleted');
Route::get('/dashboard/menu/{id}', 'MenusController@show')->name('menus.show');
Route::patch('/dashboard/menu/{id}', 'MenusController@update')->middleware('admin')->name('menus.update');
Route::get('/dashboard/menu/{id}/edit', 'MenusController@edit')->middleware('admin')->name('menus.edit');
Route::post('/dashboard/menus', 'MenusController@store')->middleware('admin')->name('menus.store');
Route::delete('/dashboard/menus/{id}', 'MenusController@destroy')->middleware('admin')->name('menus.destroy');
Route::patch('/dashboard/menus/deleted/{id}', 'MenusController@restore')->middleware('admin')->name('menus.restore');
Route::get('/dashboard/menus/create', 'MenusController@create')->middleware('admin')->name('menus.create');

// Orders
Route::get('/dashboard/orders', 'OrdersController@index')->name('orders.index');
Route::post('/dashboard/orders', 'OrdersController@store')->name('orders.store');
Route::delete('/dashboard/orders', 'OrdersController@destroy')->name('orders.destroy');
Route::delete('/dashboard/orders/{id}', 'OrdersController@destroyOne')->name('orders.destroyOne');
Route::get('/dashboard/order/{id}/edit', 'OrdersController@edit')->name('orders.edit');
Route::patch('/dashboard/order/{id}', 'OrdersController@update')->name('orders.update');
Route::get('/dashboard/order/{id}', 'OrdersController@show')->name('orders.show');
Route::get('/dashboard/order', 'OrdersController@redirect')->name('orders.redirect');

// Invoices
Route::get('/dashboard/invoices', 'InvoicesController@index')->name('invoices.index');
Route::post('/dashboard/invoices/store', 'InvoicesController@store')->middleware('admin')->name('invoices.store');
Route::get('/dashboard/invoices/{invoice:unique}', 'InvoicesController@show')->name('invoices.show');
// Route::get('/dashboard/invoice/{id}', 'InvoicesController@show')->name('invoices.show');

// Payment
Route::get('/dashboard/payment', 'PaymentsController@index')->name('payment');