<?php

Route::group(['prefix'=>'visiteur','as'=>'visiteur.'],function(){

	Route::get('/','Laravision\Visiteur\Http\Controllers\AppController@index')->name('dashboard');
});