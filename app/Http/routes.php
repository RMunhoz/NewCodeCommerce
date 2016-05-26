<?php

Route::pattern('id', '[0-9]+');

Route::get('/', ['as' => 'store.index', 'uses' => 'StoreController@index']);
Route::get('category/{id}',['as'=>'store.category','uses'=>'StoreController@category']);
Route::get('product/{id}',['as'=>'store.product','uses'=>'StoreController@product']);
Route::get('tag/{id}',['as'=>'store.tag','uses'=>'StoreController@tag']);
Route::get('cart',['as'=>'cart','uses'=>'CartController@index']);
Route::get('cart/add/{id}',['as'=>'cart.add','uses'=>'CartController@add']);
Route::get('cart/destroy/{id}',['as'=>'cart.destroy','uses'=>'CartController@destroy']);
Route::put('cart/update/{id}',['as'=>'cart.update','uses'=>'CartController@update']);

Route::group(['middleware'=>'auth'], function(){
	
	Route::get('checkout/place-order', ['as'=>'checkout.place','uses'=>'CheckoutController@place']);
	Route::get('account/orders', ['as'=>'account.orders', 'uses'=>'AccountController@orders']);
	Route::get('account', ['as'=>'account.index', 'uses'=>'AccountController@index']);	

});

Route::get('home', ['as'=> 'home', 'uses'=>'HomeController@index']);
Route::get('teste', 'CheckoutController@teste');

Route::controllers([
	'auth'		=>	'Auth\AuthController',
	'password'	=>	'Auth\PasswordController',
]);

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function(){

	Route::group(['prefix'=> 'painel'], function(){

		Route::get('', ['as'=>'painel.index', 'uses'=>'AdminController@index']);
	});

	Route::group(['prefix'=>'email'], function(){

		Route::get('', ['as'=>'email.create', 'uses'=>'MailController@create']);

	});
	
	Route::group(['prefix'=> 'users'],function(){

		Route::get('',['as'=>'users.index','uses'=>'AdminUsersController@index']);
		Route::get('{id}/show', ['as' => 'users.show', 'uses' => 'AdminUsersController@show']);
        Route::get('create', ['as' => 'users.create', 'uses' => 'AdminUsersController@create']);
        Route::post('store', ['as' => 'users.store', 'uses' => 'AdminUsersController@store']);
        Route::get('{id}/edit', ['as' => 'users.edit', 'uses' => 'AdminUsersController@edit']);
        Route::put('{id}/update', ['as' => 'users.update', 'uses' => 'AdminUsersController@update']);
        Route::get('{id}/destroy', ['as' => 'users.destroy', 'uses' => 'AdminUsersController@destroy']);
	});

	Route::group(['prefix'=>'categories'], function(){

		Route::get('/',['as'=>'categories.index','uses'=>'AdminCategoriesController@index']);
		Route::get('/create',['as'=>'categories.create','uses'=>'AdminCategoriesController@create']);
		Route::post('/store',['as'=>'categories.store','uses'=>'AdminCategoriesController@store']);
		Route::get('/edit/{id}',['as'=>'categories.edit','uses'=>'AdminCategoriesController@edit']);
		Route::put('/update/{id}',['as'=>'categories.update','uses'=>'AdminCategoriesController@update']);
		Route::get('/destroy/{id}',['as'=>'categories.destroy',
			'uses'=>'AdminCategoriesController@destroy']);
		
	});

	Route::group(['prefix'=>'products'], function(){

		Route::get('/',['as'=>'products.index','uses'=>'AdminProductsController@index']);
		Route::get('/create',['as'=>'products.create','uses'=>'AdminProductsController@create']);
		Route::post('/store',['as'=>'products.store','uses'=>'AdminProductsController@store']);
		Route::get('/edit/{id}',['as'=>'products.edit','uses'=>'AdminProductsController@edit']);
		Route::put('/update/{id}',['as'=>'products.update','uses'=>'AdminProductsController@update']);
		Route::get('/destroy/{id}',['as'=>'products.destroy','uses'=>'AdminProductsController@destroy']);

		Route::group(['prefix'=>'images'], function(){

			Route::get('/{id}', ['as'=>'products.images','uses'=>'AdminProductsController@images']);
			Route::get('/create/{id}', ['as'=>'products.images.create',
				'uses'=>'AdminProductsController@createImage']);
			Route::post('/store/{id}', ['as'=>'products.images.store',
				'uses'=>'AdminProductsController@storeImage']);
			Route::get('/destroy/{id}', ['as'=>'products.images.destroy',
				'uses'=>'AdminProductsController@destroyImage']);

		});
	});
});

