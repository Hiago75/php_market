<?php
namespace App\Controllers;

use App\Services\ProductsService;
use App\Providers\DataFormaterProvider;
use App\Exceptions\BadRequest;

class ProductsController
{
    private $productsService;

    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    public function index()
    {
        return $this->productsService->getAll();
    }

    public function create($data)
    {
        $requiredKeys = ['name', 'type_id', 'price'];
        $dataIsPresent = DataFormaterProvider::verifyKeys($data, $requiredKeys);
        
        if (!$dataIsPresent) {
            throw new BadRequest('Missing required fields');
        }

        return $this->productsService->save($data['name'], $data["type_id"], $data['price']);
    }
}
