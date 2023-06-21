<?php

use App\Services\TaxesService;
use App\Models\Taxes;
use App\Providers\HashProvider;
use PHPUnit\Framework\TestCase;

class TaxesServiceTest extends TestCase
{
    private $taxesModelMock;
    private $taxesServiceMock;

    protected function setUp(): void
    {
        $this->taxesModelMock = $this->createMock(Taxes::class);
        $this->taxesServiceMock = new TaxesService($this->taxesModelMock);
    }

    public function testGetAllCallsModelGetAllAndReturnsResult()
    {
        $expectedResult = ['Type 1', 'Type 2', 'Type 3'];

        $this->taxesModelMock->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedResult);

        $result = $this->taxesServiceMock->getAll();

        $this->assertEquals($expectedResult, $result);
    }

    public function testGetById()
    {
        $expectedResult = [
            [
                'id' => '1',
                'type_id' => '1',
                'percentage' => '12'
            ],
        ];

        $this->taxesModelMock->expects($this->once())
            ->method('getById')
            ->willReturn($expectedResult);
        
        $result = $this->taxesServiceMock->getById('1');

        $this->assertEquals($expectedResult, $result);
    }

    public function testSaveCallsModelSaveAndReturnsResult()
    {
        $typeId = '1';
        $percentage = '10';
        
        $this->taxesModelMock->expects($this->once())
            ->method('save')
            ->willReturn('Success');

        $result = $this->taxesServiceMock->save($typeId, $percentage);

        $this->assertEquals('Success', $result);
    }
}

