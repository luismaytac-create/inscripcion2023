<?php
Route::group(['middleware'=>['auth','datosok'],'namespace'=>'Declaracion'], function() {

    Route::get('declaracion','DeclaracionController@index')->name('declaracion.index');



    Route::post('upload-declaracion','DeclaracionController@load');
    Route::get('delete-declaracion/{id}','DeclaracionController@delete');

});