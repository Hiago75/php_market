<?php
namespace App\Controllers;

use App\Services\SalesService;

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
}
