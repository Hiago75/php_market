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
}
