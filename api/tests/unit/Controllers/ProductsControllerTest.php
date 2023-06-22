<?php
use PHPUnit\Framework\TestCase;

use App\Controllers\ProductsController;
use App\Services\ProductsService;
use App\Exceptions\BadRequest;


class ProductsControllerTest extends TestCase
{
    private $productsServiceMock;
    private $productsController;

    protected function setUp(): void
    {
        $this->productsServiceMock = $this->createMock(ProductsService::class);
        $this->productsController = new ProductsController($this->productsServiceMock);
    }

    public function testGetAllReturnsAllProducts()
    {
        $expectedResult = ['Product 1', 'Product 2', 'Product 3'];

        $this->productsServiceMock->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedResult);

        $result = $this->productsController->index();

        $this->assertEquals($expectedResult, $result);
    }

    public function testPostReturnsMissingFieldsWhenDataIsNotPresent()
    {
        $this->expectException(BadRequest::class);
        $this->expectExceptionMessage('Missing required fields');

        $data = [];
        $actual = $this->productsController->create($data);

        $this->assertEquals($expected, $actual);
    }

    public function testPostCallsSaveMethodWithCorrectData()
    {
        $data = [
            'name' => 'Test',
            'type_id' => 1,
            'price' => 10.99,
        ];

        $this->productsServiceMock->expects($this->once())
            ->method('save')
            ->with($data['name'], $data['type_id'], $data['price']);

        $this->productsController->create($data);
    }
}
