<?php

namespace App;

require_once '../vendor/autoload.php';

$requestUrl = $_SERVER['REQUEST_URI'];

$baseUrl = str_replace('/public', '', $_SERVER['SCRIPT_NAME']);
$requestUrl = str_replace($baseUrl, '', $requestUrl);
$urlParts = explode('/', $requestUrl);

$controllerName = ucfirst($urlParts[0]) . 'Controller';

if (class_exists('App\\Controllers\\' . $controllerName)) {
    $controllerClass = 'App\\Controllers\\' . $controllerName;
    $controller = new $controllerClass();

    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $methodName = strtolower($httpMethod);

    if (method_exists($controller, $methodName)) {
        $controller->$methodName();
    } else {
        http_response_code(405);
        echo 'Invalid HTTP method';
    }
} else {
  http_response_code(200);
  header('Content-Type: text/plain');

  echo json_encode(['data' => 'Server running']);
}
