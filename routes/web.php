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

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/customers', 'CustomerController@index')->name('customers.index');
    Route::get('/customers/create', 'CustomerController@create')->name('customers.create');
    Route::post('/customers/store', 'CustomerController@store')->name('customers.store');
    Route::get('/customers/edit/{id}', 'CustomerController@edit')->name('customers.edit');
    Route::get('/customers/delete/{id}', 'CustomerController@delete')->name('customers.delete');
    Route::post('/customers/update/{id}', 'CustomerController@update')->name('customers.update');
    Route::get('/customers/search', 'CustomerController@search')->name('customers.search');

    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/create', 'OrderController@create')->name('orders.create');
    Route::post('/orders/store', 'OrderController@store')->name('orders.store');
    Route::get('/orders/edit/{id}', 'OrderController@edit')->name('orders.edit');
    Route::get('/orders/delete/{id}', 'OrderController@delete')->name('orders.delete');
    Route::post('/orders/update/{id}', 'OrderController@update')->name('orders.update');

    Route::post('/subjects/delete/{id}', 'SubjectController@delete')->name('subjects.delete');
    Route::post('/results/delete/{id}', 'ResultController@delete')->name('results.delete');

    Route::get('/', 'OrderController@dashboard')->name('orders.dashboard');
    Route::get('/orders/customer/{id}', 'OrderController@customer')->name('orders.customer');
    Route::get('/catalog', 'OrderController@catalog')->name('orders.catalog');
});
