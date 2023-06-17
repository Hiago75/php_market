<?php
namespace App\Services;

use App\Models\Products;
use App\Providers\HashProvider;

class ProductsService
{
  private $products;

  public function __construct(Products $model)
  {
    $this->products = $model;
  }

  public function getAll()
  {
      return $this->products->getAll();
  }

  public function save($name, $typeId, $price)
  {
    $id = HashProvider::generateHash($name);

    return $this->products->save($id, $name, $typeId, (float)$price);
  }
}
