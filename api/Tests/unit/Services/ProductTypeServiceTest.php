<?php
use PHPUnit\Framework\TestCase;
use App\Services\ProductTypeService;

class ProductTypeServiceTest extends TestCase
{
    public function testGetAllProductTypes()
    {
        $productTypeService = new ProductTypeService();
        $result = $productTypeService->getAllProductTypes();

        $this->assertEquals('It worked', $result);
    }

    public function testGetProductTypeById()
    {
        $productTypeService = new ProductTypeService();
        $result = $productTypeService->getProductTypeById(123);

        $this->assertEquals('It worked + 123', $result);
    }
}