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

        $this->dbMock->expects($this->once())
            ->method('executeQuery')
            ->with('SELECT * FROM products')
            ->willReturn($expectedResult);

        $result = $this->products->getAll();

        $this->assertEquals($expectedResult, $result);
    }
}
