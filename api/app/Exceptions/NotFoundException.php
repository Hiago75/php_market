<?php
namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception{
  public function __construct($message = 'Not found', $statusCode = 404)
  {
      parent::__construct($message, $statusCode);
  }
}