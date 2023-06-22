<?php

use App\Models\ProductType;
use PHPUnit\Framework\TestCase;

class ProductTypeTest extends TestCase
{
    private $dbMock;
    private $productType;

    protected function setUp(): void
    {
        $this->dbMock = $this->createMock(\App\Providers\DatabaseConnectionProvider::class);
        $this->productType = new ProductType($this->dbMock);
    }

    protected function tearDown(): void
    {
        $this->dbMock = null;
        $this->productType = null;
    }

    public function testgetAll()
    {
        $expectedResult = [
            ['id' => 1, 'name' => 'Type 1'],
            ['id' => 2, 'name' => 'Type 2'],
            ['id' => 3, 'name' => 'Type 3']
        ];

        $this->dbMock->expects($this->once())
            ->method('executeQuery')
            ->with('SELECT product_types.id, product_types.name, taxes.percentage AS tax_percentage
                      FROM product_types
                      JOIN taxes ON product_types.id = taxes.type_id')
            ->willReturn($expectedResult);

        $result = $this->productType->getAll();

        $this->assertEquals($expectedResult, $result);
    }

    public function testSave()
    {
        $id = '1234';
        $name = 'Product Type 1';

        $pdoStatementMock = $this->createMock(PDOStatement::class);
        $pdoStatementMock->method('fetchColumn')->willReturn($id);
    
        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($pdoStatementMock);
        $pdoMock->method('lastInsertId')->willReturn($id);
  
        $query = 'INSERT INTO product_types (id, name) VALUES (?, ?) RETURNING id, name';
        $params = [$id, $name];

        $pdoMock->expects($this->once())
            ->method('prepare')
            ->with($query);

        $pdoStatementMock->expects($this->once())
            ->method('execute')
            ->with($params);

        $this->dbMock->method('getPDO')->willReturn($pdoMock);
    
        $result = $this->productType->save($id, $name);
    
        $this->assertEquals(['id' => $id], $result);
    }
    
}
