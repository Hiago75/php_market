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
            'products' => [["id" => "1001"]],
            'subTotal' => 80.5,
            'taxes' => 5,
            'total' => 90.5,
        ];
   
        $this->salesServiceMock->expects($this->once())
            ->method('save')
            ->with($data["products"], $data['subTotal'], $data['taxes'], $data['total'])
            ->willReturn('Success');

        $result = $this->salesController->post($data);

        $this->assertEquals('Success', $result);
    }
}
