<?php
namespace App\Services;

use App\Models\ProductType;

class ProductTypeService
{
  private $productType;

  public function __construct(ProductType $model)
  {
    $this->productType = $model;
  }

  public function getAll()
  {
      return $this->productType->getAll();
  }

  public function createProductType(string $name)
  {
    $id = hash('sha256', HASH_KEY);

    return $this->productType->save($id, $name);
  }
}
