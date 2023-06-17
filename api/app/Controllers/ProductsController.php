<?php
namespace App\Controllers;

use App\Services\ProductsService;
use App\Providers\DataFormaterProvider;

class ProductsController
{
    private $productsService;

    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    public function get()
    {
        return $this->productsService->getAll();
    }

    public function post($data)
    {
        $requiredKeys = ['name', 'type_id', 'price'];
        $dataIsPresent = DataFormaterProvider::verifyKeys($data, $requiredKeys);
        
        if (!$dataIsPresent) {
          return 'Missing required fields';
        }

        return $this->productsService->save($data['name'], $data["type_id"], $data['price']);
    }
}
