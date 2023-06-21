<?php
use App\Controllers\TaxesController;
use App\Services\TaxesService;
use App\Providers\DataFormaterProvider;
use PHPUnit\Framework\TestCase;

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

        $result = $this->taxesController->get();

        $this->assertEquals($expectedResult, $result);
    }

    public function testGetByIdReturnsProductById()
    {
        $taxId = 1;
        $expectedResult = ['id' => $taxId, 'type_id' => '2', 'percentage' => '12'];

        $this->taxesServiceMock->expects($this->once())
            ->method('getById')
            ->with($taxId)
            ->willReturn($expectedResult);

        $result = $this->taxesController->get($taxId);

        $this->assertEquals($expectedResult, $result);
    }


    public function testPostMissingRequiredFieldsReturnsErrorMessage()
    {
        $data = [
            "type_id" => "1",
        ];

        $result = $this->taxesController->post($data);

        $this->assertEquals('Missing required fields', $result);
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

        $result = $this->taxesController->post($data);

        $this->assertEquals('Success', $result);
    }
}
