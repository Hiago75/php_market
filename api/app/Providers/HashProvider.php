<?php

namespace App\Providers;

class HashProvider
{
  public static function generateHash($data)
  {
    if (empty($data)) {
      throw new \InvalidArgumentException('Missing data to generate the hash');
    }

    return hash('sha256', $data);
  }
}
