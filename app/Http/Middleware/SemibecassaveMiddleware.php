<?php
namespace App\Http\Middleware;
use Closure;
use Alert;
use Auth;
use App\Models\Postulante;
use Illuminate\Routing\Route;
class SemibecassaveMiddleware
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
                break;
			case 'Sistemas':
				
                 return $next($request);
                break;					
			case 'semibeca':
				
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