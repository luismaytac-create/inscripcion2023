<?php
namespace App\Http\ViewComposers;

use App\Models\Aula;
use App\Models\Catalogo;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class AulasActivasSelectData
{
	public function compose(View $view)
	{
		$sectores = Aula::select('sector as id','sector')
							->Activas()
							->groupBy('sector')
							->orderBy('sector')
							->pluck('sector','id')
							->toArray();
		$view->with(compact('sectores'));
	}
}