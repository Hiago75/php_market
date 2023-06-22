<?php

namespace App\Exceptions;

use App\Exceptions\BadRequest;

class ExceptionHandler
{
    public function handleException($exception)
    {
        $statusCode = 500;
        $message = 'Internal Server Error';

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
