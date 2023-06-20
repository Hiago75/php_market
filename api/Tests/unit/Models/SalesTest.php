<?php
use App\Models\Sales;
use App\Providers\DatabaseConnectionProvider;
use PHPUnit\Framework\TestCase;

class SalesTest extends TestCase
{
    private $dbConnectionProviderMock;
    private $sales;

    protected function setUp(): void
    {
        $this->dbConnectionProviderMock = $this->createMock(DatabaseConnectionProvider::class);
        $this->sales = new Sales($this->dbConnectionProviderMock);
    }

    public function testGetAllCallsExecuteQueryMethodInDbConnectionProvider()
    {
        $query = 'SELECT * FROM sales';
        $expectedResult = ['result1', 'result2'];

        $this->dbConnectionProviderMock->expects($this->once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn($expectedResult);

        $result = $this->sales->getAll();

        $this->assertEquals($expectedResult, $result);
    }

    public function testSaveCallsExecuteQueryWithCorrectParameters()
    {
                
        $pdoStatementMock = $this->createMock(PDOStatement::class);
        $pdoStatementMock->method('fetchColumn')->willReturn('123');
    
        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($pdoStatementMock);
        $pdoMock->method('lastInsertId')->willReturn('123');
    
        $this->dbConnectionProviderMock->method('getPDO')->willReturn($pdoMock);

        $id = '123';
        $saleDate = date('Y-m-d');
        $subtotal = 80.5;
        $taxes = 5;
        $total = 90.5;

        $query = 'INSERT INTO sales (id, subtotal, taxes, total, sale_date) VALUES (?, ?, ?, ?, ?) RETURNING id';
        $params = [$id, $subtotal, $taxes, $total, $saleDate];

        $pdoMock->expects($this->once())
            ->method('prepare')
            ->with($query);

        $pdoStatementMock->expects($this->once())
            ->method('execute')
            ->with($params);

        $result = $this->sales->save($id, $subtotal, $taxes, $total, $saleDate);

        $this->assertEquals(['id' => '123'], $result);
    }
}
