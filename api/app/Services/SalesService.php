<?php
namespace App\Services;

use App\Models\Sales;
use App\Providers\HashProvider;

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

  public function save($productId, $quantity, $saleDate)
  {
    $id = HashProvider::generateHash($productId);

    return $this->sales->save($id, $productId, $quantity, $saleDate);
  }
}
