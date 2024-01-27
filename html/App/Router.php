<?php
declare(strict_types = 1);
namespace App;
use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes;

    public function register(string $requestMethod, string $route, callable $action):self
    {
        $this->routes[$requestMethod][$route] = $action; // [key][value]
        return $this;
    }
    
    public function get(string $route, callable $action):self
    {
        return $this->register('get', $route, $action);
    }

    public function post(string $route, callable $action):self
    {
        return $this->register('post', $route, $action);
    }


    public function route(): array
    {
        return $this->routes;
    }


    public function resolve(string $requestUri, string $requestMethod)
    {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;
        
        if(!$action)
        {
            throw new RouteNotFoundException();
        }
        if (is_callable($action))
        {
            return call_user_func($action);
        }
        if(is_array($action))
        {
            [$class, $method] = $action;

            if(class_exists($class))
            {
                $class = new $class();
                if(method_exists($class, $method))
                {
                    return call_user_func_array($method, []);
                }
            }
        }
    }
}