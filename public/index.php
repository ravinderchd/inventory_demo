<?php

require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Models/Order.php';
require_once __DIR__ . '/../app/Controllers/OrderController.php';

use App\Core\Router;

$router = new Router();

// API Routes
$router->add('GET', '/api/orders', 'OrderController@index');
$router->add('GET', '/api/orders/{id}', 'OrderController@show');
$router->add('PATCH', '/api/orders/{id}', 'OrderController@update');

// Frontend Route
$router->add('GET', '/', function() {
    require __DIR__ . '/../views/dashboard.php';
});

// For local subdirectory development
$uri = $_SERVER['REQUEST_URI'];
$base = '/inventory1/public';
if (strpos($uri, $base) === 0) {
    $uri = substr($uri, strlen($base));
}
if (empty($uri)) $uri = '/';

$router->handle($_SERVER['REQUEST_METHOD'], $uri);
