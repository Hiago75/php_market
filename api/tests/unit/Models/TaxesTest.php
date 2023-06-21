<?php

use App\Models\Taxes;
use PHPUnit\Framework\TestCase;

class TaxesTest extends TestCase
{
    private $dbMock;
    private $taxes;

    protected function setUp(): void
    {
        $this->dbMock = $this->createMock(\App\Providers\DatabaseConnectionProvider::class);
        $this->taxes = new Taxes($this->dbMock);
    }

    protected function tearDown(): void
    {
        $this->dbMock = null;
        $this->taxes = null;
    }

    public function testgetAll()
    {
        $expectedResult = [
            ['id' => 1, 'type_id' => 'Type 1', 'percentage' => 5],
            ['id' => 2, 'type_id' => 'Type 2', 'percentage' => 14],
            ['id' => 3, 'type_id' => 'Type 3', 'percentage' => 15]
        ];

        $this->dbMock->expects($this->once())
            ->method('executeQuery')
            ->with('SELECT * FROM taxes')
            ->willReturn($expectedResult);

        $result = $this->taxes->getAll();

        $this->assertEquals($expectedResult, $result);
    }

    public function testGetReturnsErrorIfProductIsNotFound()
    {
        $this->dbMock->expects($this->once())
        ->method('executeQuery')
        ->willReturn([]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Taxes not found');
        $this->taxes->getById('123');
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
            ->with('SELECT * FROM taxes')
            ->willReturn($expectedResult);
        
        $result = $this->taxes->getAll();
        
        $this->assertEquals($expectedResult, $result);
    }

    public function testSave()
    {
        $id = 'abcdef123456';
        $typeId = '1';
        $percentage = '1';

        $query = 'INSERT INTO taxes (id, type_id, percentage) VALUES (?, ?, ?)';
        $params = [$id, $typeId, $percentage];

        $this->dbMock->expects($this->once())
            ->method('executeQuery')
            ->with($query, $params);

        $result = $this->taxes->save($id, $typeId, $percentage);

        $this->assertEquals('success', $result);
    }
}
