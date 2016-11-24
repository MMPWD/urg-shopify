<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('ajax/product/index', array('as' => 'ajax.product.index', 'uses' => 'ProductController@index'));

Route::get('/',array('as' => 'welcome.home', 'uses' => 'HomeController@index'));

Route::get('/show_products', array('as' => 'product.index', 'uses' => 'ProductController@index'));

Route::get('/product/{id}', array('as' => 'product.show', 'uses' => 'ProductController@show'));
Route::get('/product/{id}/edit', array('as' => 'product.edit', 'uses' => 'ProductController@edit'));
Route::post('/product/{id}/update', array('as' => 'product.update', 'uses' => 'ProductController@update'));


Route::get('/add_product', array('as' => 'product.create', 'uses' => 'ProductController@create'));
Route::post('/add_product', array('as' => 'product.store', 'uses' => 'ProductController@store'));

Route::get('/product/{id}/destroy', array('as' => 'product.destroy', 'uses' => 'ProductController@destroy'));

// Product Image Routes
Route::get('product/{id}/images', array('as' => 'product.image.index', 'uses' => 'ProductImageController@index'));
Route::post('product/{id}/images', array('as' => 'product.image.store', 'uses' => 'ProductImageController@store'));
Route::get('ajax/product/{id}/images/index', array('as' => 'ajax.product.images.index', 'uses' => 'ProductImageController@index'));
