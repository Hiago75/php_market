<?php

use App\Services\ProductTypeService;
use App\Models\ProductType;
use PHPUnit\Framework\TestCase;

class ProductTypeServiceTest extends TestCase
{
    private $modelMock;
    private $service;

    protected function setUp(): void
    {
        $this->modelMock = $this->createMock(ProductType::class);
        $this->service = new ProductTypeService($this->modelMock);
    }

    public function testGetAllCallsModelGetAllAndReturnsResult()
    {
        $expectedResult = ['Type 1', 'Type 2', 'Type 3'];

        $this->modelMock->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedResult);

        $result = $this->service->getAll();

        $this->assertEquals($expectedResult, $result);
    }

    public function testSaveCallsModelSaveAndReturnsResult()
    {
        $name = 'Type 1';

        $this->modelMock->expects($this->once())
            ->method('save')
            ->willReturn('Success');

        $result = $this->service->save($name);

        $this->assertEquals('Success', $result);
    }
}

