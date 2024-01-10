<?php
namespace App\Http\ViewComposers;

use App\Models\Colegio;
use App\Models\Pais;
use App\Models\Ubigeo;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class PaisSelectData
{
	public function compose(View $view)
	{
		$pais = Pais::Activo()->orderBy('nombre')->pluck('nombre','id')->toarray();


		$ubigeonew = Ubigeo::where('activo',true)->whereRaw('SUBSTRING(codigo,5,2) <> 00::varchar(255)')->pluck('descripcion','id')->toarray();
		$view->with(compact('pais', 'ubigeonew'));
	}
}