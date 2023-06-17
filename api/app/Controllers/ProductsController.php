<?php
namespace App\Controllers;

use App\Services\ProductsService;

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
}
