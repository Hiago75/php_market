<?php

use App\Models\Taxes;
use PHPUnit\Framework\TestCase;

class TaxesTest extends TestCase
{
    private $dbMock;
    private $taxesType;

    protected function setUp(): void
    {
        $this->dbMock = $this->createMock(\App\Database\DatabaseConnection::class);
        $this->taxesType = new Taxes($this->dbMock);
    }

    protected function tearDown(): void
    {
        $this->dbMock = null;
        $this->taxesType = null;
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

        $result = $this->taxesType->getAll();

        $this->assertEquals($expectedResult, $result);
    }
}
