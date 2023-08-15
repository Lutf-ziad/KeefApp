<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            if ($exception instanceof ModelNotFoundException) {
                throw new HttpResponseException(response()->json(['data' => []]));
            } elseif ($exception instanceof NotFoundHttpException) {
                throw new HttpResponseException(
                    response()->json(['status' => false, 'message' => 'Route Not Found', 'error_num' => 3, 'erros' => []], 404)
                );
            } elseif ($exception instanceof ValidationException) {
                throw new HttpResponseException(
                    response()->json(['status' => false, 'message' => 'Validation Error', 'error_num' => 5, 'erros' => $exception->errorsAll()], 422)
                );
            } elseif ($exception instanceof AuthenticationException) {
                throw new HttpResponseException(
                    response()->json(['status' => false, 'message' => 'Unauthenticated', 'error_num' => 2, 'erros' => []], 401)
                );
            } elseif ($exception instanceof AuthorizationException) {
                throw new HttpResponseException(
                    response()->json(['status' => false, 'message' => $exception->getMessage(), 'error_num' => 1, 'erros' => []], 403)
                );
            } elseif ($exception instanceof QueryException) {
                throw new HttpResponseException(
                    response()->json(['status' => false, 'message' => $exception->getMessage(), 'error_num' => 8, 'erros' => []], 400)
                );
            }
        }
        if ($request->expectsJson()) {
            if ($exception instanceof ModelNotFoundException) {
                return new HttpResponseException(
                    response()->json(['status' => false, 'message' => 'Resource Not Found', 'error_num' => 7, 'erros' => []], 404)
                );
            }
        }

        return parent::render($request, $exception);
    }

    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
