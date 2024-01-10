<?php

/*PERMISOS DE ROOT */

Route::group(['middleware'=>'root'], function() {

Route::resource('users', 'UsersController',['names'=>'admin.users']);
});

Route::group(['namespace'=>'Pagos','middleware'=>'root'], function() {

//Route::resource('servicios','ServiciosController',['names'=>'admin.servicios','only'=>['index','store','edit','update']]);
//Route::get('activar-servicios/{id}','ServiciosController@activate')->name('admin.servicios.activate');

});


/*permisos de administrador*/





Route::group(['middleware'=>'semibecas','namespace'=>'Semibeca'], function() {
	Route::resource('semibeca','SemibecaController',['names'=>'admin.semibeca','only'=>['index']]);
	
	Route::get('semibeca-lista','SemibecaController@lista')->name('admin.semibeca.list');
	
	//Route::get('activar-descuento/{id}','DescuentosController@activate')->name('admin.descuentos.activate');

});
Route::group(['middleware'=>'semibecassave','namespace'=>'Semibeca'], function() {
	Route::get('semibeca/evaluar/{id}','SemibecaController@evaluar')->name('admin.semibeca.evaluar');
    Route::get('semibeca/activar/{id}','SemibecaController@activar')->name('admin.semibeca.activar');
    Route::get('semibeca/desactivar/{id}','SemibecaController@desactivar')->name('admin.semibeca.desactivar');

    Route::post('semibeca-save','SemibecaController@save')->name('admin.semibeca.save');

});



/*permisos de sistemas*/
Route::group(['middleware'=>'sistemas'], function() {

    Route::resource('aulas', 'Aulas\AulasController',['names'=>'admin.aulas']);

    Route::get('lista-aulas', 'Aulas\AulasController@lista_aulas')->name('admin.lista.aulas');
    Route::get('lista-aulas-activas', 'Aulas\AulasController@lista_aulas_activas')->name('admin.lista.aulas.activas');
    Route::get('lista-aulas-habilitadas', 'Aulas\AulasController@lista_aulas_habilitadas')->name('admin.lista.aulas.habilitadas');

    Route::post('disponible-aulas', 'Aulas\AulasController@disponible')->name('admin.disponible.aulas');
    Route::get('aulas-activas', 'Aulas\AulasController@activas')->name('admin.activas.aulas');
    Route::get('aulas-habilitadas', 'Aulas\AulasController@habilitadas')->name('admin.activas.habilitadas');
    Route::get('aulas-control', 'Aulas\AulasController@control')->name('admin.activas.control');


    Route::get('asignar-aulas/{id}', 'Aulas\AulasController@asignarfacultad')->name('admin.aulas.asignar');



});

Route::group(['middleware'=>'sistemas','namespace'=>'Recursos'], function() {
    Route::resource('colegios','ColegioController',['names'=>'admin.colegios','only'=>['index','store']]);
    Route::get('colegios-lista','ColegioController@lista')->name('admin.colegios.list');
    Route::post('ver-colegio','ColegioController@show')->name('admin.colegios.show');
    Route::get('editar-colegio/{id}','ColegioController@colegiodata')->name('admin.colegios.edit');
    Route::put('colegio/{id}','ColegioController@update')->name('admin.colegios.update');

});
Route::group(['middleware'=>'sistemas','namespace'=>'Recursos'], function() {
    Route::resource('ubigeos','UbigeoController',['names'=>'admin.ubigeo','only'=>['index','store']]);
    Route::get('ubigeos-lista','UbigeoController@lista')->name('admin.colegios.list');
});



Route::group(['middleware'=>'sistemas','namespace'=>'Recursos'], function() {
    Route::resource('universidades','UniversidadController',['names'=>'admin.universidades','only'=>['index','store']]);
    Route::get('universidad-lista','UniversidadController@lista')->name('admin.universidad.list');
    Route::get('editar-universidad/{id}','UniversidadController@data')->name('admin.universidad.edit');
    Route::put('universidad/{id}','UniversidadController@update')->name('admin.universidad.update');
});



Route::group(['namespace'=>'Victimas','middleware'=>'administrador'], function() {
    Route::resource('victimas','VictimasController',['names'=>'admin.victimas','only'=>['index','store','edit','update']]);
    Route::get('activar-victima/{dni}','VictimasController@activar')->name('admin.victima.activar');
    Route::get('desactivar-victima/{dni}','VictimasController@desactivar')->name('admin.victima.desactivar');

    Route::get('solicitante-victima','VictimasController@lista')->name('admin.victima.lista');
    Route::get('evaluar-victima/{dni}','VictimasController@evaluar')->name('admin.victima.evaluar');
    Route::post('victimas-save','VictimasController@save')->name('admin.victima.save');

});

