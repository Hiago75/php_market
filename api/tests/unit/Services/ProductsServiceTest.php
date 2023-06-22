<?php

use App\Services\ProductsService;
use PHPUnit\Framework\TestCase;

class ProductsServiceTest extends TestCase
{
    private $productsModelMock;
    private $productsService;

    protected function setUp(): void
    {
        $this->productsModelMock = $this->createMock(\App\Models\Products::class);
        $this->productsService = new ProductsService($this->productsModelMock);
    }

    protected function tearDown(): void
    {
        $this->productsModelMock = null;
        $this->productsService = null;
    }

    public function testgetAll()
    {
        $expectedResult = [
            [
                'id' => '1',
                'name' => 'Smartphone',
                'type_id' => '1',
                'price' => '1200.00'
            ],
            [
                'id' => '2',
                'name' => 'Smartphone 2',
                'type_id' => '1',
                'price' => '1500.00'
            ]
        ];
        $this->productsModelMock->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedResult);

        $result = $this->productsService->getAll();

        $this->assertEquals($expectedResult, $result);
    }

    public function testsave()
    {
        $expectedResult = 'Success';
        $name = 'Teste product';
        $typeId = '1';
        $price = "20.00";
   
        $this->productsModelMock->expects($this->once())
            ->method('save')
            ->willReturn($expectedResult);

        $productsService = new ProductsService($this->productsModelMock);

        $result = $productsService->save($name, $typeId,$price);

        $this->assertEquals($expectedResult, $result);
    }
}

