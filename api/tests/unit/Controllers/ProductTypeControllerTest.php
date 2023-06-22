<?php
use PHPUnit\Framework\TestCase;

use App\Controllers\ProductTypeController;
use App\Services\ProductTypeService;
use App\Providers\DataFormaterProvider;
use App\Exceptions\BadRequest;

class ProductTypeControllerTest extends TestCase
{
    private $serviceMock;
    private $controller;

    protected function setUp(): void
    {
        $this->serviceMock = $this->createMock(ProductTypeService::class);
        $this->controller = new ProductTypeController($this->serviceMock);
    }

    public function testGetCallsGetAllAndReturnsResult()
    {
        $expectedResult = ['Type 1', 'Type 2', 'Type 3'];

        $this->serviceMock->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedResult);

        $result = $this->controller->index();

        $this->assertEquals($expectedResult, $result);
    }

    public function testPostWithMissingNameFieldReturnsErrorMessage()
    {
        $this->expectException(BadRequest::class);
        $this->expectExceptionMessage('Missing required fields');

        $data = [];

        $result = $this->controller->create($data);
    }

    public function testPostWithValidDataCallsSaveAndReturnsSuccessMessage()
    {
        $data = ['name' => 'Type 1'];

        $this->serviceMock->expects($this->once())
            ->method('save')
            ->with($data['name'])
            ->willReturn('success');

        $result = $this->controller->create($data);

        $this->assertEquals('success', $result);
    }
}
