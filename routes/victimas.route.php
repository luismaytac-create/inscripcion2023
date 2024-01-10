<?php
Route::group(['middleware'=>['auth','datosok'],'namespace'=>'Victimas'], function() {
    Route::get('documentos-victima','VictimasController@index')->name('victimas.index');


    Route::post('upload-victima','VictimasController@load');
    Route::get('delete-victima/{id}','VictimasController@delete');
});