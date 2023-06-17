<?php

namespace App\Services;

class DataHelperService
{
  public static function verifyKeys($data, $requiredKeys)
  {
    if (empty($data)) {
      return false;
    }

    return count(array_intersect($requiredKeys, array_keys($data))) === count($requiredKeys);
  }
}
