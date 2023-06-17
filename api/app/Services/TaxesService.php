<?php

namespace App\Services;

use App\Models\Taxes;

class TaxesService
{
  private $taxes;

  public function __construct(Taxes $model)
  {
    $this->taxes = $model;
  }

  public function getAll()
  {
    return $this->taxes->getAll();
  }

  public function save($typeId, $percentage)
  {
    $id = hash('sha256', HASH_KEY);

    return $this->taxes->save($id, $typeId, (int)$percentage);
  }
}
