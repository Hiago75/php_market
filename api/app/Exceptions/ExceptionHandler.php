<?php

namespace App\Exceptions;

class ExceptionHandler
{
    private $exceptionMapping = [
        NotFoundException::class => ['status' => 404, 'message' => 'Not Found'],
        MethodNotAllowedException::class => ['status' => 405, 'message' => 'Method Not Allowed'],
        InvalidRequestException::class => ['status' => 400, 'message' => 'Invalid Request'],
        UnauthorizedException::class => ['status' => 401, 'message' => 'Unauthorized'],
        DatabaseException::class => ['status' => 500, 'message' => 'Internal Server Error'],
    ];

    public function handleException($exception)
    {
        $statusCode = 500;
        $message = 'Internal Server Error';

        echo $exception;

        foreach ($this->exceptionMapping as $exceptionClass => $mapping) {
            if ($exception instanceof $exceptionClass) {
                $statusCode = $mapping['status'];
                $message = $mapping['message'];
                break;
            }
        }

        http_response_code($statusCode);
        echo json_encode(['error' => $message]);
        die();
    }

    public function handleError($errno, $errstr, $errfile, $errline)
    {
        if (error_reporting() === 0) {
            return;
        }

        $errorMapping = [
            E_ERROR => ['status' => 500, 'message' => 'Internal Server Error'],
            E_WARNING => ['status' => 400, 'message' => 'Warning'],
        ];

        if (array_key_exists($errno, $errorMapping)) {
            $error = $errorMapping[$errno];
            $statusCode = $error['status'];
            $errorMessage = $error['message'];
        } else {
            $statusCode = 500;
            $errorMessage = 'Internal Server Error';
        }

        http_response_code($statusCode);
        echo json_encode(['error' => $errorMessage]);

        throw new \Exception($errstr, $statusCode);

        exit();
    }
}
