<?php
namespace App\Services;

use App\Models\Products;

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
}
