<?php
namespace App\Exceptions;

use Exception;

class BadRequest extends Exception
{
  public function __construct($message = 'Invalid Request', $statusCode = 400)
  {
      parent::__construct($message, $statusCode);
  }
}