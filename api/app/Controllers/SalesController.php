<?php
namespace App\Controllers;

use App\Services\SalesService;
use App\Providers\DataFormaterProvider;
use App\Exceptions\BadRequest;

class SalesController
{
  private $salesService;

  public function __construct(SalesService $salesService)
  {
    $this->salesService = $salesService;
  }

  public function index()
  {
    return $this->salesService->getAll();
  }

  public function create($data)
  {
    $requiredKeys = ['products', 'subTotal', 'taxes', 'total'];
    $dataIsPresent = DataFormaterProvider::verifyKeys($data, $requiredKeys);
    
    if (!$dataIsPresent || count($data['products']) < 1) {
      throw new BadRequest('Missing required fields');
    }

    return $this->salesService->save($data['products'], $data['subTotal'], $data['taxes'], $data['total']);
  }
}