Route::group(['namespace'=>'Documento','middleware'=>'administrador'], function() {
    Route::get('solicitantes-documentos','DocumentoController@lista')->name('admin.documento.index');
    Route::get('evaluar-postulante/{dni}','DocumentoController@evaluar')->name('admin.documento.evaluar');
    Route::post('documento-save','DocumentoController@save')->name('admin.documento.save');
});

Route::group(['namespace'=>'Declaracion','middleware'=>'informes'], function() {
    Route::get('solicitantes-declaracion','DeclaracionController@lista')->name('admin.declaracion.index');
    Route::get('evaluar-postulante-declaracion/{dni}','DeclaracionController@evaluar')->name('admin.declaracion.evaluar');
    Route::post('declaracion-save','DeclaracionController@save')->name('admin.declaracion.save');
});



Route::group(['namespace'=>'Descuentos','middleware'=>'sistemas'], function() {
	Route::resource('descuentos','DescuentosController',['names'=>'admin.descuentos','only'=>['index','store','edit','update']]);
	Route::get('activar-descuento/{id}','DescuentosController@activate')->name('admin.descuentos.activate');

});
Route::group(['namespace'=>'Pagos','middleware'=>'sistemas'], function() {
	Route::resource('pagos','PagosController',['names'=>'admin.pagos','only'=>['index','store']]);/** este **/
	Route::get('cartera','PagosController@create')->name('admin.cartera.create');

    Route::get('cartera-bcp','PagosController@createbcp')->name('admin.cartera-bcp.create-bcp');


	Route::get('download','PagosController@descarga')->name('admin.cartera.download');
    Route::get('download-bcp','PagosController@descargabcp')->name('admin.cartera.downloadbcp');
	Route::get('pagos-lista','PagosController@lista')->name('admin.pagos.list');

	Route::post('pago-create','PagosController@pagocreate')->name('admin.pagos.create');/** este **/

    Route::post('pago-test','PagosController@test')->name('admin.pagos.test');
	Route::post('pago-cambiar','PagosController@pagochange')->name('admin.pagos.change'); /* este */
	Route::get('recaudacion','PagosController@show')->name('admin.recaudacion');
	Route::get('pagos/{id?}','PagosController@tttt')->name('admin.pagos.indexx');
	#Servicios
	
	
	
	
});
Route::group(['namespace'=>'Ingresantes','middleware'=>'sistemas'], function() {
	Route::resource('ingresantes', 'IngresantesController',['names'=>'admin.ingresantes','only'=>['index','show','update']]);
	Route::post('ingresantes-search', 'IngresantesController@search')->name('admin.ingresantes.search');
	Route::get('datos-pdf/{id?}','IngresantesController@pdfdatos')->name('admin.ingresantes.pdfdatos');
	Route::get('constancia-pdf/{id?}','IngresantesController@pdfconstancia')->name('admin.ingresantes.pdfconstancia');
	Route::get('constancias','IngresantesController@pdfconstancias')->name('admin.ingresantes.constancias');
	#Control de entreda
	Route::resource('control', 'ControlConstanciasController',['names'=>'admin.ingresantes.control','only'=>['index','store']]);
	#Etiquetas para folders
	Route::get('ingresantes-etiquetas','EtiquetasController@index')->name('admin.ingresantes.etiquetas');
	Route::get('ingresantes-etiquetas-pdf','EtiquetasController@pdf')->name('admin.ingresantes.etiquetas.pdf');
	#Listado de Ingresantes
	Route::get('listado-general','ListadoGeneralController@listadogeneral')->name('admin.ingresantes.listadogeneral');
	Route::get('listado-general-pdf','ListadoGeneralController@listadogeneralpdf')->name('admin.ingresantes.listadogeneral.pdf');
	Route::get('listado-firma','ListadoFirmaController@listadofirma')->name('admin.ingresantes.listadofirma');
	Route::get('listado-firma-pdf','ListadoFirmaController@listadofirmapdf')->name('admin.ingresantes.listadofirma.pdf');
	Route::get('listado-notas','ListadoNotasController@listadoNotas')->name('admin.ingresantes.listadonotas');
	Route::get('listado-notas-pdf','ListadoNotasController@listadoNotaspdf')->name('admin.ingresantes.listadonotas.pdf');

});



