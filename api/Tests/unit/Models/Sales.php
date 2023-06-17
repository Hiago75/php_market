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
        $id = '123';
        $productId = '456';
        $quantity = 5;
        $saleDate = '2023-06-16';

        $query = 'INSERT INTO sales (id, product_id, quantity, sale_date) VALUES (?, ?, ?, ?)';
        $params = [$id, $productId, $quantity, $saleDate];

        $this->dbMock->expects($this->once())
            ->method('executeQuery')
            ->with($query, $params);

        $result = $this->model->save($id, $productId, $quantity, $saleDate);

        $this->assertEquals('success', $result);
    }
}
