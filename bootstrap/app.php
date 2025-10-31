<?php

use App\Http\Middleware\isAdministrator;
use App\Http\Middleware\isDokter;
use App\Http\Middleware\isPemilik;
use App\Http\Middleware\isPerawat;
use App\Http\Middleware\isResepsionis;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'isAdmin' => isAdministrator::class,
            'isDokter' => isDokter::class,
            'isPerawat' => isPerawat::class,
            'isResepsionis' => isResepsionis::class,
            'isPemilik' => isPemilik::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
