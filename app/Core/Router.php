<?php

namespace App\Core;

class Router {
    protected $routes = [];

    public function add($method, $route, $handler) {
        $this->routes[] = [
            'method' => $method,
            'route' => $route,
            'handler' => $handler
        ];
    }

    public function handle($method, $uri) {
        // Strip base path if necessary (e.g., /inventory1/public)
        $uri = parse_url($uri, PHP_URL_PATH);
        
        foreach ($this->routes as $route) {
            $pattern = str_replace('/', '\/', $route['route']);
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^\/]+)', $pattern);
            $pattern = '/^' . $pattern . '$/';

            if ($route['method'] === $method && preg_match($pattern, $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                if (is_callable($route['handler'])) {
                    return call_user_func_array($route['handler'], $params);
                }

                $parts = explode('@', $route['handler']);
                $controllerName = "App\\Controllers\\" . $parts[0];
                $action = $parts[1];

                $controller = new $controllerName();
                return call_user_func_array([$controller, $action], $params);
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }
}
