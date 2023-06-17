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
}
