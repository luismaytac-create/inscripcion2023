<?php
namespace App\Http\ViewComposers;

use App\Models\Servicio;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use DB;
class ServicioSelectData
{
	public function compose(View $view)
	{
		$servicios = Servicio::select(DB::raw("monto||' - '||descripcion as nombre"),'id')->Activo()->orderBy('descripcion')->pluck('nombre','id')->toarray();
		$servicios_total = Servicio::orderBy('descripcion')->pluck('descripcion','id')->toarray();
		$servicio_descuento = Servicio::Activo()
										->whereIn('codigo',['466','467'])
										->orderBy('descripcion')
										->pluck('descripcion','id')
										->toarray();
		$view->with(compact('servicios','servicio_descuento','servicios_total'));
	}
}