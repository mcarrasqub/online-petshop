<?php

// Edited by David García Zapata, Sofia Gallo and Mariana Carrasquilla Botero

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/lang/{locale}', '\App\Http\Controllers\LanguageController@switch')->name('lang.switch');

Route::get('/', '\App\Http\Controllers\HomeController@index')->name('home.index');

Route::get('/products', '\App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/{product}', '\App\Http\Controllers\ProductController@show')->name('product.show');

Route::middleware('auth')->group(function () {
Route::get('/cart', '\App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart/add/{id}', '\App\Http\Controllers\CartController@add')->name('cart.add');
Route::delete('/cart/remove/{id}', '\App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::delete('/cart/removeAll', '\App\Http\Controllers\CartController@removeAll')->name('cart.removeAll');

Route::get('/orders', '\App\Http\Controllers\OrderController@index')->name('orders.index');
Route::get('/orders/my', '\App\Http\Controllers\OrderController@myOrders')->name('orders.my');
Route::get('/orders/create', '\App\Http\Controllers\OrderController@create')->name('orders.create');
Route::post('/orders', '\App\Http\Controllers\OrderController@store')->name('orders.store');
Route::get('/orders/{order}', '\App\Http\Controllers\OrderController@show')->name('orders.show');

Route::get('/payment/{order}', '\App\Http\Controllers\PaymentController@index')->name('payment.index');
Route::post('/payment', '\App\Http\Controllers\PaymentController@store')->name('payment.store');
Route::get('/payment/{payment}/success', '\App\Http\Controllers\PaymentController@success')->name('payment.success');
Route::get('/payment/{payment}/receipt', '\App\Http\Controllers\PaymentController@receipt')->name('payment.receipt');
});

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', '\App\Http\Controllers\Admin\AdminHomeController@index')->name('admin.home.index');

    Route::get('/products', '\App\Http\Controllers\Admin\AdminProductController@index')->name('admin.product.index');
    Route::get('/products/create', '\App\Http\Controllers\Admin\AdminProductController@create')->name('admin.product.create');
    Route::post('/products', '\App\Http\Controllers\Admin\AdminProductController@store')->name('admin.product.store');
    Route::get('/products/{product}', '\App\Http\Controllers\Admin\AdminProductController@show')->name('admin.product.show');
    Route::get('/products/{product}/edit', '\App\Http\Controllers\Admin\AdminProductController@edit')->name('admin.product.edit');
    Route::put('/products/{product}', '\App\Http\Controllers\Admin\AdminProductController@update')->name('admin.product.update');
    Route::delete('/products/{product}', '\App\Http\Controllers\Admin\AdminProductController@destroy')->name('admin.product.destroy');

    Route::get('/categories', '\App\Http\Controllers\Admin\AdminCategoryController@index')->name('admin.category.index');
    Route::get('/categories/create', '\App\Http\Controllers\Admin\AdminCategoryController@create')->name('admin.category.create');
    Route::post('/categories', '\App\Http\Controllers\Admin\AdminCategoryController@store')->name('admin.category.store');
    Route::get('/categories/{category}', '\App\Http\Controllers\Admin\AdminCategoryController@show')->name('admin.category.show');
    Route::get('/categories/{category}/edit', '\App\Http\Controllers\Admin\AdminCategoryController@edit')->name('admin.category.edit');
    Route::put('/categories/{category}', '\App\Http\Controllers\Admin\AdminCategoryController@update')->name('admin.category.update');
    Route::delete('/categories/{category}', '\App\Http\Controllers\Admin\AdminCategoryController@destroy')->name('admin.category.destroy');
});

Auth::routes();
