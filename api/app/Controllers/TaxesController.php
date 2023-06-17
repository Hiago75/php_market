<?php
namespace App\Controllers;

use App\Services\TaxesService;

class TaxesController
{
  private $taxesService;
  
  public function __construct($taxesService)
  {
    $this->taxesService = $taxesService;
  }

  public function get()
  {
    return $this->taxesService->getAll();
  }
}
