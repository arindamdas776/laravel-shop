<?php

route::get('/','FrontEndController@index')->name('product.page');
route::get('/category/product/{slug}','FrontEndController@category_products')->name('product.category');
route::get('/all/products','FrontEndController@allProducts')->name('products.all');
route::get('/single/{id}','FrontEndController@singleProduct')->name('product.single');
route::get('/cart/show','FrontEndController@showCart')->name('cart.show');
route::POST('/cart/add/{id}','FrontEndController@addCart')->name('cart.add');
route::get('/cart/remove/{id}','FrontEndController@cardRemove')->name('cart.remove');
route::get('/checkout','FrontEndController@checkout')->name('checkout.page');


route::get('/try',function(){
	$products = App\Product::latest()->take(3)->get();
	return $products;
});
Auth::routes();



Route::group(['as'	=>	'admin', 'prefix'	=>	'admin','namespace' => 'Admin','middleware' =>['auth','admin']],function(){

	route::get('/dashboard','DashboardController@index')->name('dashboard');
	route::get('/user/details','DashboardController@userDetails')->name('user.details');
	route::get('/user/confirmation/{id}','DashboardController@confirmation')->name('user.confirmation');
	route::get('/seller/details','DashboardController@sellerDetails')->name('seller.details');
	route::resource('/categories','CategoryController');
	route::resource('/products','ProductController');
});

Route::group(['as'	=> 'seller','prefix' => 'seller','namespace' => 'Seller','middleware' => ['auth','seller']],function(){
	route::get('/dashboard','DashboardController@index')->name('dashboard');
	route::resource('categories','CategoryController');
	route::resource('/products','ProductController');
});

Route::group(['middleware' =>['auth','user']],function(){
	Route::get('/home', 'HomeController@index')->name('home');
});
