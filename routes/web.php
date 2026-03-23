<?php

// Edited by David García Zapata, Sofia Gallo and Mariana Carrasquilla Botero

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders', '\App\Http\Controllers\OrderController@index')->name('orders.index');
Route::get('/orders/create', '\App\Http\Controllers\OrderController@create')->name('orders.create');
Route::post('/orders', '\App\Http\Controllers\OrderController@store')->name('orders.store');
Route::get('/orders/{order}', '\App\Http\Controllers\OrderController@show')->name('orders.show');
Route::get('/orders/{order}/edit', '\App\Http\Controllers\OrderController@edit')->name('orders.edit');
Route::put('/orders/{order}', '\App\Http\Controllers\OrderController@update')->name('orders.update');
Route::delete('/orders/{order}', '\App\Http\Controllers\OrderController@destroy')->name('orders.destroy');

Route::get('/categories', '\App\Http\Controllers\CategoryController@index')->name('category.index');
Route::get('/categories/create', '\App\Http\Controllers\CategoryController@create')->name('category.create');
Route::post('/categories', '\App\Http\Controllers\CategoryController@store')->name('category.store');
Route::get('/categories/{category}/edit', '\App\Http\Controllers\CategoryController@edit')->name('category.edit');
Route::put('/categories/{category}', '\App\Http\Controllers\CategoryController@update')->name('category.update');
Route::delete('/categories/{category}', '\App\Http\Controllers\CategoryController@destroy')->name('category.destroy');

Route::get('/products', '\App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/create', '\App\Http\Controllers\ProductController@create')->name('product.create');
Route::post('/products', '\App\Http\Controllers\ProductController@store')->name('product.store');
Route::get('/products/{product}/edit', '\App\Http\Controllers\ProductController@edit')->name('product.edit');
Route::put('/products/{product}', '\App\Http\Controllers\ProductController@update')->name('product.update');
Route::get('/products/{product}', '\App\Http\Controllers\ProductController@show')->name('product.show');
Route::delete('/products/{product}', '\App\Http\Controllers\ProductController@destroy')->name('product.destroy');

Route::get('/cart', '\App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart/add/{id}', '\App\Http\Controllers\CartController@add')->name('cart.add');
Route::delete('/cart/remove/{id}', '\App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::delete('/cart/removeAll', '\App\Http\Controllers\CartController@removeAll')->name('cart.removeAll');

Route::get('/payment/create', '\App\Http\Controllers\PaymentController@create')->name('payment.create');
Route::post('/payment', '\App\Http\Controllers\PaymentController@store')->name('payment.store');
Route::get('/payment/{payment}/success', '\App\Http\Controllers\PaymentController@success')->name('payment.success');

Auth::routes();

Route::get('/home', '\App\Http\Controllers\HomeController@index')->name('home');

Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name('admin.home.index');
