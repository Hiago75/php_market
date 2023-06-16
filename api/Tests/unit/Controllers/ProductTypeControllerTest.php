<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\ProductTypeController;
use App\Services\ProductTypeService;

class ProductTypeControllerTest extends TestCase
{
    public function testGet()
    {
        $productTypeServiceMock = $this->createMock(ProductTypeService::class);
        $productTypeServiceMock->expects($this->once())
            ->method('getAllProductTypes')
            ->willReturn(['Type 1', 'Type 2', 'Type 3']);

        $productTypeController = new ProductTypeController($productTypeServiceMock);

        $output = json_encode($productTypeController->get());

        $expectedOutput = json_encode(['Type 1', 'Type 2', 'Type 3']);
        $this->assertEquals($expectedOutput, $output);
    }

    public function testShow()
    {
        $productTypeServiceMock = $this->createMock(ProductTypeService::class);
        $productTypeServiceMock->expects($this->once())
            ->method('getProductTypeById')
            ->with('123')
            ->willReturn(['id' => '123', 'name' => 'Type A']);

        $productTypeController = new ProductTypeController($productTypeServiceMock);

        $output = json_encode($productTypeController->show('123'));

        $expectedOutput = json_encode(['id' => '123', 'name' => 'Type A']);
        $this->assertEquals($expectedOutput, $output);
    }
}
