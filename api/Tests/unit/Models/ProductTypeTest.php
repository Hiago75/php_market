<?php

use App\Models\ProductType;
use PHPUnit\Framework\TestCase;

class ProductTypeTest extends TestCase
{
    private $dbMock;
    private $productType;

    protected function setUp(): void
    {
        $this->dbMock = $this->createMock(\App\Database\DatabaseConnection::class);
        $this->productType = new ProductType($this->dbMock);
    }

    protected function tearDown(): void
    {
        $this->dbMock = null;
        $this->productType = null;
    }

    public function testGetAllProductTypes()
    {
        $expectedResult = [
            ['id' => 1, 'name' => 'Type 1'],
            ['id' => 2, 'name' => 'Type 2'],
            ['id' => 3, 'name' => 'Type 3']
        ];

        $this->dbMock->expects($this->once())
            ->method('executeQuery')
            ->with('SELECT id, name FROM product_types')
            ->willReturn($expectedResult);

        $result = $this->productType->getAllProductTypes();

        $this->assertEquals($expectedResult, $result);
    }
}
