<?php

namespace App\Providers;

use App\Http\ViewComposers\AulasActivasSelectData;
use App\Http\ViewComposers\ComplementarioSelectData;
use App\Http\ViewComposers\ControlSelectData;
use App\Http\ViewComposers\EspecialidadSelectData;
use App\Http\ViewComposers\ModalidadSelectData;
use App\Http\ViewComposers\PaisSelectData;
use App\Http\ViewComposers\RoleSelectData;
use App\Http\ViewComposers\ServicioSelectData;
use App\Http\ViewComposers\SexoSelectData;
use App\Http\ViewComposers\TipoIdentificacionSelectData;
use App\Http\ViewComposers\DepartamentoSelectData;

use App\Models\Postulante;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->make('view')->composer(
            ['datos.personal.index','datos.personal.edit'],
            ModalidadSelectData::class
            );
        $this->app->make('view')->composer(
            ['datos.personal.index','datos.personal.edit','datos.complementarios.index','datos.complementarios.edit','admin.ingresantes.show'],
            EspecialidadSelectData::class
            );
        $this->app->make('view')->composer(
            ['datos.secundarios.index'],
            SexoSelectData::class
            );
        $this->app->make('view')->composer(
            ['datos.complementarios.index','datos.complementarios.edit','admin.ingresantes.show'],
            ComplementarioSelectData::class
            );
        $this->app->make('view')->composer(
            ['admin.users.index','admin.users.edit','admin.users.delete'],
            RoleSelectData::class
            );
        $this->app->make('view')->composer(
            ['admin.aulas.activas'],
            AulasActivasSelectData::class
            );
        $this->app->make('view')->composer(
            ['admin.colegio.index','datos.personal.index','datos.personal.edit','datos.secundarios.index',
            'admin.universidad.index','admin.colegio.modals.create','admin.colegio.editar','admin.universidad.editar',
             'admin.ubigeo.modals.create'
                ],
            PaisSelectData::class
            );
        $this->app->make('view')->composer(
            ['datos.personal.index','datos.personal.edit','datos.secundarios.index'],
            TipoIdentificacionSelectData::class
            );
        $this->app->make('view')->composer(
            ['admin.descuentos.index','admin.descuentos.edit','admin.pagos.index','admin.cartera.edit','admin.cartera.index'],
            ServicioSelectData::class
            );
		$this->app->make('view')->composer(
            ['datos.personal.index','datos.personal.edit',
                'admin.postulantes.show', 'admin.ubigeo.modals.create'],
            DepartamentoSelectData::class
            );

        $this->app->make('view')->composer(
            ['ficha.falso','datos.personal.modalidad','datos.index','datos.personal.index','datos.personal.edit','datos.secundarios.index','datos.familiar.index','datos.familiar.edit',
                'datos.complementarios.index','datos.complementarios.edit','pagos.index','pagos.list','pagos.bloqueo','reglamento.index',
                'contacto.index','ficha.index','ficha.bloqueo','ficha.confirmacion','semibeca.index','datos.email.index','datos.email.ok','datos.foto.foto'], function ($view)
        {
            $postulante = Postulante::Usuario()->first();
            $swp = !is_null($postulante);

            $view->with('swp', $swp);
        });
			
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
