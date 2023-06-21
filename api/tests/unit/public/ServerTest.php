<?php

use PHPUnit\Framework\TestCase;

class ServerTest extends TestCase
{
    private $baseUri = 'http://localhost:8080';

    public function testServerIsRunning()
    {
        $response = $this->sendRequest('/products');
        $statusCode = $response['http_code'];

        $this->assertEquals(200, $statusCode);
    }

    public function testNonExistentRoute()
    {
        $response = $this->sendRequest('/non-existent-route');
        $statusCode = $response['http_code'];

        $this->assertEquals(404, $statusCode);
    }

    private function sendRequest($path)
    {
        $url = $this->baseUri . $path;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curl);
        $response = curl_getinfo($curl);
        curl_close($curl);

        return $response;
    }
}
