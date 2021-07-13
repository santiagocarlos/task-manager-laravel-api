<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\ApiResponser;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ApiResponser;
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
            

            if ($e instanceof ModelNotFoundException) {
                $model = strtolower(class_basename($e->getModel()));
                return $this->errorResponse("There is no instance of {$model} with the specified id", 404);
            }
    
            if ($e instanceof AuthorizationException) {
                return $this->errorResponse('You do not have permissions to execute this action', 403);
            }
    
            if ($e instanceof NotFoundHttpException) {
                return $this->errorResponse('The specified URL was not found', 404);
            }
    
            if ($e instanceof MethodNotAllowedHttpException) {
                return $this->errorResponse('The method specified in the request is invalid', 405);
            }
    
            if ($e instanceof HttpException) {
                return $this->errorResponse($e->getMessage(), $e->getStatusCode());
            }

    
            return $this->errorResponse('Falla inesperada. Intente luego', 500);
        });
    }
}
