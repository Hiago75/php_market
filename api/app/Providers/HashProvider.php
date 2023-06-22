<?php

namespace App\Providers;

use App\Exceptions\BadRequest;

class HashProvider
{
  public static function generateHash($data)
  {
    if (empty($data)) {
      throw new BadRequest('Campos obrigatórios ausentes.');
    }

    return hash('sha256', $data);
  }
}
