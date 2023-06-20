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
    $requiredKeys = ['products', 'subTotal', 'taxes', 'total'];
    $dataIsPresent = DataFormaterProvider::verifyKeys($data, $requiredKeys);
    
    if (!$dataIsPresent) {
      return 'Missing required fields';
    }

    return $this->salesService->save($data['products'], $data['subTotal'], $data['taxes'], $data['total']);
  }
}
