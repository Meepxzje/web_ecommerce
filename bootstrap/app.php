<?php

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
            'admin'=> \App\Http\Middleware\AdminMiddleware::class,
            'checkdangnhap'=> \App\Http\Middleware\Kiemtradangnhap::class,
            'checkthongtin'=> \App\Http\Middleware\Kiemtrathongtin::class,
            'checkthanhtoan'=> \App\Http\Middleware\Kiemtrathanhtoan::class,
            'checkxacthuc'=> \App\Http\Middleware\checkxacthuc::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
