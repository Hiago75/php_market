<?php
namespace App\Controllers;

use App\Services\TaxesService;
use App\Providers\DataFormaterProvider;
use App\Exceptions\BadRequest;

class TaxesController
{
  private $taxesService;
  
  public function __construct($taxesService)
  {
    $this->taxesService = $taxesService;
  }

  public function index()
  {
    return $this->taxesService->getAll();
  }

  public function create($data)
  {
    $requiredKeys = ['type_id', 'percentage'];
    $dataIsPresent = DataFormaterProvider::verifyKeys($data, $requiredKeys);
    
    if (!$dataIsPresent) {
      throw new BadRequest('Campos obrigatórios ausentes.');
    }

    return $this->taxesService->save($data['type_id'], $data['percentage']);
  }
}
