<?php

namespace App\Http;

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
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
        ],

        'api' => [
            'throttle:60,1',
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
        'verificar_existencia_do_curso' => \App\Http\Middleware\VerificarExistenciaDoCurso::class,
        'validar_edicao_do_curso' => \App\Http\Middleware\ValidarEdicaoDoCurso::class,

        'verificar_existencia_do_departamento' => \App\Http\Middleware\VerificarExistenciaDoDepartamento::class,
        'validar_edicao_do_departamento' => \App\Http\Middleware\ValidarEdicaoDoDepartamento::class,
        'validar_criacao_do_curso'=>\App\Http\Middleware\ValidarCriacaoDoCurso::class ,

        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'validar_departamento'=>\App\Http\Middleware\ValidarDepartamento::class,
        'validar_criterio'=>\App\Http\Middleware\ValidarCriterio::class ,
        'validar_projectista'=>\App\Http\Middleware\ValidarProjectista::class ,
        'validar_projecto'=>\App\Http\Middleware\ValidarProjecto::class ,
        'validar_visitante'=>\App\Http\Middleware\ValidarVisitante::class,
    ];
}
