<?php

use App\Services\TaxesService;
use App\Models\Taxes;
use App\Providers\HashProvider;
use PHPUnit\Framework\TestCase;

class TaxesServiceTest extends TestCase
{
    private $modelMock;
    private $service;

    protected function setUp(): void
    {
        $this->modelMock = $this->createMock(Taxes::class);
        $this->service = new TaxesService($this->modelMock);
    }

    public function testGetAllCallsModelGetAllAndReturnsResult()
    {
        $expectedResult = ['Type 1', 'Type 2', 'Type 3'];

        $this->modelMock->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedResult);

        $result = $this->service->getAll();

        $this->assertEquals($expectedResult, $result);
    }

    public function testSaveCallsModelSaveAndReturnsResult()
    {
        $typeId = '1';
        $percentage = '10';
        
        $this->modelMock->expects($this->once())
            ->method('save')
            ->willReturn('Success');

        $result = $this->service->save($typeId, $percentage);

        $this->assertEquals('Success', $result);
    }
}

