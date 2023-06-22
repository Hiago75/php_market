<?php
use PHPUnit\Framework\TestCase;

use App\Controllers\TaxesController;
use App\Services\TaxesService;
use App\Providers\DataFormaterProvider;
use App\Exceptions\BadRequest;


class TaxesControllerTest extends TestCase
{
    private $taxesServiceMock;
    private $taxesController;

    protected function setUp(): void
    {
        $this->taxesServiceMock = $this->createMock(TaxesService::class);
        $this->taxesController = new TaxesController($this->taxesServiceMock);
    }

    public function testGetReturnsAllTaxes()
    {
        $expectedResult = ['Type 1', 'Type 2', 'Type 3'];

        $this->taxesServiceMock->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedResult);

        $result = $this->taxesController->index();

        $this->assertEquals($expectedResult, $result);
    }

    public function testPostMissingRequiredFieldsReturnsErrorMessage()
    {
        $this->expectException(BadRequest::class);
        $this->expectExceptionMessage('Missing required fields');

        $data = [
            "type_id" => "1",
        ];

        $result = $this->taxesController->create($data);
    }

    public function testPostSavesTaxAndReturnsSuccessMessage()
    {
        $data = [
            "type_id" => "1",
            "percentage" => "10"
        ];

        $this->taxesServiceMock->expects($this->once())
            ->method('save')
            ->with(1, 10)
            ->willReturn('Success');

        $result = $this->taxesController->create($data);

        $this->assertEquals('Success', $result);
    }
}
