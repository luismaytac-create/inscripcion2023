<?php
Route::group(['middleware'=>['auth','datosok'],'namespace'=>'Pago'], function() {

	Route::get('pagos/{id?}','PagoController@index')->name('pagos.index');
	Route::get('formato/{servicio}/{id?}','PagoController@formato')->name('pagos.formato');
	Route::get('pagos-pdf/{servicio}/{id?}','PagoController@pdf')->name('pagos.pdf');
	Route::get('pagosad-pdf/{servicio}/{id?}','PagoController@pdfRendAdmin')->name('pagosad.pdf');

});

