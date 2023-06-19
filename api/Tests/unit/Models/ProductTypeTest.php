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
            ->with('SELECT id, name FROM product_types')
            ->willReturn($expectedResult);

        $result = $this->productType->getAll();

        $this->assertEquals($expectedResult, $result);
    }

    public function testSave()
    {
        $pdoStatementMock = $this->createMock(PDOStatement::class);
        $pdoStatementMock->method('fetchColumn')->willReturn('123');
    
        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($pdoStatementMock);
        $pdoMock->method('lastInsertId')->willReturn('123');
    
        $this->dbMock->method('getPDO')->willReturn($pdoMock);
    
        $productType = new ProductType($this->dbMock);
    
        $result = $productType->save('123', 'Product 1');
    
        $this->assertEquals(['id' => '123'], $result);
    }
    
}
