<?php
namespace App\Controllers;

use App\Services\TaxesService;
use App\Providers\DataFormaterProvider;

class TaxesController
{
  private $taxesService;
  
  public function __construct($taxesService)
  {
    $this->taxesService = $taxesService;
  }

  public function get($id = null)
  {
    if ($id !== null) {
      return $this->taxesService->getById($id);
  }

  return $this->taxesService->getAll();
  }

  public function post($data)
  {
    $requiredKeys = ['type_id', 'percentage'];
    $dataIsPresent = DataFormaterProvider::verifyKeys($data, $requiredKeys);
    
    if (!$dataIsPresent) {
      return 'Missing required fields';
    }

    return $this->taxesService->save($data['type_id'], $data['percentage']);
  }
}
