<?php

use PHPUnit\Framework\TestCase;

class ServerTest extends TestCase
{
    private static $serverUrl = 'http://localhost:8080';

    public function testServerIsRunning()
    {
        $expectedResponse = json_encode(['data' => 'Server running']);
        $response = $this->sendRequest();

        $this->assertEquals(
            $expectedResponse,
            $response,
            'The server response does not match the expected value.'
        );
    }

    private function sendRequest()
    {
        $options = [
            'http' => [
                'method' => 'GET',
                'header' => 'Content-Type: application/json',
            ],
        ];

        $context = stream_context_create($options);
        return file_get_contents(self::$serverUrl, false, $context);
    }
}
