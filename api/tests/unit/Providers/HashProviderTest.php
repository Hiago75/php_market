<?php
use PHPUnit\Framework\TestCase;

use App\Providers\HashProvider;
use App\Exceptions\BadRequest;

class HashProviderTest extends TestCase
{
    public function testGenerateHashReturnsValidHash()
    {
        $data = 'some_data';

        $hash = HashProvider::generateHash($data);

        $this->assertIsString($hash);
        $this->assertEquals(64, strlen($hash));
    }

    public function testGenerateHashThrowsExceptionWhenDataIsEmpty()
    {
        $this->expectException(BadRequest::class);
        $this->expectExceptionMessage('Campos obrigatórios ausentes');

        $data = '';

        HashProvider::generateHash($data);
    }
}
