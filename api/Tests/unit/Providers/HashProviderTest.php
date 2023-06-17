<?php

use App\Providers\HashProvider;
use PHPUnit\Framework\TestCase;

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
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing data to generate the hash');

        $data = '';

        HashProvider::generateHash($data);
    }
}
