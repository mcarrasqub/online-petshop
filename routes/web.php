<?php
// Edited by David García Zapata

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();

Route::get('/home', '\App\Http\Controllers\HomeController@index')->name('home');
