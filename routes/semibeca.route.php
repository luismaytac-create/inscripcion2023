<?php
Route::group(['middleware'=>'auth','namespace'=>'Semibeca'], function() {
	Route::get('semibeca','SemibecaController@index')->name('semibeca.index');
	
	Route::post('load1','SemibecaController@load1');
    Route::post('load2','SemibecaController@load2');
	Route::post('load3','SemibecaController@load3');
    Route::post('load4','SemibecaController@load4');
	Route::post('load5','SemibecaController@load5');
    Route::post('load6','SemibecaController@load6');
	Route::post('load7','SemibecaController@load7');
	Route::get('delete-document/{id}','SemibecaController@delete');
	Route::get('regissol','SemibecaController@regissol');
	
	
	
	Route::get('receipt','SemibecaController@receipt')->name('receipt');
});