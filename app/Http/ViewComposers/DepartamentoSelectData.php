<?php
namespace App\Http\ViewComposers;

use App\Models\Departamento;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;
class DepartamentoSelectData
{
	public function compose(View $view)
	{
		$depas = Departamento::orderBy('departamento')->pluck('departamento','id')->toarray();
		
		
		$view->with(compact('depas'));
	}
}