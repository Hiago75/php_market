<?php

use PHPUnit\Framework\TestCase;

class ServerTest extends TestCase
{
    private static $serverUrl = 'http://localhost:8080';

    private function sendRequest(string $route = ''): string
    {
        $url = self::$serverUrl . '/' . $route;
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response !== false ? $response : '';
    }

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

    public function testInvalidRoute()
    {
        $expectedResponse = json_encode(['data' => 'Invalid route']);
        $response = $this->sendRequest('invalid-route');

        $this->assertEquals(
            $expectedResponse,
            $response,
            'The server response does not match the expected value.'
        );
    }
}
