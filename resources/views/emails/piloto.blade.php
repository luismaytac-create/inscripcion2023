<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<?php
$style = [
    /* Layout ------------------------------ */
    'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
    'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',
    /* Masthead ----------------------- */
    'email-masthead' => 'padding: 25px 0; text-align: center;',
    'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',
    'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
    'email-body_inner' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0;',
    'email-body_cell' => 'padding: 35px;',
    'email-footer' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;',
    'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',
    /* Body ------------------------------ */
    'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
    'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',
    /* Type ------------------------------ */
    'anchor' => 'color: #3869D4;',
    'header-1' => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
    'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
    'paragraph-sub' => 'margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;',
    'paragraph-center' => 'text-align: center;',
    /* Buttons ------------------------------ */
    'button' => 'display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                 text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',
    'button--green' => 'background-color: #22BC66;',
    'button--red' => 'background-color: #dc4d2f;',
    'button--blue' => 'background-color: #3869D4;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>

<body style="{{ $style['body'] }}">
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td style="{{ $style['email-wrapper'] }}" align="center">
            <table width="100%" cellpadding="0" cellspacing="0">
                <!-- Logo -->
                <tr>
                    <td style="{{ $style['email-masthead'] }}">
                        <a style="{{ $fontFamily }} {{ $style['email-masthead_name'] }}" href="http://inscripcion.admision.uni.edu.pe" target="_blank">
                            {{ config('app.name') }}
                        </a>
                    </td>
                </tr>

                <!-- Email Body -->
                <tr>
                    <td style="{{ $style['email-body'] }}" width="100%">
                        <table style="{{ $style['email-body_inner'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="{{ $fontFamily }} {{ $style['email-body_cell'] }}">
                                    <!-- Greeting -->
                                    <h1 style="{{ $style['header-1'] }}">Estimado postulante,</h1>

                                    <!-- Intro -->
                                    <p>Mediante el presente se remiten las Guías que le permitirá desarrollar la Prueba piloto y el examen .</p>

                                    <p>Es obligatorio leer ambas Guías, con la debida antelación, antes de rendir la prueba piloto</p>
                                    <p>Para consultas solo de prueba piloto y examen, en el horario del turno correspondiente: al número 981607838(solo WhatsApp)</p>
                                    <p>Las credenciales de acceso para su registro en el sistema de aplicación para la prueba piloto y el examen son:</p>

                                    <p style="color: red;"><strong>Las credenciales de acceso estarán activas según el turno que le corresponde.</strong></p>

                                    <h4>Usuario: {{ $usuario }}</h4>
                                    <h4>Clave: {{ $clave }}</h4>
                                    <h4>Horario de Ingreso PRUEBA PILOTO: {{ $piloto }}</h4>
                                    <h3>GUÍA DE LA PRUEBA PILOTO</h3>
                                    <a href="http://inscripcion.admision.uni.edu.pe/guia_prueba_piloto.pdf"
                                       style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;color:#fff;text-decoration:none;line-height:2em;font-weight:bold;text-align:center;display:inline-block;border-radius:5px;text-transform:capitalize;background-color:#22bb33;margin:0;border-color:#22bb33;border-style:solid;border-width:10px 20px"
                                       rel="noreferrer" target="_blank"
                                    >DESCARGAR GUÍA DE LA PRUEBA PILOTO</a>
                                    <h3>GUÍA DE LA EVALUACIÓN</h3>
                                    <a href="http://inscripcion.admision.uni.edu.pe/guia_examen.pdf"
                                       style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;color:#fff;text-decoration:none;line-height:2em;font-weight:bold;text-align:center;display:inline-block;border-radius:5px;text-transform:capitalize;background-color:#22bb33;margin:0;border-color:#22bb33;border-style:solid;border-width:10px 20px"
                                       rel="noreferrer" target="_blank"
                                    >DESCARGAR GUÍA DE LA PRUEBA PILOTO</a>

                                    <h3>
                                        Presione el botón para abrir la plataforma
                                    </h3>

                                    <a href="https://uni.mrooms.net" style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;color:#fff;text-decoration:none;line-height:2em;font-weight:bold;text-align:center;display:inline-block;border-radius:5px;text-transform:capitalize;background-color:#348eda;margin:0;border-color:#348eda;border-style:solid;border-width:10px 20px"
                                       rel="noreferrer" target="_blank" >INGRESAR A LA PLATAFORMA</a>

                                    <!-- Salutation -->
                                    <p style="{{ $style['paragraph'] }}">
                                        Saludos,<br>{{ config('app.name') }}
                                    </p>


                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td>
                        <table style="{{ $style['email-footer'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="{{ $fontFamily }} {{ $style['email-footer_cell'] }}">
                                    <p style="{{ $style['paragraph-sub'] }}">
                                        &copy; {{ date('Y') }}
                                        <a style="{{ $style['anchor'] }}" href="http://admision.uni.edu.pe" target="_blank">{{ config('app.name') }}</a>.
                                        Todos los derechos reservados.
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>