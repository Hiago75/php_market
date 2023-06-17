<?php
use App\Controllers\ProductTypeController;
use App\Services\ProductTypeService;
use App\Providers\DataFormaterProvider;
use PHPUnit\Framework\TestCase;

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

        $result = $this->controller->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function testPostWithMissingNameFieldReturnsErrorMessage()
    {
        $data = [];

        $result = $this->controller->post($data);

        $this->assertEquals('Missing required fields', $result);
    }

    public function testPostWithValidDataCallsSaveAndReturnsSuccessMessage()
    {
        $data = ['name' => 'Type 1'];

        $this->serviceMock->expects($this->once())
            ->method('save')
            ->with($data['name'])
            ->willReturn('success');

        $result = $this->controller->post($data);

        $this->assertEquals('success', $result);
    }
}
