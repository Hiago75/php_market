<?php
namespace App\Controllers;

use App\Services\SalesService;
use App\Providers\DataFormaterProvider;

class SalesController
{
  private $salesService;

  public function __construct(SalesService $salesService)
  {
    $this->salesService = $salesService;
  }

  public function get()
  {
    return $this->salesService->getAll();
  }

  public function post($data)
  {
    $requiredKeys = ['subtotal', 'taxes', 'total'];
    $dataIsPresent = DataFormaterProvider::verifyKeys($data, $requiredKeys);
    
    if (!$dataIsPresent) {
      return 'Missing required fields';
    }

    return $this->salesService->save($data['subtotal'], $data['taxes'], $data['total']);
  }
}
