<?php
namespace App\Http\Middleware;
use Closure;
use Alert;
use App\Models\Postulante;
use Illuminate\Routing\Route;
class SemibecaMiddleware
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
        $datos = Postulante::Usuario()->Activos()->first();
        if(isset($datos)){
            if($datos->pago ){
                Alert::info('Usted ya no puede modificar sus datos');
                return redirect()->route('home.index');
            }
        }
		
		/*if(true){
            
                Alert::info('Los resultados serán publicados el dia 11 de julio');
                return redirect()->route('home.index');
            
        }*/
		
		
        return $next($request);
    }
}