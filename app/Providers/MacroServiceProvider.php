<?php

namespace App\Providers;

use App\Services\Macros;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->ControlBack();
        $this->ControlSubmit();
        $this->ControlBoton();
        $this->ControlBotonModal();
        $this->ControlMenu();
        $this->ControlMenuLink();
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
    /**
     * Bonto regresar
     */
    public function ControlBack()
    {
        $macro = new Macros();
        return $macro->back();
    }
    /**
     * Boton Guardar
     */
    public function ControlSubmit()
    {
        $macro = new Macros();
        return $macro->enviar();
    }
    /**
     * Boton
     */
    public function ControlBoton()
    {
        $macro = new Macros();
        return $macro->boton();
    }
    /**
     * Boton
     */
    public function ControlBotonModal()
    {
        $macro = new Macros();
        return $macro->botonmodal();
    }
    /**
     * Menu
     */
    public function ControlMenu()
    {
        $macro = new Macros();
        return $macro->Menu();
    }
    /**
     * Menu Link
     */
    public function ControlMenuLink()
    {
        $macro = new Macros();
        return $macro->MenuLink();
    }
}
