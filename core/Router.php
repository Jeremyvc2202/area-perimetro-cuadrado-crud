<?php
// core/Router.php
class Router {
    private array $routes = ['GET' => [], 'POST' => []];
    private string $base;

    public function __construct(string $basePath = '') {
        $this->base = $this->normalize($basePath);
    }

    public function get(string $path, $handler)  { $this->routes['GET'][$this->normalize($path)]  = $handler; }
    public function post(string $path, $handler) { $this->routes['POST'][$this->normalize($path)] = $handler; }

    private function normalize(string $p): string {
        $p = '/' . ltrim($p, '/');
        return rtrim($p, '/') ?: '/';
    }

    private function currentPath(): string {
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

        // Si la app corre bajo /hola-mundo-mvc/public, recorta ese prefijo
        if ($this->base !== '/' && strpos($uri, $this->base) === 0) {
            $uri = substr($uri, strlen($this->base));
            if ($uri === '' || $uri === false) { $uri = '/'; }
        }
        return $this->normalize($uri);
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $path   = $this->currentPath();

        $handler = $this->routes[$method][$path] ?? null;
        if (!$handler) {
            http_response_code(404);
            echo "Ruta no encontrada: {$method} {$path}";
            return;
        }
        if (is_array($handler)) {
            [$class, $action] = $handler;
            $controller = new $class();
            return $controller->$action();
        }
        return $handler();
    }
}
