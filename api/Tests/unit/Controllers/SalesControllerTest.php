<?php
use App\Controllers\SalesController;
use App\Services\SalesService;
use PHPUnit\Framework\TestCase;

class SalesControllerTest extends TestCase
{
    private $salesServiceMock;
    private $salesController;

    protected function setUp(): void
    {
        $this->salesServiceMock = $this->createMock(SalesService::class);
        $this->salesController = new SalesController($this->salesServiceMock);
    }

    public function testGetCallsGetAllMethodInSalesService()
    {
        $this->salesServiceMock->expects($this->once())
            ->method('getAll');

        $this->salesController->get();
    }
}
