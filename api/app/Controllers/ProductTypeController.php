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
        return $this->productTypeService->getAll();
    }

    public function post($data) {
        if (!array_key_exists("name", $data)) {
            return "Missing 'name' field";
        }

        return $this->productTypeService->createProductType($data["name"]);
    }
}