<?php

Route::get('/', [
 'uses' => 'HomeController@index',
 'as' => 'home.index'
]);


Route::group(['middleware'=>'cors','namespace'=>'Recursos'], function() {

    Route::post('resultado-prueba','ResultadoController@prueba')->name('admin.ocad.diaxxx');

    Route::post('resultado-pruebafinal','ResultadoController@pruebafinal')->name('admin.ocad.diacepp');

    Route::post('resultado-sabado-vocacional','ResultadoController@pruebavoca')->name('admin.resultado.vocasab');

    Route::post('resultado-cepre-vocacional','ResultadoController@pruebavocacepre')->name('admin.resultado.pruebavocacepre');

    Route::post('primera-prueba-resultados','ResultadoController@pruebaprimera')->name('admin.resultado.dia1xxx');

    Route::post('prueba-segunda-2-resultados','ResultadoController@pruebasegunda')->name('admin.resultado.dia1xxxxxx');

    Route::post('resultados-finales-admision','ResultadoController@pruebatercera')->name('admin.resultado.dia3xxxxxx');



});
