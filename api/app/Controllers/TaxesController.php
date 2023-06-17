<?php
namespace App\Controllers;

use App\Services\TaxesService;
use App\Services\DataHelperService;

class TaxesController
{
  private $taxesService;
  
  public function __construct($taxesService)
  {
    $this->taxesService = $taxesService;
  }

  public function get()
  {
    return $this->taxesService->getAll();
  }

  public function post($data)
  {
    $requiredKeys = ['type_id', 'percentage'];
    $dataIsPresent = DataHelperService::verifyKeys($data, $requiredKeys);
    
    if (!$dataIsPresent) {
      return 'Missing required fields';
    }

    return $this->taxesService->save($data['type_id'], $data['percentage']);
  }
}
