<?php

namespace PreOrder\PreOrderBackend\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use PreOrder\PreOrderBackend\Helpers\JsonResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class CustomExceptionHandler extends ExceptionHandler
{
    protected $dontReport = [
        UnauthorizedException::class,
    ];
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
    }

    public function render($request, Throwable $exception)
    {
        if (! Request::ajax()) {
            return parent::render($request, $exception);
        }

        $exceptionClass = get_class($exception);
        $message = $exception->getMessage();

        $pathExist = in_array($request->path(), ['api/v1/otp/resend', 'api/v1/otp/phone', 'api/v1/registration/phone', 'api/v2/login', 'api/v2/registration']);

        return match ($exceptionClass) {
            NotFoundHttpException::class => JsonResponder::response(message: 'Route Not Found', statusCode: Response::HTTP_NOT_FOUND),
            MethodNotAllowedHttpException::class => JsonResponder::response(message: $message, statusCode: Response::HTTP_METHOD_NOT_ALLOWED),
            ModelNotFoundException::class => JsonResponder::response(message: 'The resource is not found', statusCode: Response::HTTP_NOT_FOUND),
            ValidationException::class => JsonResponder::response(message: 'Validation Failed', errors: $exception->errors(), statusCode: Response::HTTP_UNPROCESSABLE_ENTITY),
            ThrottleRequestsException::class => $pathExist ? JsonResponder::response(message: 'Too Many Attempts Please Contact With Authority.', errors: ['phone' => ['Too Many Attempts Please Contact With Authority.']], statusCode: Response::HTTP_UNPROCESSABLE_ENTITY) : JsonResponder::errorResponse(message: 'Too Many Attempts.', errors: ['message' => ['Too Many Attempts.']], statusCode: Response::HTTP_TOO_MANY_REQUESTS),
            HttpException::class => JsonResponder::response(message: $message, errors: ['message' => [$message]], statusCode: Response::HTTP_SERVICE_UNAVAILABLE),
            default => JsonResponder::response(message:$message, errors: ['message' => [$message]], statusCode: Response::HTTP_INTERNAL_SERVER_ERROR),
        };
    }
}
