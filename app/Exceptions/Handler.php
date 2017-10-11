<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Token not matches'], 400);
            }
            //redirect to a form. Here is an example of how I handle mine
            return redirect($request->fullUrl())->with('csrf_error',"Opps! Seems you couldn't submit form for a longtime. Please try again");
        }

        if ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException) {
            if ($request->expectsJson()) {
                return response('file_large', 422);
            }
        }
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if (preg_match("/^https?:\/\/{$request->getHost()}\/admin/i", $request->fullUrl())) {
            return redirect()->guest(route('admin_login'));
        }
        if (preg_match("/^https?:\/\/{$request->getHost()}\/seller/i", $request->fullUrl())) {
            return redirect()->guest(route('seller_login'));
        }

        return redirect()->guest(route('user_login'));
    }
}
