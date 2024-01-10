<?php
Route::group(['middleware'=>['auth'],'namespace'=>'Email'], function() {

    Route::get('email','EmailController@index')->name('email.index');
    Route::get('enviar-email','EmailController@enviar')->name('email.info');
    Route::get('enviar-codigo','EmailController@codigo')->name('email.codigo');

    Route::get('check-email','EmailController@check')->name('email.check');


});


