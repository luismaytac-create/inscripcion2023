<?php
Route::group(['middleware'=>['auth'],'namespace'=>'Sms'], function() {

    Route::get('enviar-sms','SmsController@enviar')->name('sms.enviar');



});


