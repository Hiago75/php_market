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
            ->method('getAll')
            ->willReturn(['Type 1', 'Type 2', 'Type 3']);

        $productTypeController = new ProductTypeController($productTypeServiceMock);

        $output = json_encode($productTypeController->get());

        $expectedOutput = json_encode(['Type 1', 'Type 2', 'Type 3']);
        $this->assertEquals($expectedOutput, $output);
    }

    public function testPost()
    {
        $productTypeServiceMock = $this->createMock(ProductTypeService::class);
        $productTypeServiceMock->expects($this->once())
            ->method('createProductType')
            ->willReturn('Product type created');

        $productTypeController = new ProductTypeController($productTypeServiceMock);

        $data = [
            'name' => 'Test Product Type',
        ];

        $result = $productTypeController->post($data);

        $this->assertEquals('Product type created', $result);
    }
}