Route::group(['namespace'=>'Postulantes','middleware'=>'ingreso'], function() {
	Route::post('buscar-postulantes','PostulantesController@buscar')->name('admin.pos.buscar');
	Route::post('postulante','PostulantesController@store')->name('admin.pos.store');

    Route::post('postulante-dni','PostulantesController@cambiardni')->name('admin.pos.cambiardni');
    Route::post('postulante-email','PostulantesController@cambiaremail')->name('admin.pos.cambiaremail');



    Route::get('postulantes','PostulantesController@index')->name('admin.pos.index');
	Route::get('postulantes/{id}','PostulantesController@show')->name('admin.pos.show');

	#Route::put('postulantes/{id}','PostulantesController@actualizar')->name('admin.pos.update');
    Route::put('postulantes/{id}','PostulantesController@update')->name('admin.pos.update');

    Route::post('postulantes/{id}','PostulantesController@personal')->name('admin.pos.personal');



    Route::get('postulantes-ficha/{id}','PostulantesController@ficha')->name('admin.pos.ficha');
	Route::get('postulantes-pago/{id}','PostulantesController@pago')->name('admin.pos.pago');
	Route::get('postulantes-lista','PostulantesController@lista')->name('admin.pos.list');




	
});


Route::group(['namespace'=>'Listados','middleware'=>'administrador'], function() {
    Route::get('listado-todos','ListadosController@todo')->name('admin.listados.todo');

    Route::get('listado-inscrito','ListadosController@inscrito')->name('admin.listados.inscrito');

    Route::get('listado-todos-table','ListadosController@todotable')->name('admin.listados.todotable');
    Route::get('listado-inscrito-table','ListadosController@inscritotable')->name('admin.listados.inscritotable');
});






/*permisos de informes  ( todos los roles)*/
/**
 * Padron
 */

Route::group(['namespace'=>'Padron','middleware'=>'administrador'], function() {
	Route::get('padron','PadronController@index')->name('admin.padron.index');

    Route::post('padron-tabla','PadronController@tabla')->name('admin.padron.tabla');


});


Route::group(['namespace'=>'Padron','middleware'=>'verificador'], function() {
    Route::get('padronverificador','PadronController@indexverificador')->name('admin.padron.verificador');

    Route::post('padron-tablaverificador','PadronController@tablaverificador')->name('admin.padron.tablaverificador');
    Route::post('verificador-save','PadronController@saveverificador')->name('admin.verificador.save');
    Route::get('verificador-observacion','PadronController@observacion')->name('admin.padron.observacion');
    Route::get('verificador-datos','PadronController@datos')->name('admin.padron.datos');
    Route::post('verificador-datos-save','PadronController@savedatos')->name('admin.verificador.datossave');

    Route::get('verificador-archivos','PadronController@getfilesdni')->name('admin.padron.filedni');


});


/**
 * Estadisticas
 */
Route::group(['namespace'=>'Estadisticas','middleware'=>'administrador'], function() {
	Route::get('estadisticas','EstadisticasController@index')->name('admin.estadisticas.index');
});
/**
 * Descuentos
 */

/**
 * Listados
 */
Route::group(['namespace'=>'Listados','middleware'=>'administrador'], function() {
	Route::get('listados','ListadosController@index')->name('admin.listados.index');
	Route::get('listado1','ListadosController@listado1')->name('admin.listados.listado1');
	Route::get('listado2','ListadosController@listado2')->name('admin.listados.listado2');
	Route::get('listado3','ListadosController@listado3')->name('admin.listados.listado3');
	Route::get('listado4','ListadosController@listado4')->name('admin.listados.listado4');
	Route::get('listado5','ListadosController@listado5')->name('admin.listados.listado5');
	Route::get('listado5-verifica/{id}','ListadosController@listado5Verifica')->name('admin.listados.listado5.verifica');
    Route::get('listados-table','ListadosController@table')->name('admin.listados.table');
	Route::get('listado6','ListadosController@listado6')->name('admin.listados.listado6');
	Route::get('listado7','ListadosController@listado7')->name('admin.listados.listado7');
	Route::get('listado8','ListadosController@listado8')->name('admin.listados.listado8');
	Route::get('listado9','ListadosController@listado9')->name('admin.listados.listado9');
	Route::get('listado10','ListadosController@listado10')->name('admin.listados.listado10');
	Route::get('listado11','ListadosController@listado11')->name('admin.listados.listado11');
	Route::get('listado12','ListadosController@listado12')->name('admin.listados.listado12');



});


