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

  //, function() {





//   ini_set('display_errors', 1);
//   // Code put here will run when you navigate to /show_products
// //	$sh = App::make('ShopifyAPI');
//   // $sh = App::make('ShopifyAPI', ['API_KEY' => '', 'API_SECRET' => '', 'SHOP_DOMAIN' => '']);
//   // This creates an instance of the Shopify API wrapper and
//   // authenticates our app.

//   $shopify = App::make('ShopifyAPI', [
//     'API_KEY' => 'ba7683f64f2cf40510bb3946bcaf40fe',
//     'API_SECRET' => '1ed3dfefc2231b3eb8d1eb6c1ce51a17',
//     'SHOP_DOMAIN' => 'ugh-shopify.myshopify.com',
//     'ACCESS_TOKEN' => 'd4038c3ae9bf31bb1d5d1b32ce7c17db'
//   ]);

// // Gets a list of products
//   $result = $shopify->call([
//     'METHOD'     => 'GET',
//     'URL'         => '/admin/products.json?page=1'
//   ]);
   
// // //   $products = $result->products;
// //  echo '<pre>'.print_r($result,true).'</pre>';
// // //   // Print out the title of each product we received
// //    foreach($result->products as $product) {
// //     echo '
 
// // ' . $product->id . ': ' . $product->title . '
 
// // ';
// //  	  }
//     return view('pages.product.index');   
//  });






Route::get('/add_product', array('as' => 'product.create', 'uses' => 'ProductController@create'));
Route::post('/add_product', array('as' => 'product.create', 'uses' => 'ProductController@create'));
//   // Code put here will run when you navigate to /show_products
// //	$sh = App::make('ShopifyAPI');
//   // $sh = App::make('ShopifyAPI', ['API_KEY' => '', 'API_SECRET' => '', 'SHOP_DOMAIN' => '']);
//   // This creates an instance of the Shopify API wrapper and
//   // authenticates our app.

//   $shopify = App::make('ShopifyAPI', [
//     'API_KEY' => 'ba7683f64f2cf40510bb3946bcaf40fe',
//     'API_SECRET' => '1ed3dfefc2231b3eb8d1eb6c1ce51a17',
//     'SHOP_DOMAIN' => 'ugh-shopify.myshopify.com',
//     'ACCESS_TOKEN' => 'd4038c3ae9bf31bb1d5d1b32ce7c17db'
//   ]);



//   $result = $shopify->call([
//   'METHOD'      => 'POST',
//   'URL'         => '/admin/products.json',
//   'DATA'        => [
//     'product' => [
//       'title'  => 'New product title!',
//       'body_html'  => '<strong>Good snowboard!<\/strong>',
//       'price'  => '48'
//     ]
//   ]
// ]);





// //   $products = $result->products;
//  echo '<pre>'.print_r($result,true).'</pre>';

 
//  });