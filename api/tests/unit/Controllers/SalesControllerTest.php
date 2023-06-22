<?php
use PHPUnit\Framework\TestCase;

use App\Controllers\SalesController;
use App\Services\SalesService;
use App\Exceptions\BadRequest;

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

        $this->salesController->index();
    }

    public function testPostWithMissingFieldsReturnsErrorMessage()
    {
        $this->expectException(BadRequest::class);
        $this->expectExceptionMessage('Missing required fields');

        $data = [];

        $result = $this->salesController->create($data);
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

        $result = $this->salesController->create($data);

        $this->assertEquals('Success', $result);
    }
}
