<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
        'password_repeat'
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

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException && $request->wantsJson()) {
            $modelName  = __('models.model');
            $message    = trans('messages.error.model_not_found', ['model' => $modelName]);
            return response()->json(['message' => $message], 404);
        }
    
        if ($e instanceof NotFoundHttpException && $request->wantsJson()) {
            $message = trans('messages.error.route_not_found');
            return response()->json(['message' => $message], 404);
        }

        return parent::render($request, $e);
    }
}
