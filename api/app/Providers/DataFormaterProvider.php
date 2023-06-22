<?php

namespace App\Providers;

class DataFormaterProvider
{
  private static function flattenArrayKeys($array)
  { 
    $keys = [];

    foreach ($array as $key => $value) {
        $keys[] = $key;
    }

    return $keys;
  }

  public static function verifyKeys($data, $requiredKeys)
  {
    
      if (empty($data) || !is_array($data)) {
          return false;
      }
      
      $keys = self::flattenArrayKeys($data);
  
      return count($keys) === count($requiredKeys);
  }
}
