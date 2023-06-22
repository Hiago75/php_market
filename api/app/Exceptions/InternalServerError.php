<?php
namespace App\Exceptions;

use Exception;

class InternalServerError extends Exception
{
  public function __construct($message = 'Internal server error', $statusCode = 500)
  {
      parent::__construct($message, $statusCode);
  }
}