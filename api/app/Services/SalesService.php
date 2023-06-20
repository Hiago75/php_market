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

  public function save($products, $subtotal, $taxes, $total)
  {
    $saleDate = date('Y-m-d');
    $saleId = HashProvider::generateHash(date('Y-m-d H:i:s').$subtotal);

    return $this->sales->save($products, $saleId, $subtotal, $taxes, $total, $saleDate);
  }
}
