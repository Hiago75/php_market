<?php

use App\Models\Products;
use PHPUnit\Framework\TestCase;

class ProductsTest extends TestCase
{
    private $dbMock;
    private $products;

    protected function setUp(): void
    {
        $this->dbMock = $this->createMock(\App\Providers\DatabaseConnectionProvider::class);
        $this->products = new Products($this->dbMock);
    }

    protected function tearDown(): void
    {
        $this->dbMock = null;
        $this->products = null;
    }

    public function testGetAll()
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

        $this->dbMock->expects($this->once())
            ->method('executeQuery')
            ->with('SELECT * FROM products')
            ->willReturn($expectedResult);

        $result = $this->products->getAll();

        $this->assertEquals($expectedResult, $result);
    }

    public function testGetReturnsErrorIfProductIsNotFound()
    {
        $this->dbMock->expects($this->once())
        ->method('executeQuery')
        ->willReturn([]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Product not found');
        $this->products->getById('123');
    }

    public function testGetById()
    {
        $expectedResult = [
            [
                'id' => '1',
                'name' => 'Smartphone',
                'type_id' => '1',
                'price' => '1200.00'
            ],
        ];

        $this->dbMock->expects($this->once())
            ->method('executeQuery')
            ->with('SELECT * FROM products')
            ->willReturn($expectedResult);
        
        $result = $this->products->getAll();
        
        $this->assertEquals($expectedResult, $result);
    }

    public function testSaveCallsExecuteQueryWithCorrectParameters()
    {
        $id = 'abc123';
        $name = 'Product Name';
        $typeId = '1';
        $price = 10.99;

        $expectedQuery = 'INSERT INTO products (id, name, type_id, price) VALUES (?, ?, ?, ?)';
        $expectedParams = [$id, $name, $typeId, $price];

        $this->dbMock->expects($this->once())
            ->method('executeQuery')
            ->with($expectedQuery, $expectedParams);

        $this->products->save($id, $name, $typeId, $price);
    }

    public function testSaveReturnsSuccessMessage()
    {
        $expectedOutput = 'success';
        $id = 'abc123';
        $name = 'Product Name';
        $typeId = '1';
        $price = 10.99;

        $this->dbMock->method('executeQuery');

        $result = $this->products->save($id, $name, $typeId, $price);

        $this->assertEquals($expectedOutput, $result);
    }
}
