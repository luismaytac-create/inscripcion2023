<?php
/**
 * Created by PhpStorm.
 * User: OCAD
 * Date: 3/10/2018
 * Time: 17:28
 */

namespace App\Http\Middleware;
use App\Models\Postulante;
use Closure;
use Alert;
use Auth;
class ColegioMiddleware
{
    public function handle($request, Closure $next)
    {

        if(Auth::user()->colegio == false){

            Auth::logout();
            Alert::danger('Terminos y Condiciones.')
                ->details('Debe Aceptar los términos y condiciones.');
            return redirect()->to('/');


        }
        return $next($request);
    }
}