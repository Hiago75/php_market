<?php
namespace App\Controllers;

use App\Services\ProductTypeService;
use App\Providers\DataFormaterProvider;
use App\Exceptions\BadRequest;

class ProductTypeController
{
    private $productTypeService;

    public function __construct(ProductTypeService $productTypeService)
    {
        $this->productTypeService = $productTypeService;
    }

    public function index()
    {
        return $this->productTypeService->getAll();
    }

    public function create($data) {
        $requiredKeys = ['name'];
        $dataIsPresent = DataFormaterProvider::verifyKeys($data, $requiredKeys);
        
        if (!$dataIsPresent) {
            throw new BadRequest('Campos obrigatórios ausentes.');
        }

        return $this->productTypeService->save($data["name"]);
    }
}