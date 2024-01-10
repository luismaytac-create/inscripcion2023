<?php
Route::group(['middleware'=>'auth','namespace'=>'Contacto'], function() {

	Route::resource('contacto','ContactoController',['names'=>'contacto','only'=>['index','store']]);
	Route::get('listar','ContactoController@listar')->name('contacto.listar');

});

