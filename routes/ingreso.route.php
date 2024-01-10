<?php
Route::group(['middleware'=>['auth'],'namespace'=>'Ingreso'], function() {

    Route::get('documentos-ingresante','IngresoController@index')->name('ingreso.index');



    Route::post('upload-ingreso','IngresoController@load');
    Route::get('delete-ingreso/{id}','IngresoController@delete');
    Route::get('constancia-pdf/{dni}','IngresoController@pdf')->name('constancia');

});