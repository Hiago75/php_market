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

    public function testPostWithMissingFieldsReturnsErrorMessage()
    {
        $data = [];

        $result = $this->salesController->post($data);

        $this->assertEquals('Missing required fields', $result);
    }

    public function testPostWithValidDataCallsSaveAndReturnsResult()
    {
        $data = [
            'product_id' => 1,
            'quantity' => 5,
            'sale_date' => '2023-06-16',
        ];

        $this->salesServiceMock->expects($this->once())
            ->method('save')
            ->with($data['product_id'], $data['quantity'], $data['sale_date'])
            ->willReturn('Success');

        $result = $this->salesController->post($data);

        $this->assertEquals('Success', $result);
    }
}
