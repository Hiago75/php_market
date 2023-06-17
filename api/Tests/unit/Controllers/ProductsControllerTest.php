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

    public function testGet()
    {
        $expectedOutput = [
            [
                'id' => '1',
                'name' => 'Smartphone',
                'type_id' => '1',
                'price' => '1200.00'
            ],
            [
                'id' => '2',
                'name' => 'Smartphone 2',
                'type_id' => '1',
                'price' => '1500.00'
            ]
        ];
        
        $this->productsServiceMock->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedOutput);

        $output = json_encode($this->productsController->get());
        $encodedExpectedOutput = json_encode($expectedOutput);

        $this->assertEquals($encodedExpectedOutput, $output);
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
