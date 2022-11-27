<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //

        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if($request->expectsJson()){
            return response()->json(['success'=> false , 'data' => 'Unauthenticated'], 401);
        }else{
          return  redirect()->guest($exception->redirectTo() ?? route('login'))  ;
        }
    }

    protected function prepareJsonResponse($request, Throwable $e)
    {

        // This will replace our 404 response with
        // a JSON response.
        if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
            return response()->json([
                'success' => false,
                'data' => 'Resource not found'
            ], 404);
        }elseif ($e instanceof MethodNotAllowedHttpException){
            return response()->json([
                'success' => false,
                'data' => 'Resource not allowed'
            ], 400);
        } else {
            return new JsonResponse(
                [
                    'success' => false,
                    'data' => $e->getMessage(),
                ],
                $this->isHttpException($e) ? $e->getStatusCode() : 500, [],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            );
        }
    }
}
