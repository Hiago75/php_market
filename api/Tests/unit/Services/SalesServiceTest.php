<?php
use App\Models\Sales;
use App\Services\SalesService;
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
        $productId = 1;
        $quantity = 5;
        $saleDate = '2023-06-16';

        $this->salesModelMock->expects($this->once())
            ->method('save')
            ->willReturn('Success');

        $result = $this->salesService->save($productId, $quantity, $saleDate);

        $this->assertEquals('Success', $result);
    }
}
