<?php
namespace App\Controllers;

use App\Services\ProductTypeService;

class ProductTypeController
{
    private $productTypeService;

    public function __construct(ProductTypeService $productTypeService)
    {
        $this->productTypeService = $productTypeService;
    }

    public function get()
    {
        return $this->productTypeService->getAllProductTypes();
    }

    public function show($id)
    {
        return $this->productTypeService->getProductTypeById($id);;
    }
}