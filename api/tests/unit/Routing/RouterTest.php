<?php
use PHPUnit\Framework\TestCase;

use App\Routing\Router;
use App\Exceptions\NotFoundException;
use App\Providers\DatabaseConnectionProvider;

class RouterTest extends TestCase
{
    private $container;
    private $router;

    protected function setUp(): void
    {
        $this->container = $this->createMock(DatabaseConnectionProvider::class);
        $this->router = new Router($this->container);
    }

    public function testAddRoute()
    {
        $this->router->addRoute('GET', '/products', 'Controller@index');

        $routes = $this->getRoutes();
        $this->assertCount(1, $routes);
        $this->assertEquals('GET', $routes[0]['method']);
        $this->assertEquals('#^/products/?$#', $routes[0]['path']);
        $this->assertEquals('Controller@index', $routes[0]['callback']);
    }


    public function testDispatchNotFoundRoute()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/non-existent-route';

        $this->expectException(NotFoundException::class);

        $this->router->dispatch();
    }

    // Helper method to get the routes property value
    private function getRoutes()
    {
        $reflection = new ReflectionClass(Router::class);
        $routesProperty = $reflection->getProperty('routes');
        $routesProperty->setAccessible(true);
        return $routesProperty->getValue($this->router);
    }
}
