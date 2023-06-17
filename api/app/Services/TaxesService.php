<?php

namespace App\Services;

use App\Models\Taxes;
use App\Providers\HashProvider;

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
    $id = HashProvider::generateHash($typeId);

    return $this->taxes->save($id, $typeId, (int)$percentage);
  }
}
