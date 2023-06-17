<?php
use App\Controllers\TaxesController;
use App\Services\TaxesService;
use App\Providers\DataFormaterProvider;
use PHPUnit\Framework\TestCase;

class TaxesControllerTest extends TestCase
{
    private $serviceMock;
    private $controller;

    protected function setUp(): void
    {
        $this->serviceMock = $this->createMock(TaxesService::class);
        $this->controller = new TaxesController($this->serviceMock);
    }

    public function testGetReturnsAllTaxes()
    {
        $expectedResult = ['Type 1', 'Type 2', 'Type 3'];

        $this->serviceMock->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedResult);

        $result = $this->controller->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function testPostMissingRequiredFieldsReturnsErrorMessage()
    {
        $data = [
            "type_id" => "1",
        ];

        $result = $this->controller->post($data);

        $this->assertEquals('Missing required fields', $result);
    }

    public function testPostSavesTaxAndReturnsSuccessMessage()
    {
        $data = [
            "type_id" => "1",
            "percentage" => "10"
        ];

        $this->serviceMock->expects($this->once())
            ->method('save')
            ->with(1, 10)
            ->willReturn('Success');

        $result = $this->controller->post($data);

        $this->assertEquals('Success', $result);
    }
}
