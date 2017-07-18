<?php

Route::group(['prefix'=>'uploader','as'=>'uploader.'],function(){

	Route::get('/','Laravision\Uploader\Http\Controllers\AppController@index')->name('home');
	Route::get('/picture','Laravision\Uploader\Http\Controllers\AppController@picture')->name('picture');
	Route::post('/picture','Laravision\Uploader\Http\Controllers\AppController@storePicture')->name('picture');
});