<?php
namespace App\Services;

use App\Models\ProductType;
use App\Providers\HashProvider;

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

  public function save(string $name)
  {
    $id = HashProvider::generateHash($name);

    return $this->productType->save($id, $name);
  }
}
