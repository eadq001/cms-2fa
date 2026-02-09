<?php declare(strict_types=1);

namespace Core;

use Core\Middleware\Middleware;

class Router
{
    protected $routes = [];

    public function addRoute($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'method' => $method,
            'controller' => $controller,
            'middleware' => null
        ];
    }

    public function get($uri, $controller)
    {
        $this->addRoute('GET', $uri, $controller);
        return $this;
    }

    public function post($uri, $controller)
    {
        $this->addRoute('POST', $uri, $controller);
        return $this;
    }

    public function patch($uri, $controller)
    {
        $this->addRoute('PATCH', $uri, $controller);
        return $this;
    }

    public function delete($uri, $controller)
    {
        $this->addRoute('DELETE', $uri, $controller);
        return $this;
    }

    public function abort($code = 404)
    {
        http_response_code($code);
        view('404.php');
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        
    }

    public function route($uri, $method)
    {   

        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {

                if ($route['middleware']) {
                    Middleware::resolve($route['middleware']);
                }
                
                require BASE_PATH . $route['controller'];
                return;
            }
        }

        $this->abort();
    }
}

?>