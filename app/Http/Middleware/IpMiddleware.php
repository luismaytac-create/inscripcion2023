<?php
/**
 * Created by PhpStorm.
 * User: OCAD
 * Date: 3/10/2018
 * Time: 17:28
 */

namespace App\Http\Middleware;
use App\Models\ReglasIp;
use Closure;
use Alert;
use Illuminate\Support\Facades\Log;
use Auth;
class IpMiddleware
{
    public function handle($request, Closure $next)
    {

        $ip=$request->getClientIp();

        $userid=Auth::user()->id;


        $regla=ReglasIp::where('idusuario',$userid)->first();

        if($regla->externo == true){

            return $next($request);
        }


        if($regla->ocad== true){

           if(  substr( $ip ,'0' ,'10' ) =='172.20.68.' ){
               return $next($request);
           }else{
               Auth::logout();
               Alert::danger('Permiso Denegado')
                   ->details('No puede iniciar Sesión fuera de la red que fue asignada.');
               return redirect()->to('/');
           }
        }


        if($regla->fijo== true){
            if(  substr( $ip ,'0' ,'10' ) ==$regla->ip ){
                return $next($request);
            }else{
                Auth::logout();
                Alert::danger('Permiso Denegado')
                    ->details('No puede iniciar Sesión fuera de la red que fue asignada.');
                return redirect()->to('/');
            }

        }






    }
}