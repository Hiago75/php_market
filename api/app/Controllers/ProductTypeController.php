<?php
namespace App\Controllers;

use App\Services\ProductTypeService;
use App\Providers\DataFormaterProvider;

class ProductTypeController
{
    private $productTypeService;

    public function __construct(ProductTypeService $productTypeService)
    {
        $this->productTypeService = $productTypeService;
    }

    public function get()
    {
        return $this->productTypeService->getAll();
    }

    public function post($data) {
        $requiredKeys = ['name'];
        $dataIsPresent = DataFormaterProvider::verifyKeys($data, $requiredKeys);
        
        if (!$dataIsPresent) {
          return 'Missing required fields';
        }

        return $this->productTypeService->save($data["name"]);
    }
}