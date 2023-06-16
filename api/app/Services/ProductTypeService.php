<?php
namespace App\Services;

use App\Models\ProductType;

class ProductTypeService
{
  private $productType;

  public function __construct($model) {
    $this->productType = $model;
  }

  public function getAllProductTypes()
  {
      return $this->productType->getAllProductTypes();
  }
}