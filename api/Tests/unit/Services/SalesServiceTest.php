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
}
