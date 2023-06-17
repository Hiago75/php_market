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

    public function testgetAll()
    {
        $expectedResult = ['Type 1', 'Type 2', 'Type 3'];
        $this->productTypeModelMock->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedResult);

        $result = $this->productTypeService->getAll();

        $this->assertEquals($expectedResult, $result);
    }

    public function testsave()
    {
        // TODO: create a hash provider that receives the data to encrypt
        $expectedResult = 'Success';
        $name = 'Test Product Type';
        
        $this->productTypeModelMock->expects($this->once())
            ->method('save')
            ->willReturn($expectedResult);

        $productTypeService = new ProductTypeService($this->productTypeModelMock);

        $result = $productTypeService->save($name);

        $this->assertEquals($expectedResult, $result);
    }
}

