<?php

use App\Providers\DataFormaterProvider;
use PHPUnit\Framework\TestCase;

class DataFormaterProviderTest extends TestCase
{
    public function testVerifyKeysReturnsTrueWhenAllRequiredKeysExist()
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3'
        ];
        $requiredKeys = ['key1', 'key2', 'key3'];

        $result = DataFormaterProvider::verifyKeys($data, $requiredKeys);

        $this->assertTrue($result);
    }

    public function testVerifyKeysReturnsFalseWhenAtLeastOneRequiredKeyIsMissing()
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2'
        ];
        $requiredKeys = ['key1', 'key2', 'key3'];

        $result = DataFormaterProvider::verifyKeys($data, $requiredKeys);

        $this->assertFalse($result);
    }

    public function testVerifyKeysReturnsFalseWhenDataIsEmpty()
    {
        $data = [];
        $requiredKeys = ['key1', 'key2', 'key3'];

        $result = DataFormaterProvider::verifyKeys($data, $requiredKeys);

        $this->assertFalse($result);
    }
}
