<?php

require __DIR__.'/home.route.php';
require __DIR__.'/users.route.php';
require __DIR__.'/datos.route.php';
require __DIR__.'/pagos.route.php';
require __DIR__.'/ficha.route.php';
require __DIR__.'/reglamento.route.php';
require __DIR__.'/resultados.route.php';
require __DIR__.'/contacto.route.php';
require __DIR__.'/recursos.route.php';
require __DIR__.'/semibeca.route.php';
require __DIR__.'/victimas.route.php';
require __DIR__.'/documento.route.php';
require __DIR__.'/declaracion.route.php';
require __DIR__.'/email.route.php';
require __DIR__.'/sms.route.php';
require __DIR__.'/ingreso.route.php';

Auth::routes();
Route::get('refresh_captcha','CaptchaController@refreshCaptcha')->name('refresh_captchas');
Route::group(['middleware' => ['auth']], function () {
    Route::get('goot4Odik', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});

