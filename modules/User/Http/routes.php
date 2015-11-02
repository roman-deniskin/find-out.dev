<?php

Route::group(['prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
	Route::get('/', 'UserController@index');
});


Route::group(['namespace' => 'Modules\User\Http\Controllers'], function()
{
	Route::get('registration', 'UserController@registration');
});