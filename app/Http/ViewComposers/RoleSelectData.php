<?php
namespace App\Http\ViewComposers;

use App\Models\Catalogo;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
/**
 * Primero Creas la clase objeto+el modelo+formulario a tu gusto
 * dentro de la carpeta creada en http/ViewComposers
 * 2) php artisan make:provider ViewServiceProviders o en AppServiceProvider
 * 3) si creas un providder registralo en conf/app
 * 4)
 */
class RoleSelectData
{
	public function compose(View $view)
	{
		$roles = ['-1' => 'Seleccionar Rol']+Catalogo::Combo('ROLES')->pluck('nombre','id')->toarray();
		$view->with(compact('roles'));
	}
}