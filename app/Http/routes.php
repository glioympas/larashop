<?php

/*
	Products and Shopping Cart Routes
*/

Route::get('/', [
'uses'=> 'ProductController@index',
'as' => 'products.index'
]);

Route::post('/add-to-cart/{id}', [
'uses' => 'ProductController@addToCart',
'as' => 'products.addToCart'
]);

Route::get('/shopping-cart',[
'uses'=> 'ProductController@shoppingCart',
'as' => 'products.shoppingCart'
]);

Route::post('/empty-cart',[
'uses' => 'ProductController@emptyCart',
'as' => 'products.emptyCart'
]);


//Checkout

Route::get('/checkout', [
'uses' => 'ProductController@checkout',
'as' => 'checkout',
'middleware' => 'auth'
]);

Route::post('/checkout', [
'uses' => 'ProductController@postCheckout',
'as' => 'checkout',
'middleware' => 'auth'
]);



/*
	Users Routes
*/
Route::group(['prefix'=>'user'], function(){

	//Only authenticated users can visit them.
	Route::group(['middleware'=>'auth'],function(){
		Route::get('/profile', [
			'uses'=>'UsersController@profile',
			'as'=>'users.profile'
		]);


		Route::get('/logout',[
			'uses'=>'UsersController@logout',
			'as'=>'users.logout'
		] );
	});

	//Guests can visit them
	Route::group(['middleware'=>'guest'],function(){
		Route::get('/signup',[
		'uses'=>'UsersController@signup',
		'as'=>'users.signup'
		]);

		Route::post('/signup', [
		'uses'=>'UsersController@postSignup',
		'as' => 'users.signup'
		]);

		Route::get('/signin',[
		'uses'=>'UsersController@signIn',
		'as'=>'users.signin'
		]);

		Route::post('/signin',[
		'uses'=>'UsersController@postSignin',
		'as'=> 'users.signin'
		]);
	});


});

