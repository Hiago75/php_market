<?php

use App\Services\TaxesService;
use PHPUnit\Framework\TestCase;

class TaxesServiceTest extends TestCase
{
    private $taxesModelMock;
    private $taxesService;

    protected function setUp(): void
    {
        $this->taxesModelMock = $this->createMock(\App\Models\Taxes::class);
        $this->taxesService = new TaxesService($this->taxesModelMock);
    }

    protected function tearDown(): void
    {
        $this->taxesModelMock = null;
        $this->taxesService = null;
    }

    public function testgetAll()
    {
        $expectedResult = ['Type 1', 'Type 2', 'Type 3'];
        $this->taxesModelMock->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedResult);

        $result = $this->taxesService->getAll();

        $this->assertEquals($expectedResult, $result);
    }

    public function testsave()
    {
        $expectedResult = 'Success';
        $typeId = 'acvbde3109380291';
        $percentage = '0';
        
        $this->taxesModelMock->expects($this->once())
            ->method('save')
            ->willReturn($expectedResult);

        $result = $this->taxesService->save($typeId, $percentage);

        $this->assertEquals($expectedResult, $result);
    }
}

