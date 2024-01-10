<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //

        'dia3-resultados',
        'resultado-dia3-final-ocad-uni',
        'resultado-prueba',
		'resultado-pruebafinal',
        'resultado-sabado-vocacional',
        'primera-prueba-resultados',
        'prueba-segunda-2-resultados',
        'resultados-finales-admision',
        'resultado-cepre-vocacional',
        'admin/asistencia',
        'asistencia',
        'admin.sorteo.index'
    ];
}
