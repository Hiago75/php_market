<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\ProductsController;
use App\Services\ProductsService;

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
        $data = [];

        $expected = 'Missing required fields';
        $actual = $this->productsController->post($data);

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

        $this->productsController->post($data);
    }
}
