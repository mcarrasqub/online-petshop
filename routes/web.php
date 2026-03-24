<?php

// Edited by David García Zapata, Sofia Gallo and Mariana Carrasquilla Botero

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.home.index');
        }

        return redirect()->route('product.index');
    }

    return redirect()->route('login');
});

Route::get('/lang/{locale}', '\App\Http\Controllers\LanguageController@switch')->name('lang.switch');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return Auth::user()->is_admin
            ? redirect()->route('admin.home.index')
            : redirect()->route('product.index');
    })->name('home');

    Route::get('/products', '\App\Http\Controllers\ProductController@index')->name('product.index');
    Route::get('/products/{product}', '\App\Http\Controllers\ProductController@show')->name('product.show');

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

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', '\App\Http\Controllers\Admin\AdminHomeController@index')->name('home.index');

    Route::get('/products', '\App\Http\Controllers\Admin\ProductController@index')->name('product.index');
    Route::get('/products/create', '\App\Http\Controllers\Admin\ProductController@create')->name('product.create');
    Route::post('/products', '\App\Http\Controllers\Admin\ProductController@store')->name('product.store');
    Route::get('/products/{product}', '\App\Http\Controllers\Admin\ProductController@show')->name('product.show');
    Route::get('/products/{product}/edit', '\App\Http\Controllers\Admin\ProductController@edit')->name('product.edit');
    Route::put('/products/{product}', '\App\Http\Controllers\Admin\ProductController@update')->name('product.update');
    Route::delete('/products/{product}', '\App\Http\Controllers\Admin\ProductController@destroy')->name('product.destroy');

    Route::get('/categories', '\App\Http\Controllers\Admin\CategoryController@index')->name('category.index');
    Route::get('/categories/create', '\App\Http\Controllers\Admin\CategoryController@create')->name('category.create');
    Route::post('/categories', '\App\Http\Controllers\Admin\CategoryController@store')->name('category.store');
    Route::get('/categories/{category}', '\App\Http\Controllers\Admin\CategoryController@show')->name('category.show');
    Route::get('/categories/{category}/edit', '\App\Http\Controllers\Admin\CategoryController@edit')->name('category.edit');
    Route::put('/categories/{category}', '\App\Http\Controllers\Admin\CategoryController@update')->name('category.update');
    Route::delete('/categories/{category}', '\App\Http\Controllers\Admin\CategoryController@destroy')->name('category.destroy');
});
