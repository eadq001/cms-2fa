<?php declare(strict_types=1);

namespace Core;

class Router
{
    protected $routes = [];

    public function addRoute($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'method' => $method,
            'controller' => $controller
        ];
    }

    public function get($uri, $controller)
    {
        $this->addRoute('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        $this->addRoute('POST', $uri, $controller);
    }

    public function update($uri, $controller)
    {
        $this->addRoute('PATCH', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        $this->addRoute('DELETE', $uri, $controller);
    }

    public function abort($code = 404)
    {
        http_response_code($code);
        view('404.php');
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                require BASE_PATH . $route['controller'];
                return;
            }
        }

        $this->abort();
    }
}

?>