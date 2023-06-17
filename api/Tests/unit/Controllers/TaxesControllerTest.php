<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\TaxesController;
use App\Services\TaxesService;

class TaxesControllerTest extends TestCase
{
    public function testGet()
    {
        $taxesServiceMock = $this->createMock(TaxesService::class);
        $taxesServiceMock->expects($this->once())
            ->method('getAll')
            ->willReturn(['Type 1', 'Type 2', 'Type 3']);

        $taxesController = new TaxesController($taxesServiceMock);

        $output = json_encode($taxesController->get());

        $expectedOutput = json_encode(['Type 1', 'Type 2', 'Type 3']);
        $this->assertEquals($expectedOutput, $output);
    }
}
