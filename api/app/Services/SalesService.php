<?php
namespace App\Services;

use App\Models\Sales;

class SalesService
{
  private $sales;

  public function __construct(Sales $model)
  {
    $this->sales = $model;
  }

  public function getAll()
  {
    return $this->sales->getAll();
  }
}
