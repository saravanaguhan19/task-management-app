<?php

use App\Helpers\FormatResponse;
use App\Http\Middleware\ForceJsonRequestHeader;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->append(ForceJsonRequestHeader::class);

        $middleware->priority([
            ForceJsonRequestHeader::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // custom response sanctum
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return FormatResponse::error('Error', 401, ["message" => "user not authenticated"]);
            }
        });
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return FormatResponse::error('Error', 404, ["message" => "Data not found"]);
            }
        });
        $exceptions->render(function (AccessDeniedHttpException  $e, Request $request) {
            if ($request->is('api/*')) {
                return FormatResponse::error('Error', 404, ["message" => $e->getMessage()]);
            }
        });
    })->create();
