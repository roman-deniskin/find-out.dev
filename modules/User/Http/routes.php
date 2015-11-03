<?php

Route::group(['prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
	Route::get('/', 'UserController@index');
});

Route::group(['namespace' => 'Modules\User\Http\Controllers'], function()
{
	// Authentication routes
	Route::get('login', 'UserController@getLogin');
	Route::post('login', 'UserController@postLogin');
	Route::get('logout', 'UserController@getLogout');
	// Registration routes
	Route::get('registration', 'UserController@getRegistration');
	Route::post('registration', 'UserController@postRegistration');

	#Route::controllers(['password' => 'PasswordController',]);
});