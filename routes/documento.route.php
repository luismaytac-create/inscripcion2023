<?php
Route::group(['middleware'=>['auth','datosok'],'namespace'=>'Documento'], function() {

    Route::get('documentos','DocumentoController@index')->name('documentos.index');
    Route::get('documentos-victima','DocumentoController@index')->name('victimas.index');


    Route::post('upload-documento','DocumentoController@load');
    Route::get('delete-documento/{id}','DocumentoController@delete');

});