<?php

use App\Http\Middleware\CheckAdmine;
use App\Http\Middleware\CheckMedecin;
use App\Http\Middleware\CheckPatient;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isadmin'=>CheckAdmine::class,
            'ismedecin' => CheckMedecin::class,
            'ispatient' => CheckPatient::class,
            'guest' => RedirectIfAuthenticated::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
