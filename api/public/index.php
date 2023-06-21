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

try {
    $response = $router->dispatch();

    http_response_code(200);
    echo json_encode(['data' => $response], JSON_UNESCAPED_UNICODE);
} catch (\Exception $e) {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
}
