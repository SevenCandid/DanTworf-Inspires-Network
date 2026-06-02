<?php

namespace App\Core;

class Router {
    private array $routes = [];

    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }

    public function dispatch($uri, $method) {
        // Strip query string and base path if running in subdirectory
        $uri = parse_url($uri, PHP_URL_PATH);
        
        // Remove base path if applicable, here assuming basic setup
        $basePath = '/DIN/public'; // Adjust for your local setup if needed
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }
        
        $uri = $uri ?: '/';

        if (array_key_exists($method, $this->routes) && array_key_exists($uri, $this->routes[$method])) {
            $controllerAction = explode('@', $this->routes[$method][$uri]);
            $controllerName = "App\\Controllers\\" . $controllerAction[0];
            $actionName = $controllerAction[1];

            if (class_exists($controllerName)) {
                $controllerInstance = new $controllerName();
                if (method_exists($controllerInstance, $actionName)) {
                    return $controllerInstance->$actionName();
                }
            }
        }
        
        // Fallback to 404
        http_response_code(404);
        echo "404 Not Found";
    }
}
