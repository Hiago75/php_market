<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\ProductsController;
use App\Services\ProductsService;

class ProductsControllerTest extends TestCase
{
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
        $productsServiceMock = $this->createMock(ProductsService::class);
        $productsServiceMock->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedOutput);

        $productsController = new ProductsController($productsServiceMock);

        $output = json_encode($productsController->get());
        $encodedExpectedOutput = json_encode($expectedOutput);

        $this->assertEquals($encodedExpectedOutput, $output);
    }
}
