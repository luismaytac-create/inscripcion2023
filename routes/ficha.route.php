<?php

Route::group(['middleware'=>'auth','namespace'=>'Ficha'], function() {

    Route::post('confirmardatos','FichaController@confirmardatos')->name('ficha.confirmardatos');
	Route::get('ficha/{id?}','FichaController@index')->name('ficha.index');
	Route::get('ficha-pdf/{id?}','FichaController@pdf')->name('ficha.pdf');
	Route::get('ficha-pdf-prev/{id?}','FichaController@pdfprev')->name('ficha.pdfprev');
    Route::get('confirmar-ficha','FichaController@confirmar')->name('ficha.confirmarapi');
	Route::post('confirmar-datos','FichaController@confirmar')->name('ficha.confirmar');
    Route::get('ficha-pdf-cepre/{id?}','FichaController@pdfcepre')->name('ficha.pdfcepre');

});

