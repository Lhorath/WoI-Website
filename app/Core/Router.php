<?php
namespace WoI\Core;

class Router
{
    private $routes = array();

    public function get($path, $handler) { return $this->add(array('GET', 'HEAD'), $path, $handler); }
    public function post($path, $handler) { return $this->add(array('POST'), $path, $handler); }
    public function any($path, $handler) { return $this->add(array('*'), $path, $handler); }

    public function add($methods, $path, $handler)
    {
        $placeholder = preg_replace_callback('/\{[a-zA-Z_][a-zA-Z0-9_]*\}/', function () {
            return '___WOI_ROUTE_PARAMETER___';
        }, $path);
        $pattern = str_replace('___WOI_ROUTE_PARAMETER___', '([^/]+)', preg_quote($placeholder, '#'));

        $this->routes[] = array(
            'methods' => $methods,
            'regex' => '#^' . $pattern . '$#D',
            'handler' => $handler
        );
        return $this;
    }

    public function dispatch()
    {
        $method = isset($_SERVER['REQUEST_METHOD']) ? strtoupper($_SERVER['REQUEST_METHOD']) : 'GET';
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        $path = rawurldecode(parse_url($uri, PHP_URL_PATH) ?: '/');
        if ($path !== '/') {
            $path = rtrim($path, '/') ?: '/';
        }

        foreach ($this->routes as $route) {
            if ($route['methods'][0] !== '*' && !in_array($method, $route['methods'], true)) {
                continue;
            }
            if (!preg_match($route['regex'], $path, $matches)) {
                continue;
            }
            array_shift($matches);
            $this->invoke($route['handler'], $matches);
            return true;
        }

        (new \WoI\Controllers\ErrorController())->notFound();
        return false;
    }

    private function invoke($handler, $parameters)
    {
        if (is_array($handler) && count($handler) === 2 && is_string($handler[0])) {
            $controller = new $handler[0]();
            call_user_func_array(array($controller, $handler[1]), $parameters);
            return;
        }
        call_user_func_array($handler, $parameters);
    }
}
