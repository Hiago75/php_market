<?php

require_once '../vendor/autoload.php';

use App\Routing\Router;
use App\Exceptions\ExceptionHandler;
use App\Providers\DependencyProvider;
use App\Providers\DatabaseConnectionProvider;

date_default_timezone_set('America/Sao_Paulo');

$exceptionHandler = new ExceptionHandler();
set_exception_handler([$exceptionHandler, 'handleException']);
set_error_handler([$exceptionHandler, 'handleError']);

$container = new DependencyProvider();
$container->register(DatabaseConnectionProvider::class, function ($container) {
    return new DatabaseConnectionProvider(DB_NAME);
});
$registrations = $container->registerByConvention();
foreach ($registrations as $registration) {
    $class = $registration['class'];
    $factory = $registration['factory'];
    $container->register($class, $factory);
}

$router = new Router($container);

$router->addRoute('GET', '/products', 'App\Controllers\ProductsController@index');
$router->addRoute('POST', '/products', 'App\Controllers\ProductsController@create');

$router->addRoute('GET', '/product-type', 'App\Controllers\ProductTypeController@index');
$router->addRoute('POST', '/product-type', 'App\Controllers\ProductTypeController@create');

$router->addRoute('GET', '/taxes', 'App\Controllers\TaxesController@index');
$router->addRoute('POST', '/taxes', 'App\Controllers\TaxesController@create');

$router->addRoute('GET', '/sales', 'App\Controllers\SalesController@index');
$router->addRoute('POST', '/sales', 'App\Controllers\SalesController@create');

try {
    $response = $router->dispatch();

    http_response_code(200);
    echo json_encode(['data' => $response], JSON_UNESCAPED_UNICODE);
} catch (\Exception $e) {
    $statusCode = $e->getCode();
    $errorMessage = $e->getMessage();

    http_response_code($statusCode);
    echo json_encode(['error' => $errorMessage]);
}
