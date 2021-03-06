<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\VerificarToken;
use App\Http\Middleware\AutenticarVisitante;
use App\Http\Middleware\VerificarCodigoVisitante;

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
        \Barryvdh\Cors\HandleCors::class,
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
        'verificar_token' => \App\Http\Middleware\VerificarToken::class,
        'autenticacao' => \App\Http\Middleware\Autenticacao::class,
        'validar_registo_do_primeiro_utilizador' => \App\Http\Middleware\ValidarRegistoDeUtilizador::class,
        'verificar_existencia_do_curso' => \App\Http\Middleware\VerificarExistenciaDoCurso::class,
        'validar_edicao_do_curso' => \App\Http\Middleware\ValidarEdicaoDoCurso::class,
        'validar_criacao_do_curso'=>\App\Http\Middleware\ValidarCriacaoDoCurso::class ,

        'verificar_existencia_do_departamento' => \App\Http\Middleware\VerificarExistenciaDoDepartamento::class,
        'validar_edicao_do_departamento' => \App\Http\Middleware\ValidarEdicaoDoDepartamento::class,
        'validar_departamento'=>\App\Http\Middleware\ValidarDepartamento::class,

        'verificar_existencia_do_utilizador' => \App\Http\Middleware\VerificarExistenciaDoUtilizador::class,
        'validar_edicao_do_utilizador' => \App\Http\Middleware\ValidarEdicaoDoUtilizador::class,
        'validar_utilizador'=>\App\Http\Middleware\ValidarUtilizador::class,

        'verificar_existencia_do_visitante' => \App\Http\Middleware\VerificarExistenciaVisitante::class,
        'validar_edicao_do_visitante' => \App\Http\Middleware\ValidarEdicaoVisitante::class,
        'validar_criacao_do_visitante'=>\App\Http\Middleware\ValidarCriacaoVisitante::class ,

        'verificar_existencia_do_projectista' => \App\Http\Middleware\VerificarExistenciaProjectista::class,
        'validar_edicao_do_projectista' => \App\Http\Middleware\ValidarEdicaoProjectista::class,
        'validar_criacao_do_projectista'=>\App\Http\Middleware\ValidarCriacaoProjectista::class ,

        'verificar_existencia_do_projecto' => \App\Http\Middleware\VerificarExistenciaProjecto::class,
        'validar_edicao_do_projecto' => \App\Http\Middleware\ValidarEdicaoProjecto::class,
        'validar_criacao_do_projecto'=> \App\Http\Middleware\ValidarCriacaoProjecto::class ,

        'verificar_existencia_do_criterio' => \App\Http\Middleware\VerificarExistenciaCriterio::class,
        'validar_edicao_do_crietrio' => \App\Http\Middleware\ValidarEdicaoCriterio::class,
        'validar_criacao_do_criterio'=>\App\Http\Middleware\ValidarCriacaoCriterio::class ,

        'validar_voto'=> \App\Http\Middleware\ValidarVoto::class,
        'verificar_credenciais_do_visitante' => \App\Http\Middleware\AutenticarVisitante::class,
        'verificar_codigo_visitante' => \App\Http\Middleware\VerificarCodigoVisitante::class,
        "validar_url"=>\App\Http\Middleware\ValidarMensagem::class,
         "validar_conteudo"=>\App\Http\Middleware\ValidarConteudoDaMensagem::class,

        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

    ];
}