Route::group(['namespace'=>'Fotos','middleware'=>'verificador'], function() {
	Route::resource('fotos','FotosController',['names'=>'admin.fotos','only'=>['index','store','update']]);
	Route::get('update/{postulante}/{estado}','FotosController@update')->name('admin.fotos.update');
	Route::get('cargar-editado','FotosController@cargareditado')->name('admin.fotos.cargar');
    Route::post('save-editado','FotosController@saveeditado')->name('admin.fotos.save');
	Route::post('buscar-foto','FotosController@buscar')->name('admin.fotos.buscar');
	Route::get('fotos-rechazadas','FotosController@fotosrechazadas')->name('admin.fotos.rechazadas');
    Route::post('foto-rechazo-motivo','FotosController@fotorechazomotivo')->name('admin.rechazo.motivo');


});


Route::group(['namespace'=>'Pagos','middleware'=>'informes'], function() {
    Route::get('pagos/{id?}','PagosController@tttt')->name('admin.pagos.indexx');
});

Route::group(['namespace'=>'Pagos','middleware'=>'administrador'], function() {
	Route::get('pagos-lista','PagosController@lista')->name('admin.pagos.list');
	Route::get('recaudacion','PagosController@show')->name('admin.recaudacion');
});

Route::group(['namespace'=>'Usuarios','middleware'=>'informes'], function() {
    Route::get('editar-usuarios/{id}','UsuariosController@editar')->name('admin.usuarios.editar');
    Route::put('actualizar-usuarios/{id}','UsuariosController@update')->name('admin.usuarios.actualizar');
});

Route::group(['namespace'=>'Usuarios','middleware'=>'administrador'], function() {
	Route::get('usuarios','UsuariosController@index')->name('admin.usuarios.index');

	Route::post('buscar-usuarios','UsuariosController@search')->name('admin.usuarios.search');

});
Route::group(['namespace'=>'Postulantes','middleware'=>'administrador'], function() {
	
	Route::get('postulantes','PostulantesController@index')->name('admin.pos.index');
	
	Route::get('postulantes-ficha/{id}','PostulantesController@ficha')->name('admin.pos.ficha');
	Route::get('postulantes-pago/{id}','PostulantesController@pago')->name('admin.pos.pago');
	Route::get('postulantes-lista','PostulantesController@lista')->name('admin.pos.list');



    Route::post('buscar-postulantes','PostulantesController@buscar')->name('admin.pos.buscar');
    Route::get('postulantes/{id}','PostulantesController@show')->name('admin.pos.show');

	
});



Route::group(['namespace'=>'Informes','middleware'=>'informes'], function() {
    Route::get('postulante-buscar','InformesController@index')->name('admin.informe.index');
    Route::post('search-dni','InformesController@buscar')->name('admin.informe.buscar');
});






/**
 * Control de usuarios
 */


Route::group(['namespace'=>'Ingresantes','middleware'=>'ingreso'], function() {
    Route::resource('ingresantes', 'IngresantesController',['names'=>'admin.ingresantes','only'=>['index','show','update']]);
    Route::post('ingresantes-search', 'IngresantesController@search')->name('admin.ingresantes.search');
    Route::get('datos-pdf/{id?}','IngresantesController@pdfdatos')->name('admin.ingresantes.pdfdatos');
    Route::get('constancia-pdf/{id?}','IngresantesController@pdfconstancia')->name('admin.ingresantes.pdfconstancia');
    Route::get('constancias','IngresantesController@pdfconstancias')->name('admin.ingresantes.constancias');
    #Control de entreda
    Route::resource('control', 'ControlConstanciasController',['names'=>'admin.ingresantes.control','only'=>['index','store']]);
    #Etiquetas para folders
    Route::get('ingresantes-etiquetas','EtiquetasController@index')->name('admin.ingresantes.etiquetas');
    Route::get('ingresantes-etiquetas-pdf','EtiquetasController@pdf')->name('admin.ingresantes.etiquetas.pdf');
    #Listado de Ingresantes
    Route::get('listado-general','ListadoGeneralController@listadogeneral')->name('admin.ingresantes.listadogeneral');
    Route::get('listado-general-pdf','ListadoGeneralController@listadogeneralpdf')->name('admin.ingresantes.listadogeneral.pdf');
    Route::get('listado-firma','ListadoFirmaController@listadofirma')->name('admin.ingresantes.listadofirma');
    Route::get('listado-firma-pdf','ListadoFirmaController@listadofirmapdf')->name('admin.ingresantes.listadofirma.pdf');
    Route::get('listado-notas','ListadoNotasController@listadoNotas')->name('admin.ingresantes.listadonotas');
    Route::get('listado-notas-pdf','ListadoNotasController@listadoNotaspdf')->name('admin.ingresantes.listadonotas.pdf');


    Route::post('comple_actu','IngresantesController@comple_actu')->name('admin.ingresantes.comple_actu');

    Route::post('familiar_actu','IngresantesController@familiar_actu')->name('admin.ingresantes.familiar_actu');

    Route::get('registrar-asistencia','IngresantesController@registrarasis')->name('admin.ingresantes.asistenciaingre');


    Route::get('reporte-pdf','ListadoNotasController@listadodnipdf')->name('admin.ingresantes.listadonotas.pdf');


});



