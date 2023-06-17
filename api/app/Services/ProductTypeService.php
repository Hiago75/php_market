<?php
namespace App\Services;

use App\Models\ProductType;

class ProductTypeService
{
  private $productType;

  public function __construct($model)
  {
    $this->productType = $model;
  }

  public function getAllProductTypes()
  {
      return $this->productType->getAllProductTypes();
  }

  public function createProductType(string $name)
  {
    $id = hash('sha256', HASH_KEY);

    return $this->productType->save($id, $name);
  }
}
