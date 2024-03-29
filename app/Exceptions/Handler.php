<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
       // return parent::render($request, $exception);
       if ($exception instanceof ModelNotFoundException) {
        return response()->json(['message' => 'Could not find such record in model'], 404);
    }
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 401);
        }
        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 401);
        }
        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 401);
        }

        return parent::render($request, $exception);

        }
}
