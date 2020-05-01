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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

// Profile ( All levels can access)
Route::get('/profile', 'ProfileController@index')->name('profile.index');
Route::get('/profile/edit', 'ProfileController@edit2')->name('profile.edit');
Route::patch('/profile', 'ProfileController@update')->name('profile.update');
Route::get('/profile/login/edit', 'ProfileController@editlogin')->name('profile.editlogin')->middleware(['auth', 'password.confirm']);
Route::patch('/profile/updatelogin', 'ProfileController@updatelogin')->name('profile.updatelogin');
Route::delete('/profile', 'ProfileController@destroy')->name('profile.delete');
Route::get('/profile/avatar/edit', 'ProfileController@editAvatar')->name('profile.editAvatar');
Route::post('/profile/avatar/update', 'ProfileController@updateAvatar')->name('profile.updateAvatar');
Route::post('/profile/avatar/delete', 'ProfileController@deleteAvatar')->name('profile.deleteAvatar');

// Users ( Admin only )
Route::get('/dashboard/users', 'UsersController@index')->middleware('admin')->name('users.index');
Route::get('/dashboard/user/{user:username}', 'UsersController@show')->middleware('admin')->name('users.show');
Route::get('/dashboard/user/{user:username}/edit', 'UsersController@edit')->middleware('admin')->name('users.edit');
Route::patch('/dashboard/user/{id}', 'UsersController@update')->middleware('admin')->name('users.update');
Route::delete('/dashboard/users/{id}', 'UsersController@destroy')->middleware('admin')->name('users.delete');

// Users Search
Route::get('/dashboard/search', 'UsersController@search')->name('users.search');

// Menus
Route::get('/menus', 'MenusController@index')->middleware('customerOrAdmin')->name('menus.index');
Route::get('/dashboard/menus/deleted', 'MenusController@deleted')->middleware('admin')->name('menus.deleted');
Route::get('/menu/{id}', 'MenusController@show')->middleware('customerOrAdmin')->name('menus.show');
Route::patch('/dashboard/menu/{id}', 'MenusController@update')->middleware('admin')->name('menus.update');
Route::get('/dashboard/menu/{id}/edit', 'MenusController@edit')->middleware('admin')->name('menus.edit');
Route::post('/dashboard/menus', 'MenusController@store')->middleware('admin')->name('menus.store');
Route::delete('/dashboard/menus/{id}', 'MenusController@destroy')->middleware('admin')->name('menus.destroy');
Route::patch('/dashboard/menus/deleted/{id}', 'MenusController@restore')->middleware('admin')->name('menus.restore');
Route::get('/dashboard/menus/create', 'MenusController@create')->middleware('admin')->name('menus.create');
route::post('/menu/forceDelete/{id}', 'MenusController@forceDelete')->name('menus.forceDelete');
Route::get('/menu/{menu}/edit-cover', 'MenusController@editCover')->name('menus.editCover');
Route::post('/menu/{menu}/updage-cover', 'MenusController@updateCover')->name('menus.updateCover');
Route::get('/menu/{menu}/edit-image/{image}', 'MenusController@editImage')->name('menus.editImage');
Route::post('/menu/{menu}/edit-image/{image}', 'MenusController@updateImage')->name('menus.updateImage');

// Menus Search
Route::get('menus/search', 'MenusController@search')->name('menus.search');

// Orders ( Customer access only )
Route::get('/dashboard/orders', 'OrdersController@index')->name('orders.index');
Route::post('/dashboard/orders', 'OrdersController@store')->name('orders.store');
Route::delete('/dashboard/orders', 'OrdersController@destroy')->name('orders.destroy');
Route::delete('/dashboard/orders/{id}', 'OrdersController@destroyOne')->name('orders.destroyOne');
Route::get('/dashboard/order/{id}/edit', 'OrdersController@edit')->name('orders.edit');
Route::patch('/dashboard/order/{id}', 'OrdersController@update')->name('orders.update');
Route::get('/dashboard/order/{id}', 'OrdersController@show')->name('orders.show');
Route::get('/dashboard/order', 'OrdersController@redirect')->name('orders.redirect');

// Invoices
Route::get('/dashboard/invoices', 'InvoicesController@index')->middleware('customerOrAdmin')->name('invoices.index');
Route::post('/dashboard/invoices/store', 'InvoicesController@store')->middleware('admin')->name('invoices.store');
Route::get('/dashboard/invoice/{invoice_code}', 'InvoicesController@show')->middleware('customerOrAdmin')->name('invoices.show');

// Cashier & Payment Route ( Cashier access only )
Route::get('/cashier', 'CashierController@index')->name('cashier.index');
Route::get('/cashier/search-username', 'CashierController@search')->name('cashier.search');
Route::get('/cashier/payment/{user:username}', 'CashierController@payment')->middleware('password.confirm')->name('cashier.payment');
Route::post('cashier/confirm-payment', 'CashierController@confirmPayment')->name('cashier.confirmPayment');

// Employees ( Admin & Owner access only )
Route::get('/employees', 'EmployeesController@index')->name('employees.index');

// Notifications
Route::get('/notifications', 'NotificationsController@index')->name('notifications.index');
Route::get('/notification/{notification}', 'NotificationsController@show')->name('notifications.show');

// Tes
Route::get('/test', 'TestControllers@index');