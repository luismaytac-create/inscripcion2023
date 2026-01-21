<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View; // Importa View
use App\Models\Postulante; // Importa tu modelo

class SharePostulanteData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) { // Solo si el usuario está logueado
            $postulante = Postulante::Usuario()->first();
            $swp = false;
            $requiereDocumentos = false;

            if ($postulante) {
                $swp = true; // O !is_null($postulante);

                // Calcula $requiereDocumentos
                if (!is_null($postulante->idmodalidad2)) {
                    if ($postulante->idmodalidad2 <> 1 and $postulante->idmodalidad2 <> 17 and $postulante->idmodalidad2 <> 23) {
                        $requiereDocumentos = true;
                    }
                } else {
                    if (isset($postulante->idmodalidad)) {
                        if ($postulante->idmodalidad <> 1 and $postulante->idmodalidad <> 16 and $postulante->idmodalidad <> 17 and $postulante->idmodalidad <> 23) {
                            $requiereDocumentos = true;
                        }
                    }
                }
            }
           

            // Comparte las variables con TODAS las vistas de esta petición
            View::share('postulante', $postulante); // Opcional, si necesitas $postulante en las vistas
            View::share('swp', $swp);
            View::share('requiereDocumentos', $requiereDocumentos);

        } else {
            // Comparte valores por defecto si no está logueado
            View::share('postulante', null);
            View::share('swp', false);
            View::share('requiereDocumentos', false);
        }

        return $next($request); // Continúa con la petición
    }
}