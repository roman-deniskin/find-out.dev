<?php

Route::group(['namespace' => 'Modules\Index\Http\Controllers'], function()
{
	Route::get('', 'IndexController@index');
});