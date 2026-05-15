<?php

use Illuminate\Support\Facades\Route;

Route::get('/v1/products', '\App\Http\Controllers\Api\ProductApiController@index')->name('api.products.index');
Route::get('/productos-aliados', '\App\Http\Controllers\Api\PartnerProductApiController@index')->name('api.partner.product.index');
