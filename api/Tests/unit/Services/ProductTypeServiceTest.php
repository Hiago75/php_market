<?php

use App\Services\ProductTypeService;
use PHPUnit\Framework\TestCase;

class ProductTypeServiceTest extends TestCase
{
    private $productTypeModelMock;
    private $productTypeService;

    protected function setUp(): void
    {
        $this->productTypeModelMock = $this->createMock(\App\Models\ProductType::class);
        $this->productTypeService = new ProductTypeService($this->productTypeModelMock);
    }

    protected function tearDown(): void
    {
        $this->productTypeModelMock = null;
        $this->productTypeService = null;
    }

    public function testGetAllProductTypes()
    {
        $expectedResult = ['Type 1', 'Type 2', 'Type 3'];
        $this->productTypeModelMock->expects($this->once())
            ->method('getAllProductTypes')
            ->willReturn($expectedResult);

        $result = $this->productTypeService->getAllProductTypes();

        $this->assertEquals($expectedResult, $result);
    }
}

