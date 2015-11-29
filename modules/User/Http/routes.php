<?php

Route::group(['prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
	Route::get('/', 'UserController@index');
	Route::get('/profile/edit', 'UserController@update');
	Route::post('/profile/update', 'UserController@postUpdate');
	Route::get('/user{id}', 'UserController@profile');
	Route::get('/activation/{token}', 'UserController@activation');
	Route::post('/save', 'UserController@postSave');
});

Route::group(['namespace' => 'Modules\User\Http\Controllers'], function()
{
	// Authentication routes
	Route::get('login', 'UserController@getLogin');
	Route::post('login', 'UserController@postLogin');
	Route::get('logout', 'UserController@getLogout');

	// Registration routes
	Route::post('registration', 'UserController@postRegistration');
});