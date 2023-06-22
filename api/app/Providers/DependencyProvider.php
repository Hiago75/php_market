<?php

namespace App\Providers;

use App\Providers\DatabaseConnectionProvider;
use App\Exceptions\InternalServerError;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class DependencyProvider
{
    private $dependencies = [];

    public function register(string $name, callable $resolver)
    {
        $this->dependencies[$name] = $resolver;
    }

    public function get($name)
    {
        if (!$this->has($name)) {
            throw new InternalServerError("Dependency '$name' not found.");
        }

        if (is_callable($this->dependencies[$name])) {
            $resolver = $this->dependencies[$name];
            $this->dependencies[$name] = $resolver($this);
        }

        return $this->dependencies[$name];
    }

    public function has($name)
    {
        return isset($this->dependencies[$name]);
    }

    public function registerByConvention()
    {
        $controllersPath = realpath(__DIR__ . '/../Controllers');
        if (!is_dir($controllersPath)) {
            throw new InternalServerError('Controllers directory not found.');
        }
    
        $controllerNamespace = 'App\\Controllers\\';
    
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($controllersPath));
        $registrations = [];
    
        foreach ($files as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $className = $controllerNamespace . $file->getBasename('.php');
                $serviceName = str_replace('Controller', 'Service', $className);
                $modelClassName = preg_replace('/Controllers\b/', 'Models', $className);
                $modelClassName = preg_replace('/Controller$/', '', $modelClassName);
                $controllerClassName = $className;
                
                $registrations[] = [
                    'class' => $modelClassName,
                    'factory' => function ($container) use ($modelClassName) {
                        $databaseConnectionProvider = $container->get(DatabaseConnectionProvider::class);
                        return new $modelClassName($databaseConnectionProvider);
                    }
                ];
    
                $registrations[] = [
                    'class' => $serviceName,
                    'factory' => function ($container) use ($serviceName, $modelClassName) {
                        $model = $container->get($modelClassName);
                        return new $serviceName($model);
                    }
                ];
                
                $registrations[] = [
                    'class' => $controllerClassName,
                    'factory' => function ($container) use ($controllerClassName, $serviceName) {
                        $service = $container->get($serviceName);
                        return new $controllerClassName($service);
                    }
                ];
            }
        }
    
        return $registrations;
    }    
}
