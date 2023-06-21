<?php
use App\Models\Sales;
use App\Services\SalesService;
use App\Providers\HashProvider;
use PHPUnit\Framework\TestCase;

class SalesServiceTest extends TestCase
{
    private $salesModelMock;
    private $salesService;

    protected function setUp(): void
    {
        $this->salesModelMock = $this->createMock(Sales::class);
        $this->salesService = new SalesService($this->salesModelMock);
    }

    public function testGetAllCallsGetAllMethodInSalesModel()
    {
        $this->salesModelMock->expects($this->once())
            ->method('getAll');

        $this->salesService->getAll();
    }
    
    public function testSaveCallsModelSaveWithCorrectParameters()
    {
        $products = [["id" => "1001"]];
        $saleDate = date('Y-m-d');
        $subtotal = 80.5;
        $taxes = 5;
        $total = 90.5;
        $id = HashProvider::generateHash(date('Y-m-d H:i:s').$subtotal);

        $this->salesModelMock->expects($this->once())
            ->method('save')
            ->with($products, $id, $subtotal, $taxes, $total, $saleDate)
            ->willReturn('Success');

        $result = $this->salesService->save($products, $subtotal, $taxes, $total);

        $this->assertEquals('Success', $result);
    }
}
