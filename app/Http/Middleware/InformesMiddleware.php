<?php
namespace App\Http\Middleware;
use Closure;
use Alert;
use Auth;
use App\Models\Postulante;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
class InformesMiddleware
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
        $datos = Auth::user()->role->nombre;
		
		switch (Auth::user()->role->nombre) {
            case 'root':
				
                 return $next($request);
                break;
				
			case 'Administrador':
				
                 return $next($request);
                break;
            case 'Jefatura':
				
                 return $next($request);
                break;
			case 'Sistemas':
				
                 return $next($request);
                break;

            case 'Verificador':

                return $next($request);
                break;
            case 'Editor Foto':

                return $next($request);
                break;
            case 'Informes':
				
                 return $next($request);
                break;
				
            default:
			Alert::info('No tiene privilegios para realizar esta acción');
               return redirect()->route('home.index');
                break;
        }
		
		
		
        /*if(isset($datos)){
            if($datos->pago ){
                Alert::info('Usted ya no puede modificar sus datos');
                return redirect()->route('home.index');
            }
        }*/
        return $next($request);
    }
}