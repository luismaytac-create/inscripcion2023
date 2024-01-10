<?php
Route::group(['middleware'=>'auth','namespace'=>'Resultados'], function() {

	Route::get('resultados','ResultadosController@index')->name('resultados.index');

});

