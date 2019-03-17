<?php

namespace App\Exceptions;

use Exception;
use HttpException;
use HttpResponseException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        if (!$request->wantsJson()) {
            return parent::render($request, $exception);
        }

        $errors = [];
        $status = 500;
        if ($exception->getMessage() instanceof MethodNotAllowedHttpException) {
            $status = 405;
        } elseif ($exception instanceof NotFoundHttpException) {
            $status = 404;
        } elseif ($exception instanceof ModelNotFoundException) {
            $status = 404;
        } elseif ($exception instanceof AuthorizationException) {
            $status = 403;
        } elseif ($exception instanceof ValidationException) {
            $status = 400;
            $errors = $exception->errors();
        }

        $responseData = [
            'success' => false,
            'status' => $status,
            'message' => $exception->getMessage(),
            'errors' => $errors,
        ];

        if (env('APP_DEBUG')) {
            $responseData['trace'] = $exception->getTrace();
        }

        return response()->json($responseData, $status);
    }
}
