<?php

namespace App\Http;

use App\User;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Styde\Html\Alert\Middleware::class,
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\SharePostulanteData::class,
        ],

        'admin' => [
            'web',
            'auth',
            Authorize::class.':admin,'.User::class,

        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'datosok' => \App\Http\Middleware\DatoOkMiddleware::class,
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
		'informes' => \App\Http\Middleware\InformesMiddleware::class,
		'root' => \App\Http\Middleware\RootMiddleware::class,
		'administrador' => \App\Http\Middleware\AdministradorMiddleware::class,
        'verificador'=> \App\Http\Middleware\VerificadorMiddleware::class,
		'sistemas' => \App\Http\Middleware\SistemasMiddleware::class,
		'semibecas'=>\App\Http\Middleware\SemibecasMiddleware::class,
		'semibecassave'=>\App\Http\Middleware\SemibecassaveMiddleware::class,
		'cors' => \App\Http\Middleware\Cors::class,
        'colegio' =>  \App\Http\Middleware\ColegioMiddleware::class,
        'identificacion'=>\App\Http\Middleware\IdentificacionMiddleware::class,
        'ip'=> \App\Http\Middleware\IpMiddleware::class,
        'ingreso'=>\App\Http\Middleware\IngresoMiddleware::class
    ];
}
