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
Route::patch('/profile/login/edit', 'ProfileController@updatelogin')->name('profile.updatelogin');
Route::delete('/profile', 'ProfileController@destroy')->name('profile.delete');
Route::get('/profile/avatar/edit', 'ProfileController@editAvatar')->name('profile.editAvatar');
Route::post('/profile/avatar/edit', 'ProfileController@updateAvatar')->name('profile.updateAvatar');
Route::redirect('/profile/avatar', '/profile');
Route::delete('/profile/avatar', 'ProfileController@deleteAvatar')->name('profile.deleteAvatar');

// Users ( Admin only )
Route::get('/dashboard/users', 'UsersController@index')->middleware('ownerOrAdmin')->name('users.index');
Route::get('/dashboard/user/{user:username}', 'UsersController@show')->middleware('ownerOrAdmin')->name('users.show');
Route::get('/dashboard/user/{user:username}/edit', 'UsersController@edit')->middleware('admin')->name('users.edit');
Route::patch('/dashboard/user/{id}', 'UsersController@update')->middleware('admin')->name('users.update');
Route::delete('/dashboard/users/{id}', 'UsersController@destroy')->middleware('admin')->name('users.delete');

// Users Search
Route::get('/dashboard/search', 'UsersController@search')->name('users.search');

// Menus
Route::get('/menus', 'MenusController@index')->middleware('ownerOrAdminOrCustomer')->name('menus.index');
Route::get('/menus/deleted', 'MenusController@deleted')->middleware('admin')->name('menus.deleted');
Route::get('/menu/{id}', 'MenusController@show')->middleware('ownerOrAdminOrCustomer')->name('menus.show');
Route::patch('/menu/{id}', 'MenusController@update')->middleware('admin')->name('menus.update');
Route::get('/menu/{id}/edit', 'MenusController@edit')->middleware('admin')->name('menus.edit');
Route::post('/menus', 'MenusController@store')->middleware('admin')->name('menus.store');
Route::delete('/menu/{id}', 'MenusController@destroy')->middleware('admin')->name('menus.destroy');
Route::redirect('/menus/deleted/{id}', '/menus/deleted');
Route::patch('/menus/deleted/{id}', 'MenusController@restore')->middleware('admin')->name('menus.restore');
Route::get('/menus/create', 'MenusController@create')->middleware('admin')->name('menus.create');
route::redirect('/menu/forceDelete/{id}', '/menus');
route::post('/menu/forceDelete/{id}', 'MenusController@forceDelete')->middleware('admin')->name('menus.forceDelete');
Route::get('/menu/{menu}/edit-cover', 'MenusController@editCover')->middleware('admin')->name('menus.editCover');
Route::redirect('/menu/{menu}/cover', '/menu/{menu}');
Route::post('/menu/{menu}/cover', 'MenusController@updateCover')->middleware('admin')->name('menus.updateCover');
Route::delete('/menu/{menu}/cover', 'MenusController@deleteCover')->middleware('admin')->name('menus.deleteCover');
Route::get('/menu/{menu}/image/{image}', 'MenusController@editImage')->middleware('admin')->name('menus.editImage');
Route::post('/menu/{menu}/image/{image}', 'MenusController@updateImage')->middleware('admin')->name('menus.updateImage');
Route::delete('/menu/{menu}/image/{image}', 'MenusController@deleteImage')->middleware('admin')->name('menus.deleteImage');
Route::redirect('/menu/{menu}/add-images', '/menu/{menu}/edit');
Route::post('/menu/{menu}/add-images', 'MenusController@addImages')->middleware('admin')->name('menus.addImages');

// Menus Search
Route::get('menus/search', 'MenusController@search')->name('menus.search');

// Orders ( Customer access only )
Route::get('/orders', 'OrdersController@index')->name('orders.index');
Route::post('/orders', 'OrdersController@store')->name('orders.store');
Route::delete('/orders', 'OrdersController@destroy')->name('orders.destroy');
Route::delete('/order/{id}', 'OrdersController@destroyOne')->name('orders.destroyOne');
Route::get('/order/{id}/edit', 'OrdersController@edit')->name('orders.edit');
Route::patch('/order/{id}', 'OrdersController@update')->name('orders.update');
Route::get('/order/{id}', 'OrdersController@show')->name('orders.show');
Route::get('/order', 'OrdersController@redirect')->name('orders.redirect');

// Invoices
Route::get('/invoices', 'InvoicesController@index')->middleware('ownerOrAdminOrCustomer')->name('invoices.index');
Route::post('/invoices', 'InvoicesController@store')->middleware('admin')->name('invoices.store');
Route::get('/invoice/{invoice_code}', 'InvoicesController@show')->middleware('ownerOrAdminOrCustomer')->name('invoices.show');

// Cashier & Payment Route ( Cashier access only )
Route::get('/cashier', 'CashierController@index')->name('cashier.index');
Route::get('/cashier/search-username', 'CashierController@search')->name('cashier.search');
Route::get('/cashier/payment/{user:username}', 'CashierController@payment')->middleware('password.confirm')->name('cashier.payment');
Route::redirect('/cashier/confirm-payment', '/cashier');
Route::post('/cashier/confirm-payment', 'CashierController@confirmPayment')->name('cashier.confirmPayment');

// Employees ( Admin & Owner access only )
Route::get('/employees', 'EmployeesController@index')->name('employees.index');

// Notifications
Route::get('/notifications', 'NotificationsController@index')->name('notifications.index');
Route::redirect('/notification', '/notifications');
Route::get('/notification/{notification}', 'NotificationsController@show')->name('notifications.show');
Route::patch('/notifications', 'NotificationsController@clear')->name('notifications.clear');

// SetAdmin (Owner Only)
Route::get('/setting/admin', 'SetAdminController@index')->name('addAdmin.index');
Route::post('/setting/admin', 'SetAdminController@setAdmin')->name('setAdmin');
Route::redirect('/setting/admin/{id}', '/setting/admin');
Route::post('/setting/admin/{id}', 'SetAdminController@deleteAdmin')->name('deleteAdmin');

// Trashed Menus
Route::get('/cover/{cover}', 'MenusController@getCover')->middleware('admin')->name('getCover');

// Setting
Route::get('/settings', 'SettingController@overview')->name('setting.overview');
Route::get('/setting/account', 'SettingController@index')->name('setting.account');