Route::group(['namespace'=>'Sorteo','middleware'=>'informes'], function() {
    Route::get('asistencia','SorteoController@index')->name('admin.sorteo.index');
    Route::get('sorteo','SorteoController@sorteo')->name('admin.sorteo.sorteo');
    Route::post('save-asistencia','SorteoController@asistencia')->name('admin.sorteo.save');
    Route::get('aleatorio','SorteoController@aleatorio');
    Route::post('save-premio','SorteoController@premio');

});


/**
 * Postulantes
 */

/**
 * Ingresantes
 */
 
 
 /*


*/
/**
 * Pagos
 */

/**
 * Ventanilla
 */
 
 /*
Route::group(['middleware'=>'informes','namespace'=>'Ventanilla'], function() {
	Route::resource('ventanilla','VentanillaController',['names'=>'admin.ventanilla','only'=>['index','store']]);
	Route::get('obten-pagos-ventanilla','VentanillaController@obtener')->name('admin.ventanilla.obtener');

});

*/
/**
 * Fotos
 */


/**
 * Aulas
 */
 
 


/*

Route::get('liberar-aulas', 'Aulas\AulasController@liberar')->name('admin.liberar.aulas');
Route::post('asignar-aulas', 'Aulas\AulasController@asignar')->name('admin.asignar.aulas');
Route::get('ordenar-aulas', 'Aulas\AulasController@ordenar')->name('admin.ordenar.aulas');
Route::get('activar-aula/{aula}', 'Aulas\AulasController@activar')->name('admin.activar.aula');
Route::get('habilitar-aula/{aula}', 'Aulas\AulasController@habilitar')->name('admin.habilitar.aula');
Route::post('activar-aulas', 'Aulas\AulasController@activaraulas')->name('admin.activar.aulas');
Route::post('habilitar-aulas', 'Aulas\AulasController@habilitaraulas')->name('admin.habilitar.aulas');
Route::post('desactivar-aulas', 'Aulas\AulasController@desactivaraulas')->name('admin.desactivar.aulas');
Route::get('delete-aulas/{aulas}', 'Aulas\AulasController@delete')->name('admin.delete.aulas');
Route::get('editar-aulas-activas/{id}/edit','Aulas\AulasController@editaraulaactiva')->name('admin.aulas.activas.editar');
Route::put('actualizar-aulas-activas/{id}','Aulas\AulasController@actualizaraulaactiva')->name('admin.aulas.activas.actualizar');
*/
/**
 * Secuencia
 */
 /*
Route::group(['namespace'=>'Configuracion'], function() {
	Route::resource('secuencia','SecuenciaController',['names'=>'admin.secuencia','only'=>['index','store','edit','update']]);
	Route::get('secuencia-delete/{secuencia}','SecuenciaController@delete')->name('admin.secuencia.delete');
});
*/
/**
 * Evaluacion
 */
 
 /*
Route::group(['namespace'=>'Evaluacion'], function() {
	Route::resource('evaluacion','EvaluacionController',['names'=>'admin.evaluacion','only'=>['index','edit','update']]);
});
*/
/**
 * Mensajes
 */
 /*
Route::group(['namespace'=>'Mensajes'], function() {
	Route::resource('mensajes','MensajesController',['names'=>'admin.mensajes','only'=>['index','show','update']]);
	Route::get('mensajes-atendidos','MensajesController@atendidos')->name('admin.mensajes.atendidos');
});
*/

/**
 * Comunicacion
 */
 /*
Route::group(['namespace'=>'Comunicacion'], function() {
	Route::get('comunicacion','ComunicacionController@index')->name('admin.comunicacion.index');
	Route::post('comunicacion-emails','ComunicacionController@emails')->name('admin.comunicacion.emails');
	Route::post('comunicacion-sms','ComunicacionController@sms')->name('admin.comunicacion.sms');
});*/