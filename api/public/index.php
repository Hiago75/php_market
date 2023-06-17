<?php

namespace App;

require_once '../vendor/autoload.php';

use App\Providers\DatabaseConnectionProvider;

$requestUrl = $_SERVER['REQUEST_URI'];

$baseUrl = str_replace('/public', '', $_SERVER['SCRIPT_NAME']);
$requestUrl = str_replace($baseUrl, '', $requestUrl);
$urlParts = array_filter(explode('/', $requestUrl));
$urlParts = array_values($urlParts);

if (empty($urlParts)) {
    http_response_code(200);
  
    echo json_encode(['data' => 'Server running']);
    die();
}

$itemName = $urlParts[0];
$capitalizedParameter = ucwords(str_replace('-', ' ', $itemName));
$formatedParameter = str_replace(' ', '', $capitalizedParameter);

$controllerName = $formatedParameter . 'Controller';
$serviceName = $formatedParameter . 'Service';

$controllerClass = 'App\\Controllers\\' . $controllerName;
$serviceClass = 'App\\Services\\' . $serviceName;
$modelClass = 'App\\Models\\' . $formatedParameter;

if (!class_exists($controllerClass) || !class_exists($serviceClass)) {
    header('HTTP/1.1 404 Not Found');

    echo json_encode(['data' => 'Invalid route']);
    die();
}

$database = new DatabaseConnectionProvider(DB_NAME);
$model = new $modelClass($database);
$service = new $serviceClass($model);
$controller = new $controllerClass($service);

$httpMethod = $_SERVER['REQUEST_METHOD'];
$methodName = strtolower($httpMethod);
$entityBody = json_decode(file_get_contents('php://input'), true);

if (method_exists($controller, $methodName)) {
    $response = $controller->$methodName($entityBody);
    http_response_code(200);

    echo json_encode(['data' => $response], JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(405);
    
    echo 'Invalid HTTP method';
}
