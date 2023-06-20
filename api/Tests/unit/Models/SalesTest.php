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
        $query = '
            SELECT sales.*, sale_items.*, products.*
            FROM sales
            JOIN sale_items ON sales.id = sale_items.sale_id
            JOIN products ON sale_items.product_id = products.id
        ';
        $expectedResult = ['result1', 'result2'];
    
        $this->dbConnectionProviderMock->expects($this->once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn($expectedResult);
    
        $result = $this->sales->getAll();
    
        $this->assertEquals($expectedResult, $result);
    }    

    public function testSaveCallsExecuteQuery()
    {
        $pdoStatementMock = $this->createMock(PDOStatement::class);
        $pdoStatementMock->method('fetchColumn')->willReturn('123');
    
        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($pdoStatementMock);
    
        $this->dbConnectionProviderMock->method('getPDO')->willReturn($pdoMock);
    
        $products = [
            ['id' => '1', 'quantity' => 2],
            ['id' => '2', 'quantity' => 3],
        ];
        $saleId = '123';
        $subtotal = 80.5;
        $taxes = 5;
        $total = 90.5;
        $saleDate = date('Y-m-d');
    
        $query = 'INSERT INTO sales (id, subtotal, taxes, total, sale_date) VALUES (?, ?, ?, ?, ?) RETURNING id';
        $saleParams = [$saleId, $subtotal, $taxes, $total, $saleDate];
    
        $pdoMock->expects($this->atLeastOnce())
            ->method('prepare')
            ->willReturn($pdoStatementMock);
    
        $pdoStatementMock->expects($this->atLeastOnce())
            ->method('execute');
    
        $pdoStatementMock->method('fetchColumn')->willReturn($saleId);
    
        foreach ($products as $index => $product) {
            $id = 'generated_id_' . $index;
            $itemQuery = 'INSERT INTO sale_items (id, sale_id, product_id, quantity) VALUES (?, ?, ?, ?)';
            $itemParams = [$id, $saleId, $product['id'], $product['quantity']];
    
            $pdoMock->expects($this->atLeastOnce())
                ->method('prepare')
                // ->with($itemQuery)
                ->willReturn($pdoStatementMock);
    
            $pdoStatementMock->expects($this->atLeastOnce())
                ->method('execute');
                // ->with($itemParams);
        }
    
        $result = $this->sales->save($products, $saleId, $subtotal, $taxes, $total, $saleDate);
    
        $this->assertEquals(['id' => '123'], $result);
    }    
}
