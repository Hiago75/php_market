<?php
namespace App\Exceptions;

use Exception;

class InvalidArgumentException extends Exception
{
  public function __construct($message = 'Invalid Request', $statusCode = 422)
  {
      parent::__construct($message, $statusCode);
  }
}