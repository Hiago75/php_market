<?php

namespace App\Routing;

use App\Exceptions\NotFoundException;

class Router
{
    private $routes = [];
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function addRoute($method, $path, $callback)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $this->normalizePath($path),
            'callback' => $callback
        ];
    }

    private function normalizePath($path)
    {
        return '#^' . rtrim($path, '/') . '/?$#';
    }

    private function extractParamsFromMatches($callback, $matches)
    {
        $callbackParts = explode('@', $callback);
        $className = $callbackParts[0];
        $methodName = $callbackParts[1];

        $reflectionMethod = new \ReflectionMethod($className, $methodName);
        $reflectionParameters = $reflectionMethod->getParameters();

        $params = [];
        foreach ($reflectionParameters as $parameter) {
            $name = $parameter->getName();
            if (isset($matches[$name])) {
                $params[] = $matches[$name];
            } elseif ($parameter->isOptional()) {
                $params[] = $parameter->getDefaultValue();
            } else {
                throw new \Exception("Missing parameter: $name");
            }
        }

        return $params;
    }

    public function dispatch()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestPath = $_SERVER['REQUEST_URI'];
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

        header("Access-Control-Allow-Origin: $origin");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type");

        if ($requestMethod === 'OPTIONS') {
            http_response_code(200);
            exit;
        }

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && preg_match($route['path'], $requestPath, $matches)) {
                array_shift($matches);

                if ($route['method'] === 'POST') {
                    $body = json_decode(file_get_contents('php://input'), true);
                    $matches[] = $body;
                }

                $callback = $route['callback'];

                $params = $this->extractParamsFromMatches($callback, $matches);

                if (is_callable($callback)) {
                    return call_user_func_array($callback, $params);
                }

                if (is_string($callback) && strpos($callback, '@') !== false) {
                    list($controllerClass, $methodName) = explode('@', $callback);
                    $controller = $this->container->get($controllerClass);
                    if (method_exists($controller, $methodName)) {
                        return call_user_func_array([$controller, $methodName], $params);
                    }
                }

                throw new \Exception('Invalid callback');
            }
        }

        throw new NotFoundException();
    }
}

